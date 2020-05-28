<?php


namespace App\Views;


use UnexpectedValueException;

class borrowButton
{
    private int $id;
    private string $button = "<input
                type=\"button\"
                id=\"buttonRecherche\"
                >";

    function __construct($id) {
        $this->id = $id;
        if(!isset($exemplaires)) {
            throw new UnexpectedValueException();
        }

    }

    function getButton() {
        return $this->button;
    }

    function dispo($id) {
        foreach ($exemplaires as $copy) {

        }
    }
}