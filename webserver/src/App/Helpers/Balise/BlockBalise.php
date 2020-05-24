<?php


namespace App\Helpers\Balise;


class BlockBalise extends AbstractBalise
{
    public function accept(\App\Helpers\BaliseVisitor $visitor)
    {
        $visitor->visitBlock($this);
    }
}