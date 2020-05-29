<?php


namespace App\Helpers;


class StringOutput implements BaliseVisitor
{
    private string $data = '';

    public function visitString(string $s): void
    {
        $this->data .= htmlspecialchars($s);
    }

    public function visitBlock(\App\Helpers\Balise\BlockBalise $s) : void
    {
        $tag = htmlspecialchars($s->getName());
        $child = $s->getChild();
        if(empty($child)) {
            $this->data .= '<' . $tag;
            $this->data .= $this->attributeToEcho($s->getAttribute());
            $this->data .= '/>';
        }
        else {
            $this->data .= '<' . $tag;
            $this->data .= $this->attributeToEcho($s->getAttribute());
            $this->data .= '>';
            foreach ($s->getChild() as $child) {
                $child->accept($this);
            }
            $this->data .= '</' . $tag . '>';
        }
    }

    public function visitInline(\App\Helpers\Balise\InlineBalise $s) : void
    {
        $tag = htmlspecialchars($s->getName());
        $child = $s->getChild();
        if(empty($child)) {
            $this->data .= '<' . $tag;
            $this->data .= $this->attributeToEcho($s->getAttribute());
            $this->data .= '/>';
        }
        else {
            $this->data .= '<' . $tag;
            $this->data .= $this->attributeToEcho($s->getAttribute());
            $this->data .= '>';
            foreach ($s->getChild() as $child) {
                $child->accept($this);
            }
            $this->data .= '</' . $tag . '>';
        }
    }

    private function attributeToEcho(array $attr) : string {
        $tag = '';
        foreach ($attr as $key => $value)
            $tag .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($value) . '"';
        return $tag;
    }

    public function visitLiteral(\App\Helpers\Balise\Literal $param): void
    {
        $this->data .= $param->getString();
    }

    public function visitDocument(\App\Helpers\Balise\HTMLDocument $param): void
    {
        $tag = htmlspecialchars($param->getName());
        $this->data = '<!DOCTYPE html>' . '<' . $tag;
        $this->data .= $this->attributeToEcho($param->getAttribute());
        $this->data .= '>';
        foreach ($param->getChild() as $child) {
            $child->accept($this);
        }
        $this->data .=  '</' . $tag . '>';
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    public function visitBlockNotEmpty(Balise\BlockBaliseNotEmpty $param): void
    {
        $tag = htmlspecialchars($param->getName());
        $this->data .= '<' . $tag;
        $this->data .= $this->attributeToEcho($param->getAttribute());
        $this->data .= '>';
        foreach ($param->getChild() as $child) {
            $child->accept($this);
        }
        $this->data .= '</' . $tag . '>';
    }

    public function visitInlineNotEmpty(Balise\InlineBaliseNotEmpty $param): void
    {
        $tag = htmlspecialchars($param->getName());
        $this->data .= '<' . $tag;
        $this->data .= $this->attributeToEcho($param->getAttribute());
        $this->data .= '>';
        foreach ($param->getChild() as $child) {
            $child->accept($this);
        }
        $this->data .= '</' . $tag . '>';
    }
}