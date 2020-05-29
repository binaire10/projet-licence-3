<?php


namespace App\Helpers\Misc\Navigation;


use App\Helpers\BaliseVisitor;

class MenuNavigation implements NavigationItem
{
    private ?string $id = null;
    /**
     * @var NavigationItem[]
     */
    private array $child;
    private string $text;

    /**
     * MenuNavigation constructor.
     * @param string $text
     * @param NavigationItem[]|array $child
     */
    public function __construct(string $text, array $child = [])
    {
        $this->child = $child;
        $this->text = $text;
    }

    public function accept(NavigationItemVisitor $itemVisitor): void
    {
        $itemVisitor->visitMenuNavItem($this);
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
     * @return NavigationItem[]
     */
    public function getChild(): array
    {
        return $this->child;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    public function addLink(string $name, string $url): LinkNavigationItem {
        return $this->child[] = new LinkNavigationItem($name, $url);
    }
}