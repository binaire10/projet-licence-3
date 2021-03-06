<?php


namespace App\Helpers;


interface BaliseVisitor
{
    public function visitString(string $s): void;
    public function visitBlock(\App\Helpers\Balise\BlockBalise $s): void;
    public function visitInline(\App\Helpers\Balise\InlineBalise $s): void;
    public function visitLiteral(\App\Helpers\Balise\Literal $param):void;
    public function visitDocument(\App\Helpers\Balise\HTMLDocument $param):void;
    public function visitBlockNotEmpty(\App\Helpers\Balise\BlockBaliseNotEmpty $param):void;
    public function visitInlineNotEmpty(Balise\InlineBaliseNotEmpty $param):void;
}