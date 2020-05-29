<?php


namespace App\Views;


use App\Helpers\Misc\Navigation\NavigationBar;

class NavBar
{
    private NavigationBar $bar;
    private static self $instance;

    /**
     * NavBar constructor.
     */
    public function __construct()
    {
        $this->bar = new NavigationBar();
    }

    public static function getInstance() {
        if(!isset(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }

    /**
     * @return NavigationBar
     */
    public function getBar(): NavigationBar
    {
        return $this->bar;
    }
}