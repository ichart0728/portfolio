<?php
/**
 * Template display the content of Footer contact section at home page
 * 
 * @package The Monday
 */
?>
<section class="footer-section" id="tm-section-footer_contact">
    <div class="map">
        <?php
            if ( is_active_sidebar( 'the_monday_footer_map' ) ) {
                if ( !dynamic_sidebar( 'the_monday_footer_map' ) ):
                endif;
            } 
        ?>
    </div>
    <div class="holder">
        <div class="contact-info">
            <h2><?php echo esc_attr( get_theme_mod( 'footer_contact_section_title', __( 'Get In Touch', 'the-monday' ) ) ); ?></h2>
            <?php
                $default_contact_icon = array( '', 'fa-map-marker', 'fa-envelope', 'fa-phone', 'fa-fax' );
                $default_contact_title = array( '', __( 'Located In', 'the-monday' ), __( 'Mail Us &#64;', 'the-monday' ), __( 'Call Us on', 'the-monday' ), __( 'Fax Us', 'the-monday' ) );
                $default_contact_info = array( '', __( 'Mathuri Sadan, 5th floor Ravi Bhawan, Kathmandu, Nepal', 'the-monday' ), __( 'info@accesspressthemes.com', 'the-monday' ), __( '+977 989545212', 'the-monday' ), __( '+977 984545212', 'the-monday' ) );
                for ($i = 1; $i <= 4; $i++) {
                    $contact_icon = get_theme_mod( 'footer_contact_icon_' . $i, $default_contact_icon[$i] );
                    $contact_title = get_theme_mod( 'footer_contact_title_' . $i, $default_contact_title[$i] );
                    $contact_info = get_theme_mod( 'footer_contact_info_' . $i, $default_contact_info[$i] );
            ?>
            <div class="cnt-wrapper" id="footer-cnt<?php echo absint($i); ?>">
                <div class="cnt-info">
                    <h5><?php echo esc_attr( $contact_title );?></h5>
                    <span><?php echo esc_attr( $contact_info );?></span>
                </div>
                <div class="icon-holder">
                    <i class="fa <?php echo esc_attr( $contact_icon );?>"></i>
                </div>
            </div>
            <?php 
                }
            ?>
        </div>
        <div class="clear"></div>
    </div>
 </section>