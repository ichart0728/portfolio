<?php
/**
 * Template for header slider
 *
 * @package The Monday
 */

if ( ! function_exists( 'the_monday_slider_template' ) ) :
function the_monday_slider_template() {
    $home_header_type = get_theme_mod( 'front_header_type', 'image' );
    
	if ( $home_header_type == 'slider' && is_front_page() ) {

    //Get the slider options
    $image_speed      = get_theme_mod( 'slider_speed', '4000' );
    $slider_category = get_theme_mod( 'slider_category' );
    if( !empty( $slider_category ) ) {
	?>

	<div id="slideshow" class="header-slider" data-speed="<?php echo esc_attr( $image_speed ); ?>">
	    <div class="slides-container">
		    <?php 
                $sticky_post = get_option( 'sticky_posts' );
                $slider_args = array(
                                  'cat'                 => $slider_category,
                            	  'ignore_sticky_posts' => 1,
                            	  'post__not_in'        => $sticky_post,
                                  'post_status' => 'publish',
                                  'posts_per_page' => -1,
                                  'order'=> 'DESC'  
                                    );
                $slider_image_query = new WP_Query( $slider_args );
                if( $slider_image_query->have_posts() ){
                    while( $slider_image_query->have_posts() ){
                        $slider_image_query->the_post();
                        if( has_post_thumbnail() ) {
                            $slider_image_id = get_post_thumbnail_id();
                            $slider_image = wp_get_attachment_image_src( $slider_image_id, 'full', true );
                            $slider_image_alt = get_post_meta( $slider_image_id, '_wp_attachement_image_alt', true );
            ?>
                <div class="single-slides">
                    <img src="<?php echo esc_url( $slider_image[0] ); ?>" alt="<?php echo esc_attr( $slider_image_alt ); ?>">
                    <div class="holder">
                        <div class="tm-slider-caption">
                            <div class="caption-title animated fadeInLeftBig"><?php the_title(); ?></div>
                            <div class="caption-desc animated fadeInRightBig"><?php the_content(); ?></div>
                        </div>
                    </div>
                </div>
            <?php
                        }
                    }
                }
                wp_reset_query();
			?>
	    </div>        
	</div>
	<?php
    }
	}
    elseif ( get_theme_mod( 'front_header_type', 'image' ) == 'image' && is_front_page() ) {
        $default_front_header_image = THE_MONDAY_IMAGES_URL . '/front-header.jpg';
        $front_header_image_url = get_theme_mod( 'front_header_image', $default_front_header_image );
        $header_image_caption = get_theme_mod( 'front_image_caption', __( 'Most Powerfull', 'the-monday' ) );
        $header_image_description = get_theme_mod( 'front_image_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'the-monday' ) );
 ?>
    <div class="header-image-wrapper">
        <div class="front-header-image" style="background-image: url( '<?php echo esc_url( $front_header_image_url );?>' );">
        </div>
        <div class="holder">
            <div class="header-img-caption">
                <h1><?php echo esc_attr( $header_image_caption ); ?></h1>
                <p><?php echo wp_kses_post( $header_image_description );?></p>
            </div>
        </div><!-- .holder -->
    </div><!-- .header-image-wrapper -->
 <?php      
    }
}
endif;

if( !function_exists( 'the_monday_innerpage_head_section' ) ):
    function the_monday_innerpage_head_section() {
        $default_inner_header_image = THE_MONDAY_IMAGES_URL . '/inner-header.jpg';
        $inner_header_image_url = get_theme_mod( 'inner_header_image', $default_inner_header_image );
 ?>
    <div class="header-image-wrapper">
        <div class="inner-header-image">
            <?php if( !empty( $inner_header_image_url ) ) { ?>
                <img src="<?php echo esc_url( $inner_header_image_url ); ?>" />
            <?php } else { ?>
                <img src="<?php echo esc_url( $default_inner_header_image ); ?>" />
            <?php } ?>
            <div class="overlay"></div>
        </div> 
    </div>
 <?php
    }
endif;
?>