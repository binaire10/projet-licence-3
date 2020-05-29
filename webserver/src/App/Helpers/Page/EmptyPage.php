<?php


namespace App\Helpers\Page;


use App\Helpers\Balise;
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

    public function addScript(Balise $script):self {
        $this->script[] = $script;
        return $this;
    }

    public function addContent(Balise $balise):self {
        $this->body[] = $balise;
        return $this;
    }

    public function addContents(Balise... $balises):self {
        return $this->addContentsArrays($balises);
    }

    public function addContentsArrays(array $balises):self {
        foreach ($balises as $balise)
            $this->body[] = $balise;
        return $this;
    }
}