<?php


namespace App\Controllers;


use CodeIgniter\Exceptions\PageNotFoundException;

class Author extends BaseController
{
    public function get(int $from, int $countMax) {
        if(!$this->request->isAJAX())
            throw new PageNotFoundException();
        $db = \Config\Database::connect();
        header('Content-Type: application/json');
        $result = new \stdClass();
        $result->ok = true;
        try {
            $table = $db->table('Auteur');
            $result->result = $table->select('*')->get($countMax, $from)->getResultArray();
            $result->count = $table->countAll();
        } catch (\Throwable $exception) {
            $result->ok = false;
            $result->message = $exception->getMessage();
        }
        echo json_encode($result);
        die; // prevent codeigniter to send bad content type
    }
}