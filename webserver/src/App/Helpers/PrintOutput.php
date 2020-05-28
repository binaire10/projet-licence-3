<?php


namespace App\Helpers;


class PrintOutput implements BaliseVisitor
{
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
            echo '>';
            foreach ($s->getChild() as $child) {
                $child->accept($this);
            }
            echo '</', $tag, '>';
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
            foreach ($s->getChild() as $child) {
                $child->accept($this);
            }
            echo '</', $tag, '>';
        }
    }

    public function visitInlineNotEmpty(\App\Helpers\Balise\InlineBaliseNotEmpty $s) : void
    {
        $tag = htmlspecialchars($s->getName());
        $child = $s->getChild();
        echo '<', $tag;
        $this->attributeToEcho($s->getAttribute());
        echo '>';
        foreach ($s->getChild() as $child) {
            $child->accept($this);
        }
        echo '</', $tag, '>';
    }

    private function attributeToEcho(array $attr) : void {
        foreach ($attr as $key => $value)
            echo ' ', htmlspecialchars($key), '="', htmlspecialchars($value), '"';
    }

    public function visitLiteral(\App\Helpers\Balise\Literal $param): void
    {
        echo $param->getString();
    }

    public function visitDocument(\App\Helpers\Balise\HTMLDocument $param):void
    {
        $tag = htmlspecialchars($param->getName());
        echo '<!DOCTYPE html>', '<', $tag;
        $this->attributeToEcho($param->getAttribute());
        echo '>';
        foreach ($param->getChild() as $child) {
            $child->accept($this);
        }
        --$this->ident;
        echo '</', $tag, '>';
    }

    public function visitBlockNotEmpty(Balise\BlockBaliseNotEmpty $param): void
    {
        $tag = htmlspecialchars($param->getName());
        echo '<', $tag;
        $this->attributeToEcho($param->getAttribute());
        echo '>';
        foreach ($param->getChild() as $child) {
            $child->accept($this);
        }
        echo '</', $tag, '>';
    }
}