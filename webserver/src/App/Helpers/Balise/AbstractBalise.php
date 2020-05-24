<?php


namespace App\Helpers\Balise;


abstract class AbstractBalise implements \App\Helpers\Balise
{
    protected string $name;
    /**
     * @var string[]
     */
    protected array $attribute = [];
    /**
     * @var string[]|AbstractBalise[]
     */
    protected array $child;

    /**
     * AbstractBalise constructor.
     * @param string $name
     * @param array|string[] $attribute
     * @param AbstractBalise[]|array|string[] $child
     */
    public function __construct(string $name, array $attribute = [], array $child = [])
    {
        $this->name = $name;
        $this->attribute = $attribute;
        $this->child = $child;
    }

    /**
     * @return string[]
     */
    public function getAttribute(): array
    {
        return $this->attribute;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return AbstractBalise[]|string[]
     */
    public function getChild() : array
    {
        return $this->child;
    }

    /**
     * @param AbstractBalise[]|string[]|array $argument
     * @return $this
     */
    public function addContent(...$argument): self
    {
        return self::addContents($argument);
    }

    /**
     * @param AbstractBalise[]|string[]|array $array
     * @return $this
     */
    public function addContents($array): self
    {
        if(!isset($this->child))
            $this->child = array();
        if(!isset($array))
            return $this;
        foreach ($array as $value)
            $this->child[] = $value;
        return $this;
    }
}