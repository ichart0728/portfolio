<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package The Monday
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">
            <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'the-monday' ); ?></a>

            <header id="masthead" class="site-header" role="banner">
                
                    <section class="tm-home-section" id="tm-section-mainslider">
                        <?php
                            if( is_front_page() ) {
                                the_monday_slider_template();
                            }
                            $inner_page_header_option = get_theme_mod( 'inner_header_type', 'image' );
                            if( !is_front_page() && $inner_page_header_option != 'nothing' ) {
                                the_monday_innerpage_head_section(); 
                                the_monday_innerpage_title_section();
                            }
                        ?>
                    </section>
                    <div class="head-bar" id="tm-headermenu-section">
                            <div class="head-wrap">
                                <div class="holder">                        
                                    <div class="home-logo">
                                        <?php if ( get_header_image() ) { ?>
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
                                                <img class="site-logo" src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()-> width ); ?>" height="<?php echo esc_attr( get_custom_header() -> height ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                                            </a>
                                        <?php } else { ?>
                                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>           
                                        <?php } ?>
                                    </div>
                                    <div class="nav-toggle hide">
                                        <span> </span>
                                        <span> </span>
                                        <span> </span>
                                    </div>
                                    <div class="home-nav">                                    
                                        <nav id="mainnav" class="mainnav" role="navigation">
                                            <?php 
                                                if( get_theme_mod( 'single_page_menu_option', '' ) != 1 ) {
                                                    do_action( 'the_monday_single_page_menu' );
                                                } else {
                                                    wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'primary-menu' ) );
                                                }
                                            ?>
                                        </nav><!-- #site-navigation -->
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                    </div>
                    <div class="clear"></div>
            </header><!-- #masthead -->

            <div id="content" class="site-content">
            