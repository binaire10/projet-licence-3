<?php


namespace App\Controllers;


use CodeIgniter\Exceptions\PageNotFoundException;

class AcceptBorrowing extends BaseController
{
    public function bookingRequests() {
        $db = \Config\Database::connect();
        return view('booking_list', [
            'title' => 'Booking list',
            'Booking requests' => $db->table('Reservation')->select('*')->get()->getResultArray()
        ]);
    }
    public function cancelBooking () {
        if(!$this->isLibrarian)
            throw new PageNotFoundException();

    }
}