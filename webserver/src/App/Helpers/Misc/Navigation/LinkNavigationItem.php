<?php


namespace App\Helpers\Misc\Navigation;


use App\Helpers\BaliseVisitor;

class LinkNavigationItem implements NavigationItem
{
    private ?string $id = null;
    private string $name;
    private string $url;

    /**
     * LinkNavigationItem constructor.
     * @param string $url
     * @param string $name
     */
    public function __construct(string $name, string $url)
    {
        $this->url = $url;
        $this->name = $name;
    }

    public function accept(NavigationItemVisitor $itemVisitor): void
    {
        $itemVisitor->visitLinkNavItem($this);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}