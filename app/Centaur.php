<?php

/**
 * Centaur
*/

namespace Centaur;

class Centaur
{
    public function __construct()
    {
        new \Centaur\WordPress\Scripts();
        new \Centaur\WordPress\Menus();
        new \Centaur\WordPress\REST();
    }
}
