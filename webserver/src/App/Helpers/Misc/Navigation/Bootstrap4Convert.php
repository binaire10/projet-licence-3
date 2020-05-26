<?php

namespace {

    use App\Helpers\Balise;
    use App\Helpers\BaliseBlockBuilder;
    use App\Helpers\Misc\Navigation\LinkNavigationItem;
    use App\Helpers\Misc\Navigation\MenuNavigation;
    use App\Helpers\Misc\Navigation\NavigationBar;
    use App\Helpers\Misc\Navigation\NavigationItemVisitor;

    class Bootstrap4ConvertMenu implements NavigationItemVisitor {
        private Balise $result;

        /**
         * @return mixed
         */
        public function getResult(): Balise
        {
            return $this->result;
        }

        public function visitNavBarItem(NavigationBar $navigationItem): void
        {
            throw new \http\Exception\UnexpectedValueException();
        }

        public function visitLinkNavItem(LinkNavigationItem $navigationItem): void
        {
            $this->result = BaliseBlockBuilder::create_a(
                $navigationItem->getName(),
                is_null($navigationItem->getId()) ? [
                        'class' => 'dropdown-item',
                        'href' => $navigationItem->getUrl()
                    ] : [
                        'class' => 'dropdown-item',
                        'href' => $navigationItem->getUrl(),
                        'id' => $navigationItem->getId()
                    ]
            );
        }

        public function visitMenuNavItem(MenuNavigation $navigationItem): void
        {
            throw new \http\Exception\UnexpectedValueException();
        }

        public function visitBalise(Balise $balise): void
        {
            $this->result = $balise;
        }
    }
}

namespace App\Helpers\Misc\Navigation {


    use App\Helpers\Balise;
    use App\Helpers\BaliseBlockBuilder;
    use Bootstrap4ConvertMenu;

    class Bootstrap4Convert implements NavigationItemVisitor
    {
        private Balise $latest;

        public function visitLinkNavItem(LinkNavigationItem $navigationItem): void
        {
            $this->latest = BaliseBlockBuilder::make_li(['class' => 'nav-item'])->addContent(
                BaliseBlockBuilder::create_a($navigationItem->getName(),
                    is_null($navigationItem->getId()) ? [
                            'class' => 'nav-link',
                            'href' => $navigationItem->getUrl(),
                            'role' => 'button'
                        ] : [
                            'class' => 'nav-link',
                            'id' => $navigationItem->getId(),
                            'href' => $navigationItem->getUrl(),
                            'role' => 'button'
                        ]
                )
            );
        }

        public function visitMenuNavItem(MenuNavigation $navigationItem): void
        {
            $id = $navigationItem->getId() ?? 'dropdown_'.uniqid(md5(mt_rand()));
            $result = BaliseBlockBuilder::make_li(['class' => 'nav-item dropdown'])->addContent(
                BaliseBlockBuilder::create_a($navigationItem->getText(),
                    [
                        'class' => 'nav-link dropdown-toggle',
                        'href' => '#',
                        'id' => $id,
                        'role' => 'button',
                        'data-toggle' => 'dropdown',
                        'aria-haspopup' => 'true',
                        'aria-expanded' => 'false'
                    ]),
                $div = BaliseBlockBuilder::create_div([
                    'class' => 'dropdown-menu',
                    'aria-labelledby' => $id
                ])
            );
            $converter = new Bootstrap4ConvertMenu();
            $div->addContents(
                array_map(
                    function ($child) use (&$converter) {
                        ;
                        $child->accept($converter);
                        return $converter->getResult();
                    },
                    $navigationItem->getChild()
                )
            );

            $this->latest = $result;
        }

        public function visitNavBarItem(NavigationBar $navigationItem): void
        {
            $id = $navigationItem->getId() ?? 'navbar_' . uniqid(md5(mt_rand()));
            $result = BaliseBlockBuilder::create_nav([
                'class' => 'navbar navbar-expand-lg navbar-dark bg-dark'
            ]);
            if($navigationItem->getBrandItem() !== null)
                $result->addContent(
                    $navigationItem->getBrandItem()
                );
            $result->addContent(
                BaliseBlockBuilder::make_button([
                    'class' => 'navbar-toggler',
                    'type' => 'button',
                    'data-toggle' => 'collapse',
                    'data-target' => '#' . $id,
                    'aria-controls' => $id,
                    'aria-expanded' => 'false',
                    'aria-label' => 'Toggle navigation'
                ])->addContent(
                    BaliseBlockBuilder::make_a([
                        'class' => 'navbar-toggler-icon'
                    ])
                ),
                BaliseBlockBuilder::create_div([
                    'class' => 'collapse navbar-collapse',
                    'id' => $id
                ])->addContent(
                    $div = BaliseBlockBuilder::create_ul([
                        'class' => 'navbar-nav mr-auto'
                    ])
                )
            )->addContents(
                $navigationItem->getOutside()
            );
            $div->addContents(
                array_map(
                    function ($child) {
                        $child->accept($this);
                        return $this->latest;
                    },
                    $navigationItem->getNavigationRoot()
                )
            );
            $this->latest = $result;
        }

        public function visitBalise(Balise $balise): void
        {
            $this->latest = $balise;
        }

        public function getRoot(): Balise
        {
            return $this->latest;
        }
    }
}