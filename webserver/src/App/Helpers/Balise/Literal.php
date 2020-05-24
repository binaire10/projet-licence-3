<?php


namespace App\Helpers\Balise;


class Literal implements Balise
{
    private string $string;

    /**
     * Literal constructor.
     * @param string $string
     */
    public function __construct(string $string)
    {
        $this->string = $string;
    }

    public function accept(\App\Helpers\BaliseVisitor $visitor)
    {
        $visitor->visitLiteral($this);
    }

    /**
     * @return string
     */
    public function getString(): string
    {
        return $this->string;
    }
}