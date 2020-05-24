<?php


namespace App\Helpers;


interface Balise
{
    public function accept(BaliseVisitor $visitor);
}