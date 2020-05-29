<?php


namespace App\Controllers;

use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Exceptions\PageNotFoundException;

class Adherents extends BaseController
{
    public function futursAdherents(){
        if(!$this->isLibrarian)
            throw new PageNotFoundException();

        $db = \Config\Database::connect();
        $builder = $db->table('Utilisateur');
        $builder->whereNotIn('id', function(BaseBuilder $builder) {
            return $builder->select('id')->from('Adherent');
        });
        $query = $builder->select(['id', 'identifiant'])->get();
        $results = $query->getResultArray();

        return view('futursAdherents', ['title' => 'Futurs Adherents', 'results' => $results]);
    }

    public function validateAdherents(){
        if(!$this->isLibrarian)
            throw new PageNotFoundException();

        $id = $this->request->getPost('idUser');
        $address = $this->request->getPost('address');
        $dateCotisation = date("Y-m-d");
        if(empty($address)) {
            header('Location: '.base_url('Adherents/futursAdherents'));
            die;
        }
        else {
            $db = \Config\Database::connect();
            $builder = $db->table('Adherent');
            $builder->insert(["id" => $id, "adresse" => $address, "date_cotisation" => $dateCotisation]);
            header('Location: '.base_url('Adherents/futursAdherents'));
            die;
        }
    }
}