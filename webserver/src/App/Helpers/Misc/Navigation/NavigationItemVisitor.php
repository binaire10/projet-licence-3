<?php


namespace App\Helpers\Misc\Navigation;


use App\Helpers\Balise;
use App\Helpers\BaliseVisitor;

interface NavigationItemVisitor
{
    public function visitNavBarItem(NavigationBar $navigationItem): void;
    public function visitLinkNavItem(LinkNavigationItem $navigationItem): void;
    public function visitMenuNavItem(MenuNavigation $navigationItem): void;
    public function visitBalise(Balise $balise): void;
}