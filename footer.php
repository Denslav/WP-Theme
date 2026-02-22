<?php

?>
<footer id="footer" class="footer">
    <div class="container">
        <div class="footer__row">
            <div class="footer__logo">
                <?php
                if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                    <?php
                }
                ?>
            </div>
            <?php if ( has_nav_menu( 'footer' ) ): ?>
                <div class="footer__navigation">
                    <nav id="footer-menu">
                        <?php wp_nav_menu( array( 
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer__menu',
                            'container'      => false,

                            ) ); ?>
                    </nav>
                    </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="footer__copyright">
        <div class="container">
            <div class="footer__copyright-text">
                <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>