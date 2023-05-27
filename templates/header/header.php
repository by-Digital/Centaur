<!DOCTYPE html>
<html <?php language_attributes(); ?> x-data>

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <?php wp_head() ?>
    </head>

    <body :class="$store.bodyClass">
        <?php wp_body_open() ?>
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'centaur' ); ?></a>

        <div id="content" class="site-content">
