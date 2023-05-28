<!DOCTYPE html>
<html <?php \language_attributes(); ?> x-data="wpApp()" x-on:popstate.window="init()">

    <!-- Head -->
    <head>
        <!-- Meta -->
        <meta charset="<?php \bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Links -->
        <link rel="profile" href="https://gmpg.org/xfn/11">

        <title x-text="pageCache[currentRoute] ? pageCache[currentRoute].seo.title : '<?= wp_title('|', false, 'right') . get_bloginfo('name'); ?>'">
            <?= wp_title('|', false, 'right') . get_bloginfo('name'); ?>
        </title>

        <!-- WP Head -->
        <?php \wp_head() ?>
    </head>

    <!-- Body -->
    <body <?php \body_class() ?>>
        <?php \wp_body_open() ?>
        <a class="skip-link screen-reader-text" href="#content"><?php \esc_html_e( 'Skip to content', 'centaur' ); ?></a>

        <div id="content">

            <?php \wp_nav_menu([
                'menu'           => 'Primary Menu',
                'menu_class'     => 'menu',
                'walker'         => new \Centaur\Helper\NavWalker()
            ]); ?>

            <div x-show="currentRoute">
                <h2 x-text="pageCache[currentRoute] ? pageCache[currentRoute].title.rendered : ''"></h2>
                <div x-html="pageCache[currentRoute] ? pageCache[currentRoute].content.rendered : ''"></div>
            </div>

