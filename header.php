<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width">

    <!-- Set the viewport width to device width for mobile -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Remove Microsoft Edge's & Safari phone-email styling -->
    <meta name="format-detection" content="telephone=no,email=no,url=no">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header id="header" class="header">
    <div class="container">
        <div class="header__row">
            <div class="header__logo">
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
            <div class="header__navigation">
                <?php if ( has_nav_menu( 'primary' ) ) : ?>
                    <nav id="primary-menu" class="header__nav" aria-label="<?php esc_attr_e( 'Primary Menu', 'main' ); ?>">
                        <button class="navbar-toggle-button js-nav-toggle"
                                type="button"
                                aria-label="<?php esc_attr_e( 'Toggle Header Menu', 'main' ); ?>">
                            <span class="navbar-toggle-line"></span>
                        </button>

                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'container'      => false,
                                'menu_id'        => 'menu-header',
                                'menu_class'     => 'list-inline',
                            ) );
                        ?>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>