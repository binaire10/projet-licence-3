<?php


namespace App\Controllers;



use App\Views\NavBar;
use CodeIgniter\Exceptions\PageNotFoundException;

class User extends BaseController
{
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

                //TODO: send mail with link to confirm account

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
        $nav_bar = NavBar::getInstance()->getBar();
        $nav_bar->addLink("Connexion", base_url('User/signin'));
        $nav_bar->addLink("Inscription", base_url('User/signup'));
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

        $password = $this->request->getPost('password');
        $username = $this->request->getPost('username');
        $message = null;

        if(isset($username, $password)) {
            $db = \Config\Database::connect();
            $result = $db->table('Utilisateur')
                ->select('*')
                ->where('identifiant', $username)
                ->get();
            $user = $result->getResult();
            if(empty($user) || !password_verify($password, $user[0]->hashpassword)) {
                $message = 'user or password invalid';
            }
            else {
                $this->session->set('user', $user[0]->id);
                if($this->request->isAJAX()) {
                    header('Content-Type: application/json');
                    echo json_encode(true);
                    die;
                }
                header('Location: '.base_url(''));
                die;
            }
        }

        if($this->request->isAJAX()) {
            header('Content-Type: application/json');
            echo json_encode(false);
            die;
        }


        $nav_bar = NavBar::getInstance()->getBar();
        $nav_bar->addLink("Connexion", base_url('User/signin'));
        $nav_bar->addLink("Inscription", base_url('User/signup'));

        return view('signin', ['title' => 'Connexion', 'message' => $message]);
    }

    public function signout() {
        if(!$this->session->has('user'))
            throw new PageNotFoundException();
        // source : https://www.php.net/manual/fr/function.session-destroy.php
        // Détruit toutes les variables de session
        $_SESSION = array();

        // Si vous voulez détruire complètement la session, effacez également
        // le cookie de session.
        // Note : cela détruira la session et pas seulement les données de session !
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finalement, on détruit la session.
        session_destroy();
        header('Location: '.base_url('/'));
        die;
    }
}