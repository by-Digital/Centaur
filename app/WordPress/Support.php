<?php

namespace Centaur\WordPress;

class Support
{
    public function __construct()
    {
        \add_action('init', [$this, 'enableThemeSupport']);
    }

    public function enableThemeSupport(): void
    {
        \add_theme_support('menus');
        \add_theme_support('title-tag');
    }
}
