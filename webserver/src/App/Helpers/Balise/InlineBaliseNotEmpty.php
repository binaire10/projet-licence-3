<?php


namespace App\Helpers\Balise;


class InlineBaliseNotEmpty extends AbstractBalise
{
    public function accept(\App\Helpers\BaliseVisitor $visitor)
    {
        $visitor->visitInlineNotEmpty($this);
    }
}