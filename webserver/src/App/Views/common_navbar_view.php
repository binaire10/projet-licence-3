<?php

use App\Helpers\Misc\Navigation\NavigationBar;

$nav_bar = new NavigationBar();

$nav_bar->addLink("Connexion", '#');
$compiler = new \App\Helpers\Misc\Navigation\Bootstrap4Convert();
$nav_bar->accept($compiler);
$compiler->getRoot()->accept(new \App\Helpers\PrettyPrintOutput());