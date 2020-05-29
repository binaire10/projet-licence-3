<?php


namespace App\Controllers;


class Exemplaires extends BaseController
{
    public function index() {
        $db = \Config\Database::connect();
        return view('borrowButton', [
            'title' => 'Exemplaires',
            'copies' => $db->table('Exemplaire')->select('*')->get()->getResultArray()
        ]);
    }
}