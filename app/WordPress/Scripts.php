<?php

namespace Centaur\WordPress;

class Scripts
{
    public function __construct()
    {
        \add_action('enqueue_block_editor_assets', [$this, 'registerEditorAssets']);
        \add_action('wp_enqueue_scripts', [$this, 'registerSiteScripts']);
        \add_filter('rest_prepare_page', [$this, 'includeBlockData'], 10, 2);
    }

    public function registerEditorAssets()
    {
    }

    public function registerSiteScripts()
    {
        //* Bundle
        \wp_enqueue_script(
            'centaur-bundle',
            \get_template_directory_uri() . '/dist/main.bundle.js'
        );

        //* Bundle
        \wp_enqueue_style(
            'centaur-bundle',
            \get_template_directory_uri() . '/dist/main.css'
        );

        //* Remove jQuery
        if (!\is_admin()) \wp_dequeue_script('jquery');
    }

    public function includeBlockData($response, $post)
    {
        $blocks = \parse_blocks($post->post_content);
        $response->data['blocks'] = $blocks;
        return $response;
    }
}
