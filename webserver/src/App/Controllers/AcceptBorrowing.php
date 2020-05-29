<?php


namespace App\Controllers;


use CodeIgniter\Exceptions\PageNotFoundException;

class AcceptBorrowing extends BaseController
{
    public function bookingRequests() {
        $db = \Config\Database::connect();
        return view('booking_list', [
            'title' => 'booking list',
            'bookingRequests' => $db->table('Reservation')->select('*')->get()->getResultArray()
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
            return view('booking_cancel_success', ['title' => 'Booking cancel successful']);
        }
        return view('booking_cancel', ['title' => 'Cancel this booking']);
    }
    public function confirmBooking () {
        if(!$this->isLibrarian)
            throw new PageNotFoundException();
        $userId = $this->request->getPost('userId');
        $bookId = $this->request->getPost('bookId');
        $action = $this->request->getPost('action');
        $idExmplaire = $this->request->getPost('idExemplaire');
        $bookingDate = $this->request->getPost('bookingDate');
        $dueDate = $this->request->getPost('dueDate');

        if (isset($action, $userId, $bookId) && $action == 'confirm'){
            $db = \Config\Database::connect();
            $db->table('HistoriqueEmprunt')->insert([$idExmplaire,$bookId,$userId,$bookingDate,$dueDate]);
            $db->table('EmpruntCourant')->insert([$idExmplaire,$bookId,$userId,$bookingDate]);
            $db->table('Reservation')->where('id_user', $userId)->where('id_livre', $bookId)->delete();
            return view('booking_success', ['title' => 'Booking successful']);
        }
        return view('booking_confirm',['title' => 'Confirm this booking']);






    }
}