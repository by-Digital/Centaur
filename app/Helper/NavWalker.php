<?php

namespace Centaur\Helper;

class NavWalker extends \Walker_Nav_Menu
{
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $item_output = '';

        $url = \str_replace(\site_url(), '', $item->url);

        $item_output .= '<a href="javascript:;" x-on:click.prevent="loadPage(\'' . \esc_attr($url) . '\')">';
        $item_output .= \esc_html($item->title);
        $item_output .= '</a>';

        $output .= \apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
