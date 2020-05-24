<?php


namespace App\Helpers\Balise;


class BlockBaliseNotEmpty extends BlockBalise
{
    public function accept(\App\Helpers\BaliseVisitor $visitor)
    {
        $visitor->visitBlockNotEmpty($this);
    }

}