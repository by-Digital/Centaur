<?php

namespace Centaur\WordPress;

class REST
{
    public function __construct()
    {
        \add_action('rest_api_init', [$this, 'registerEndpoints']);
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
}
