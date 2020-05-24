<?php


namespace App\Helpers\Page;


use App\Helpers\BaliseBlockBuilder;
use App\Helpers\BaliseVisitor;
use App\Helpers\Balise\HTMLDocument;
use App\Helpers\Page;

class EmptyPage implements Page
{
    private array $head;
    private array $body;
    private array $script;

    /**
     * EmptyPage constructor.
     * @param array $head
     * @param array $body
     * @param array $script
     */
    public function __construct(array $head = [], array $body = [], array $script = [])
    {
        $this->head = $head;
        $this->body = $body;
        $this->script = $script;
    }

    public function visitDOM(BaliseVisitor $visitor)
    {
        $visitor->visitDocument(
            new HTMLDocument(['lang'=>'fr'],[
                BaliseBlockBuilder::create_head([], $this->head),
                BaliseBlockBuilder::create_body([], array_merge($this->body, $this->script)),
                ]
            )
        );
    }
}