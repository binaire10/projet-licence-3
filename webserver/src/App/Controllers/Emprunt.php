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
        table('HistoriqueEmprunt')->
        select('titre, nom, identifiant, date_debut, id_exemplaire, date_retour')->
        join('Utilisateur','Utilisateur.id = HistoriqueEmprunt.id_user')->
        join('Livre','Livre.id = HistoriqueEmprunt.id_livre')->
        get()->getResultArray();
        return view('borrow_list', [
            'title' => 'Liste emprunt',
            'emprunt' => $res
        ]);
    }
}