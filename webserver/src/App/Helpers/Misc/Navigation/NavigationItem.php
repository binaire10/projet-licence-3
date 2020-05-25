<?php


namespace App\Helpers\Misc\Navigation;


use App\Helpers\BaliseVisitor;

interface NavigationItem
{
    public function accept(NavigationItemVisitor $itemVisitor): void;
}