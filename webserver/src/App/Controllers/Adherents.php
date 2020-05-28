<?php


namespace App\Controllers;

use App\Views\NavBar;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Router\Exceptions\RedirectException;

class Adherents extends BaseController
{
    public function futursAdherents(){
        if(!$this->isUser)
            throw new PageNotFoundException();

        $db = \Config\Database::connect();
        $builder = $db->table('Utilisateur');
        $builder->whereNotIn('id', function(BaseBuilder $builder) {
            return $builder->select('id')->from('Bibliothecaire');
        });
        $query = $builder->select(['id', 'identifiant'])->get();
        $results = $query->getResultArray();

        return view('futursAdherents', ['title' => 'Futurs Adherents', 'results' => $results]);
    }

    public function validateAdherents(){
        return view('welcome_message', ['title' => 'On going']);
    }
}