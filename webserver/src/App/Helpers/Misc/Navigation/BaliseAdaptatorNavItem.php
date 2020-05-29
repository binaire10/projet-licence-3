<?php


namespace App\Helpers\Misc\Navigation;


use App\Helpers\Balise;

class BaliseAdaptatorNavItem implements NavigationItem
{
    private Balise $balise;

    /**
     * BaliseAdaptatorNavItem constructor.
     * @param Balise $balise
     */
    public function __construct(Balise $balise)
    {
        $this->balise = $balise;
    }

    /**
     * @return Balise
     */
    public function getBalise(): Balise
    {
        return $this->balise;
    }

    public function accept(NavigationItemVisitor $itemVisitor): void
    {
        $itemVisitor->visitBalise($this->balise);
    }
}