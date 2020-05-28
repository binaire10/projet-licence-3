<?php


namespace App\Helpers;


interface Page
{
    public function visitDOM(BaliseVisitor $visitor);
}