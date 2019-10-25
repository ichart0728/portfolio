<?php
/**
 * Template display the Product for Featured Product section at home page
 * 
 * @package The Monday
 */
?>
<section class="specialized" id="tm-section-featured_product">
<?php
    $product_args = array(
        'post_type' => 'products',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'order' => 'DESC'
    );
    $product_query = new WP_Query( $product_args );
    if ( $product_query->have_posts() ) {
        while ( $product_query->have_posts() ) {
            $product_query->the_post();
            $post_id = get_the_ID();
            $image_id = get_post_thumbnail_id();
            $image_path = wp_get_attachment_image_src( $image_id, 'full', true );
            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
            $product_features = get_post_meta( $post_id, 'product_feature', true );
?>
    <div class="specialized-img" style="background: url( '<?php echo esc_url( $image_path[0] );?>' ); background-position: center center; background-repeat: no-repeat; background-size: cover;">       
    </div>
    <div class="holder">    
        <div class="specialized-content">
            <div class="text">
                <h2><?php echo esc_attr( get_theme_mod( 'featired_product_section_title', __( 'We Are Also Specialized In', 'the-monday' ) ) ); ?></h2>
                <p><?php echo esc_html( get_theme_mod( 'featired_product_section_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'the-monday' ) ) );?></p>
            </div>
            <?php
                foreach ( $product_features as $feature ) {
                    $feature_name = $feature['feature_name'];
                    $feature_description = $feature['feature_description'];
                    $feature_icon = $feature['feature_icon'];
            ?>   
                <div class="row">
                    <div class="icon-holder">
                        <i class="fa <?php echo esc_attr( $feature_icon );?>"></i>
                    </div>
                    <div class="info">
                        <h6><?php echo esc_attr( $feature_name );?></h6>
                        <p><?php echo esc_attr( $feature_description );?></p>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php 
                }
            ?>
        </div>
    </div>
    <div class="clear"></div>
<?php 
        }
    }
?>
</section>