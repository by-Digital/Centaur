<?php

namespace Centaur\WordPress;

class Scripts
{
    public function __construct()
    {
        \add_action('enqueue_block_editor_assets', [$this, 'registerEditorAssets']);
        \add_action('wp_enqueue_scripts', [$this, 'registerSiteScripts']);
    }

    public static function registerEditorAssets()
    {
    }

    public static function registerSiteScripts()
    {
        \wp_enqueue_script(
            'centaur-bundle',
            \get_template_directory_uri() . '/dist/js/bundle.js'
        );
    }
}
