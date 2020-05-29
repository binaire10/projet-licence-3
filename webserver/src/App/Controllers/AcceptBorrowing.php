<?php


namespace App\Controllers;


use CodeIgniter\Exceptions\PageNotFoundException;
use http\Exception\UnexpectedValueException;

class AcceptBorrowing extends BaseController
{
    public function bookingRequests() {
        $db = \Config\Database::connect();
        if(!$this->isLibrarian)
            throw new PageNotFoundException();
        $db = \Config\Database::connect();
        $res = $db->
        table('Reservation')->
        select('titre, nom, identifiant, date_demande, id_livre, id_user')->
        join('Utilisateur','Utilisateur.id = Reservation.id_user')->
        join('Livre','Livre.id = Reservation.id_livre')->
        get()->getResultArray();
        return $res;
    }
    public function listBooking(){
        $requests = $this->bookingRequests();
        return view('booking_list', [
            'title' => 'Liste demandes d\'emprunt',
            'emprunt' => $requests
        ]);
    }
    public function cancelBooking ()
    {
        if (!$this->isLibrarian)
            throw new PageNotFoundException();
        $userId = $this->request->getPost('userId');
        $bookId = $this->request->getPost('bookId');
        $action = $this->request->getPost('action');
        if (isset($action, $userId, $bookId) && $action == 'cancel') {
            $db = \Config\Database::connect();
            $db->table('Reservation')->where('id_user', $userId)->where('id_livre', $bookId)->delete();
            return view('cancel_successful', ['title' => 'Booking cancel successful']);
        }
        return view('booking_list', ['title' => 'Liste demandes d\'emprunt', 'emprunt'=>$this->bookingRequests()]);
    }
    public function confirmBooking () {
        if(!$this->isLibrarian)
            throw new PageNotFoundException();
        $userId = $this->request->getPost('userId');
        $bookId = $this->request->getPost('bookId');
        $action = $this->request->getPost('action');
        $idExemplaire = $this->request->getPost('idExemplaire');
        $bookingDate = $this->request->getPost('bookingDate');
        $dueDate = $this->request->getPost('dueDate');
        if (isset($action, $userId, $bookId) && $action == 'confirm'){
            $db = \Config\Database::connect();
            $db->table('HistoriqueEmprunt')->insert([$idExemplaire,$bookId,$userId,$bookingDate,$dueDate]);
            $db->table('EmpruntCourant')->insert([$idExemplaire,$bookId,$userId,$bookingDate]);
            $db->table('Reservation')->where('id_user', $userId)->where('id_livre', $bookId)->delete();
            return view('booking_success', ['title' => 'Booking successful']);
        }
        return view('booking_list',['title' => 'Liste demandes d\'emprunt','emprunt'=> $this->bookingRequests()]);

    }
    public function  acceptBooking ()
    {
        $userId = $this->request->getPost('userId');
        $bookId = $this->request->getPost('bookId');
        $action = $this->request->getPost('action');
        $title = $this->request->getPost('title');
        if (isset($action, $userId, $bookId) && $action == 'confirm') {
            return view('confirm_booking', ['title' => 'confirmation de l\'emprunt','keys'=>['user'=>$userId,'book'=>$bookId,'bookTitle'=>$title]]);
        }
    }

}