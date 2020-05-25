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
        if(isset($_POST['username'], $_POST['password'], $_POST['email'])) {
            $email = $_POST['email'];
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $userModel = model('App\Models\User');
                $userModel->insert([
                    'identifiant' => $_POST['username'],
                    'email' => $email,
                    'hashpassword' => password_hash($_POST['password'], PASSWORD_DEFAULT)
                ]);
                if($this->request->isAJAX()) {
                    header('Content-Type: application/json');
                    echo json_encode(true);
                    die;
                }
                header('Location: '.site_url());
                die;
            }
            else {
                $message = 'email invalid';
            }
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
            'email' => _POST['email'] ?? null,
            'username' => $_POST['username'] ?? null
        ]);
        echo view('footer_common_import', ['cache' => 60]);
        echo view('bottom_html', ['cache' => 60]);
    }

}