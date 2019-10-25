<?php
/**
 * Template Name: Home Page
 *
 * This is the template that display sections of home page.
 * 
 * @package The Monday
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    <?php
        //Section About US
        if ( get_theme_mod( 'about_section_option', 'enable' ) == 'enable' ) {
            get_template_part( 'template-parts/sections/section', 'about' );
        }
        
        //Section Our Services
        if ( get_theme_mod( 'services_section_option', 'enable' ) == 'enable' ) {
            get_template_part( 'template-parts/sections/section', 'services' );
        }

        //Section Team Members
        if ( get_theme_mod( 'team_section_option', 'enable' ) == 'enable' ) {
            get_template_part( 'template-parts/sections/section', 'team' );
        }

        //Section Subscribe
        if ( get_theme_mod( 'subscribe_section_option', 'enable' ) == 'enable' && is_active_sidebar( 'the_monday_subscribe' ) ) {
    ?>
        <section class="subscribe" id="tm-section-subscribe">
            <div class="subscribe-overlay">
                <div class="container clearfix">
                    <?php dynamic_sidebar( 'the_monday_subscribe' ); ?>
                </div>
            </div>
        </section>
    <?php
        }

        //Section Portfolio
        if ( get_theme_mod( 'portfolio_section_option', 'enable' ) == 'enable' ) {
            get_template_part( 'template-parts/sections/section', 'portfolio' );
        }

        //Section Static Counter
        get_template_part( 'template-parts/sections/section', 'counter' );

        //Section Testimonilas
        if ( get_theme_mod( 'testimonials_section_option', 'enable' ) == 'enable' ) {
            get_template_part('template-parts/sections/section', 'testimonials' );
        }

        //Section Skill
        if ( get_theme_mod( 'skill_section_option', 'enable' ) == 'enable' ) {
            get_template_part( 'template-parts/sections/section', 'skill' );
        }
        
        //Section Featured Product
        if ( get_theme_mod( 'featured_product_section_option', 'enable' ) == 'enable' ) {
            get_template_part( 'template-parts/sections/section', 'featuredproduct' );
        }

        //Section Price Table
        if ( get_theme_mod( 'price_tables_section_option', 'enable' ) == 'enable' ) {
            get_template_part( 'template-parts/sections/section', 'price-tables' );
        }

        //Section Our Clients
        if ( get_theme_mod( 'clients_section_option', 'enable' ) == 'enable' ) {
            get_template_part( 'template-parts/sections/section', 'clients' );
        }
        
        //Section Call to action (Style 1)
        if ( is_active_sidebar( 'the_monday_cta_s1' ) ) {
            echo '<section class="tm-home-section" id="section-cta">';
            if ( !dynamic_sidebar( 'the_monday_cta_s1' ) ):
            endif;
            echo '</section>';
        }
        
        //Section Latest Blog
        if ( get_theme_mod( 'blog_section_option', 'enable' ) == 'enable' ) {
            get_template_part( 'template-parts/sections/section', 'blog' );
        }
        
    ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
