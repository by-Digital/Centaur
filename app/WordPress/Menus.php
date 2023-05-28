<?php

namespace Centaur\WordPress;

class Menus
{
    public function __construct()
    {
        \add_action('init', [$this, 'registerMenus']);
    }

    public function registerMenus(): void
    {
        \register_nav_menus([
            'main-menu'   => 'Main Menu',
            'footer-menu' => 'Footer Menu'
        ]);
    }
}
