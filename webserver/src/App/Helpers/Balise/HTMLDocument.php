<?php


namespace App\Helpers\Balise;


class HTMLDocument extends AbstractBalise
{
    /**
     * HTMLDocument constructor.
     * @param array $attribute
     * @param array $child
     */
    public function __construct(array $attribute, array $child)
    {
        parent::__construct("html", $attribute, $child);
    }

    public function accept(\App\Helpers\BaliseVisitor $visitor)
    {
        $visitor->visitDocument($this);
    }
}