<?php


namespace App\Helpers\Balise;


class InlineBalise extends AbstractBalise
{
    public function accept(\App\Helpers\BaliseVisitor $visitor)
    {
        $visitor->visitInline($this);
    }
}