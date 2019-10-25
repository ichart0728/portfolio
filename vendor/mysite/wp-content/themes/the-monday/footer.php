<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package The Monday
 */

?>  
    
    <!-- Section Footer Section -->
    <?php
    if ( get_theme_mod( 'footer_contact_section_option', 'enable' ) == 'enable' ) {
        get_template_part( 'template-parts/sections/section', 'footer-contact' );
    }
    ?>
    </div><!-- #content -->

</div>

	<footer id="colophon" class="site-footer clearfix" role="contentinfo">
        <?php get_sidebar( 'footer' ); ?>
		<div class="site-info">
		<div class="container">
                    <div class="tm-social-icons">
                <?php
                    if ( is_active_sidebar( 'the_monday_footer_social_icons' ) ) {
                        if ( !dynamic_sidebar( 'the_monday_footer_social_icons' ) ):
                        endif;
                    }
                ?>
           </div>
			<div class="theme-designer-section">
                <span class="copyright-text">
                    <?php 
                        $the_monday_copyright_content = get_theme_mod( 'the_monday_copyright_content', __( '&copy; 2015 The Monday', 'the-monday' ) );
                        if( !empty( $the_monday_copyright_content ) ) {
                            echo wp_kses_post( $the_monday_copyright_content );
                        }
                    ?>
                </span>
    			<span class="sep"> | </span>
                <?php printf( wp_kses( __( 'WordPress Theme: <a href="%s">The Monday</a> by AccessPress Themes', 'the-monday' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( 'https://accesspressthemes.com/wordpress-themes/the-monday/' ) ); ?>
                
           </div>
           
                </div><!-- .container-->
		</div><!-- .site-info -->
        
	</footer><!-- #colophon -->
    <a href="#masthead" id="scroll-up"><i class="fa fa-arrow-up"></i></a>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
