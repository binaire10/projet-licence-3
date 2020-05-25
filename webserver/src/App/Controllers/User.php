<?php


namespace App\Controllers;



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
        $email = $this->request->getPost('email', FILTER_VALIDATE_EMAIL);
        $password = $this->request->getPost('password');
        $username = $this->request->getPost('username');
        if(isset($email, $username, $password)) {
            $userModel = model('App\Models\User');
            if($userModel->insert([
                'identifiant' => $username,
                'email' => $email,
                'hashpassword' => password_hash($password, PASSWORD_DEFAULT)
            ])) {
                if($this->request->isAJAX()) {
                    header('Content-Type: application/json');
                    echo json_encode(true);
                    die;
                }
                echo view('header_html', ['title' => 'Inscription']);
                echo view('header_common_import', ['cache' => 60]);
                echo view('start_body', ['cache' => 60]);
                echo view('common_navbar_view');
                echo view('signup_success');
                echo view('footer_common_import', ['cache' => 60]);
                echo view('bottom_html', ['cache' => 60]);
                return;
            }
            $message = 'invalid data';
        }
        if($this->request->isAJAX()) {
            header('Content-Type: application/json');
            echo json_encode(false);
            die;
        }
        echo view('header_html', ['title' => 'Inscription']);
        echo view('header_common_import', ['cache' => 60]);
        echo view('start_body', ['cache' => 60]);
        echo view('common_navbar_view');
        echo view('signup_user', [
            'message' => $message ?? null,
            'email' => $email,
            'username' => $username
        ]);
        echo view('footer_common_import', ['cache' => 60]);
        ?><script src="<?php echo base_url('js/signup.js')?>"></script><?php
        echo view('bottom_html', ['cache' => 60]);
    }

}