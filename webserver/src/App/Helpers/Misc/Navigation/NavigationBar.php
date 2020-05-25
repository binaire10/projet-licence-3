<?php


namespace App\Helpers\Misc\Navigation;


use App\Helpers\Balise;
use App\Helpers\BaliseVisitor;

class NavigationBar implements NavigationItem
{
    private ?string $id = null;
    /**
     * @var NavigationItem[]
     */
    private array $navigationRoot;
    /**
     * @var Balise[]
     */
    private array $outside;
    private ?Balise $brandItem = null;

    /**
     * NavigationBar constructor.
     * @param NavigationItem[]|array $navigationRoot
     * @param Balise|null $brandItem
     */
    public function __construct($navigationRoot = [])
    {
        $this->navigationRoot = $navigationRoot;
        $this->outside = [];
    }

    public function accept(NavigationItemVisitor $itemVisitor): void
    {
        $itemVisitor->visitNavBarItem($this);
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
     * @param Balise|null $brandItem
     */
    public function setBrandItem(?Balise $brandItem): NavigationBar
    {
        $this->brandItem = $brandItem;
        return $this;
    }

    /**
     * @return NavigationItem[]
     */
    public function getNavigationRoot(): array
    {
        return $this->navigationRoot;
    }

    /**
     * @return Balise[]
     */
    public function getOutside(): array
    {
        return $this->outside;
    }

    /**
     * @return Balise|null
     */
    public function getBrandItem(): ?Balise
    {
        return $this->brandItem;
    }

    public function addMenu(string $name): MenuNavigation {
        return $this->navigationRoot[] = new MenuNavigation($name);
    }

    public function addLink(string $name, string $url): LinkNavigationItem {
        return $this->navigationRoot[] = new LinkNavigationItem($name, $url);
    }

    public function addBalise(Balise $balise): BaliseAdaptatorNavItem {
        return $this->navigationRoot[] = new BaliseAdaptatorNavItem($balise);
    }

    public function addOutsideBalise(Balise $balise): BaliseAdaptatorNavItem {
        return $this->outside[] = $balise;
    }
}