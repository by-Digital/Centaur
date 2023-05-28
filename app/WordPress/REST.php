<?php

namespace Centaur\WordPress;

class REST
{
    public function __construct()
    {
        \add_action('rest_api_init', [$this, 'registerEndpoints']);
        \add_filter('rest_prepare_page', [$this, 'includeBlockData'], 10, 2);
    }

    public function registerEndpoints()
    {
        \register_rest_route('wp/v2', 'pages/frontpage', [
            'methods'  => 'GET',
            'callback' => [$this, 'handleFrontpage']
        ]);
    }

    public function handleFrontpage()
    {
        //* Get WP options front page from settings > reading.
        $frontpage_id = \get_option('page_on_front');

        //* Handle if error.
        if (empty($frontpage_id)) {
            return new \WP_REST_Response('No static frontpage enabled', 404);
        }

        //* Create request from pages endpoint by frontpage id.
        $request = new \WP_REST_Request('GET', '/wp/v2/pages/' . $frontpage_id);

        //* Parse request to get data.
        $response = \rest_do_request($request);

        //* Handle if error.
        if ($response->is_error()) {
            return new \WP_REST_Response('Something went wrong', 500);
        }

        return new \WP_REST_Response([$response->get_data()], 200);
    }

    public function includeBlockData($response, $post)
    {
        $blocks = \parse_blocks($post->post_content);
        $response->data['seo'] = [
            'title' => self::get_the_wp_title($post->ID, '|', 'right') . get_bloginfo('name')
        ];
        $response->data['blocks'] = $blocks;
        return $response;
    }

    public static function get_the_wp_title($postid = '', $sep = '&raquo;', $seplocation = '')
    {
        if (!$postid) return '';
        $post = get_post($postid);
        if (!is_object($post) || !isset($post->post_title)) return '';
        $t_sep = '%WP_TITILE_SEP%';
        $title = apply_filters('single_post_title', $post->post_title, $post);
        $prefix = '';
        if (!empty($title)) $prefix = " $sep ";
        if ('right' == $seplocation) {
            $title_array = explode($t_sep, $title);
            $title_array = array_reverse($title_array);
            $title = implode(" $sep ", $title_array) . $prefix;
        } else {
            $title_array = explode($t_sep, $title);
            $title = $prefix . implode(" $sep ", $title_array);
        }
        return apply_filters('wp_title', $title, $sep, $seplocation);
    }
}
