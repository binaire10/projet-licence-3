<?php


namespace App\Helpers;


class StringBalise implements Balise
{
    private string $string;

    /**
     * StringBalise constructor.
     * @param string $string
     */
    public function __construct(string $string)
    {
        $this->string = $string;
    }

    public function accept(BaliseVisitor $visitor)
    {
        $visitor->visitString($this->string);
    }
}