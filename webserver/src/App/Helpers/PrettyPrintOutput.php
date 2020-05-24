<?php


namespace App\Helpers;


class PrettyPrintOutput implements BaliseVisitor
{
    private int $ident = 0;
    private string $identString = '    ';

    public function visitString(string $s): void
    {
        echo htmlspecialchars($s);
    }

    public function visitBlock(\App\Helpers\Balise\BlockBalise $s) : void
    {
        $tag = htmlspecialchars($s->getName());
        $child = $s->getChild();
        if(empty($child)) {
            echo '<', $tag;
            $this->attributeToEcho($s->getAttribute());
            echo '/>';
        }
        else {
            echo '<', $tag;
            $this->attributeToEcho($s->getAttribute());
            echo '>', PHP_EOL;
            ++$this->ident;
            $strIdent = str_repeat($this->identString, $this->ident);
            foreach ($s->getChild() as $child) {
                echo $strIdent;
                $child->accept($this);
                echo PHP_EOL;
            }
            --$this->ident;
            echo str_repeat($this->identString, $this->ident), '</', $tag, '>';
        }
    }

    public function visitInline(\App\Helpers\Balise\InlineBalise $s) : void
    {
        $tag = htmlspecialchars($s->getName());
        $child = $s->getChild();
        if(empty($child)) {
            echo '<', $tag;
            $this->attributeToEcho($s->getAttribute());
            echo '/>';
        }
        else {
            echo '<', $tag;
            $this->attributeToEcho($s->getAttribute());
            echo '>';
            ++$this->ident;
            $strIdent = str_repeat($this->identString, $this->ident);
            foreach ($s->getChild() as $child) {
                $child->accept($this);
            }
            --$this->ident;
            echo '</', $tag, '>';
        }
    }

    private function attributeToEcho(array $attr) : void {
        foreach ($attr as $key => $value)
            echo ' ', htmlspecialchars($key), '="', htmlspecialchars($value), '"';
    }

    public function visitLiteral(\App\Helpers\Balise\Literal $param): void
    {
        echo $param->getString();
    }

    public function visitDocument(\App\Helpers\Balise\HTMLDocument $param)
    {
        $tag = htmlspecialchars($param->getName());
        echo '<!DOCTYPE html>', PHP_EOL, '<', $tag;
        $this->attributeToEcho($param->getAttribute());
        echo '>', PHP_EOL;
        ++$this->ident;
        $strIdent = str_repeat($this->identString, $this->ident);
        foreach ($param->getChild() as $child) {
            echo $strIdent;
            $child->accept($this);
            echo PHP_EOL;
        }
        --$this->ident;
        echo '</', $tag, '>';
    }
}