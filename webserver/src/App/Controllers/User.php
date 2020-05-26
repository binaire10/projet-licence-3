<?php


namespace App\Controllers;



use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\IncomingRequest;

class User extends BaseController
{
    public function index()
    {
        echo view('header_html', ['title' => 'Connexion']);
        echo view('header_common_import', ['cache' => 60]);
        echo view('start_body', ['cache' => 60]);
        echo view('common_navbar_view');
        echo view('footer_common_import', ['cache' => 60]);
        echo view('bottom_html', ['cache' => 60]);
    }

    public function signup()
    {
        force_https();
        $email = $this->request->getPost('email', FILTER_VALIDATE_EMAIL);
        $password = $this->request->getPost('password');
        $username = $this->request->getPost('username');
        if(isset($email, $username, $password)) {
            $db = \Config\Database::connect();
            $userModel = model('App\Models\User', true, $db);
            $tokenModel = model('App\Models\TokenService', true, $db);
            if($userModel->insert([
                'identifiant' => $username,
                'email' => $email,
                'hashpassword' => password_hash($password, PASSWORD_DEFAULT)
            ])) {
                $token = md5(uniqid(mt_rand(), true));

                $tokenModel->insert([
                    'token' => $token,
                    'id_user' => $db->insertID(),
                    'service' => \App\Models\TokenService::LOGIN
                ]);

                if($this->request->isAJAX()) {
                    header('Content-Type: application/json');
                    echo json_encode(true);
                    die;
                }
                return view('signup_success', ['title' => 'Inscription']);
            }
            $message = 'invalid data';
        }
        if($this->request->isAJAX()) {
            header('Content-Type: application/json');
            echo json_encode(false);
            die;
        }
        return view('signup_page', [
            'title' => 'Inscription',
            'message' => $message ?? null,
            'email' => $email,
            'username' => $username
        ]);
    }

    public function signin() {
        if($this->session->has('user'))
            throw new PageNotFoundException();

    }
}