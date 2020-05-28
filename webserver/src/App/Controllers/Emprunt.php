<?php


namespace App\Controllers;


use CodeIgniter\Exceptions\PageNotFoundException;

class Emprunt extends BaseController
{
    public function index() {
        $db = \Config\Database::connect();
        $db->
        table('Reservation')->
        select('*')->
        join('Utilisateur','Utilisateur.id = Reservation.id_user')->
        join('Livre','Livre.id = Reservation.id_livre')->
        get()->getResultArray();
        return view('borrow_list', [
            'title' => 'Emprunt en attentes',
            'books' => $db
        ]);
    }
}