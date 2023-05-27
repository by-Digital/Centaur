<?php

namespace Centaur\WordPress;

class Menus
{
    public function __construct()
    {
        \add_action('init', [$this, 'enableMenus']);
        \add_action('init', [$this, 'registerMenus']);
    }

    public function enableMenus(): void
    {
        \add_theme_support('menus');
    }

    public function registerMenus(): void
    {
        \register_nav_menus([
            'main-menu'   => 'Main Menu',
            'footer-menu' => 'Footer Menu'
        ]);
    }
}
