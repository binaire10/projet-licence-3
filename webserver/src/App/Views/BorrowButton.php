<?php


namespace App\Views;


use UnexpectedValueException;

class BorrowButton
{
    private int $id;
    private int $id_user;

    private string $button = "";
    function __construct($id, $id_user, $nb) {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->format($nb);
    }

    function getButton() {
        return $this->button;
    }

    function format($nb) {
        $this->button .= "<a ";
        $this->button .= "href=\"" . base_url('Book/book/' . $this->id . "/" . $this->id_user) . "\" class=\"";
        if($nb > 0) {
            $this->button .= "btn btn-primary\">Demande d'emprunt";
        }
        elseif($nb === -1) {
            $this->button .= "btn disabled\">Demandé";
        }
        else {
            $this->button .= "btn btn-primary\">Indisponible (Réserver)";
        }

        $this->button .= "</a>";
    }
}