<?php


namespace App\Controllers;


use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\BaseConnection;
use CodeIgniter\Exceptions\PageNotFoundException;
use stdClass;

class Service extends BaseController
{
    public function confirm(?int $service, ?string $token) {
        if(!isset($service, $token))
            throw new PageNotFoundException();
        $db = \Config\Database::connect();
        $tokenTable = $db->table('Token');
        switch ($service) {
            case \App\Models\TokenService::LOGIN:
                if($this->verifyTokenExist($token, $service, $tokenTable)) {
                    if(!$this->deleteToken($token, $service, $tokenTable, $db))
                        throw new PageNotFoundException();
                    header('Location: '.base_url('/'));
                    die;
                }
                throw new PageNotFoundException();
                break;
            default:
                throw new PageNotFoundException();
                break;
        }
    }

    public function connect() {
        if($this->isUser)
            throw new PageNotFoundException();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $db = \Config\Database::connect();
        $tokenTable = $db->table('Token');
        $userTable = $db->table('Utilisateur');

        if($this->request->isAJAX()) {
            header('Content-Type: application/json');
            $result = new stdClass();
            $result->ok = true;
            if(!isset($username, $password) || !$this->verifyAccountToken($username, $tokenTable) || !$this->isUser) {
                $result->ok = false;
                echo json_encode($result);
                return;
            }
            $query = $userTable
                ->select('*')
                ->where('identifiant', $username)->get();
            $user = $query->getResult();
            if(empty($user) || !password_verify($password, $user[0]['hashpassword'])) {
                $result->ok = false;
                echo json_encode($result);
                return;
            }
            $this->session->set('user', $user['id']);
            echo json_encode($result);
            return;
        }

        if(!isset($username, $password) || !$this->verifyAccountToken($username, $tokenTable) || !$this->isUser) {
            header('Location: '.base_url('User/signin'));
        }
        $query = $userTable
            ->select('*')
            ->where('identifiant', $username)->get();
        $user = $query->getResultArray();

        if(empty($user) || !password_verify($password, $user[0]['hashpassword'])) {
            header('Location: '.base_url('User/signin'));
            die;
        }

        $this->session->set('user', $user[0]['id']);
        header('Location: '.base_url());
        die;
    }

    public static function verifyAccountToken($user, BaseBuilder $builder): bool {
        $builder->select('1');
        $builder->where('id_user', $user);
        $builder->where('service', \App\Models\TokenService::LOGIN);
        return $builder->countAllResults() === 0;
    }

    public static function verifyTokenExist(string $token, int $service, BaseBuilder $builder): bool {
        $builder->select('1');
        $builder->where('token', $token);
        $builder->where('service', $service);
        return $builder->countAllResults() === 1;
    }

    public static function deleteToken(string $token, int $service, BaseBuilder $builder, BaseConnection $base): bool {
        $builder->select('1');
        $builder->where('token', $token);
        $builder->where('service', $service);
        $builder->delete();
        return $base->affectedRows() > 0;
    }
}