<?php
/**
 * Template display the content of Our services section at home page
 * 
 * @package The Monday
 */
?>

<section class="services" id="tm-section-services">
    <div class="holder">
        <h2><?php echo esc_attr( get_theme_mod( 'service_section_title', __( 'Our Services', 'the-monday' ) ) ); ?></h2>
        <div class="four-col">
        <?php
            $services_args = array(
                'post_type' => 'services',
                'post_status' => 'publish',
                'posts_per_page' => 4,
            );
            $services_orderby = get_theme_mod( 'services_posts_orderby', 'none' );
            $services_order = get_theme_mod( 'services_posts_order', 'desc' );
            if ( $services_orderby == 'rand' ) {
                $services_args['orderby'] = $services_orderby;
            } elseif ( $services_orderby == 'none' ) {
                $services_args['order'] = $services_order;
            } else {
                $services_args['orderby'] = $services_orderby;
                $services_args['order'] = $services_order;
            }
            $services_query = new WP_Query( $services_args );
            if ( $services_query->have_posts() ) {
                while ( $services_query->have_posts() ) {
                    $services_query->the_post();
                    $post_id = get_the_ID();
                    $service_icon = get_post_meta( $post_id, 'ap_cpt_service_icon', true );
                    $service_custom_link = get_post_meta( $post_id, 'ap_cpt_service_link', true );
        ?>
            <div class="col">
                <div class="icon-holder">
                    <i class="fa <?php echo esc_attr( $service_icon )?>"></i>
                </div>
                <div class="title">
                <?php 
                    if( !empty( $service_custom_link ) ) {
                ?>
                    <a href="<?php echo esc_url( $service_custom_link );?>"><?php the_title();?></a>
                <?php
                    } else {
                        the_title();
                    }
                ?>
                </div>
                <span><?php the_excerpt();?></span>
            </div>
        <?php
                }
            }
            wp_reset_query();
        ?>
        </div>
    </div>
</section>