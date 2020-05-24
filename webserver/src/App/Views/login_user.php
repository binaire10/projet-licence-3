<?php

use App\Helpers\BaliseBlockBuilder;

$document = new \App\Helpers\Page\BootstrapPage(
    [
        BaliseBlockBuilder::create_title("Connexion")
    ],
    []
);

$document->visitDOM(new \App\Helpers\PrettyPrintOutput());