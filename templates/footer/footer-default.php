    </div><!-- #content -->

    <footer>
        <p class="footer-copyright">&copy;
            <?= date_i18n(
                _x('Y', 'copyright date format', 'centaur')
            ); ?>
            <a href="<?= \esc_url(\home_url('/')); ?>">built on <?php \bloginfo('name'); ?></a>
        </p><!-- .footer-copyright -->
    </footer>

    <?php \wp_footer(); ?>
    </body>

    </html>
