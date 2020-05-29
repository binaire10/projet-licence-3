<?php


namespace App\Controllers;


use CodeIgniter\Exceptions\PageNotFoundException;

class Emprunt extends BaseController
{
    public function index() {
        if(!$this->isLibrarian)
            throw new PageNotFoundException();
        $db = \Config\Database::connect();
        $res = $db->
        table('Reservation')->
        select('titre, nom, identifiant, date_demande')->
        join('Utilisateur','Utilisateur.id = Reservation.id_user')->
        join('Livre','Livre.id = Reservation.id_livre')->
        get()->getResultArray();
        return view('borrow_list', [
            'title' => 'Emprunt en attentes',
            'emprunt' => $res
        ]);
    }
}