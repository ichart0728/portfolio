<?php
/**
 * Template display the content of Testimonilas section at home page
 * 
 * @package The Monday
 */
?>
<section class="testimonials" id="tm-section-testimonials">
    <div class="holder">
        <h2><?php echo esc_attr( get_theme_mod( 'testimonials_section_title', __( "Let's Hear What Clients Say", 'the-monday' ) ) ); ?></h2>
        <?php
            $postsnum_type = get_theme_mod( 'testimonials_posts_option', 'allposts' );
            if ( $postsnum_type == 'allposts' ) {
                $posts_per_page = -1;
            } else {
                $posts_per_page = get_theme_mod( 'tesimonials_posts_count', '3' );
            }
            $tesitmonials_args = array(
                'post_type' => 'testimonials',
                'post_status' => 'publish',
                'posts_per_page' => $posts_per_page,
                'order' => 'DESC'
            );
            $tesitmonials_query = new WP_Query( $tesitmonials_args );
            if ( $tesitmonials_query->have_posts() ) {
        ?>
            <ul class="slider" id="testimonials-slider">
                <?php 
                    while ( $tesitmonials_query->have_posts() ) {
                    $tesitmonials_query->the_post();
                    $post_id = get_the_ID();
                    $image_id = get_post_thumbnail_id();
                    $image_path = wp_get_attachment_image_src( $image_id, 'thumbnail', true );
                    $image_alt = get_post_meta( $image_id, '_wp_attachement_image_alt', true );
                    $author_position = get_post_meta( $post_id, 'ap_cpt_author_position', true );
                    $author_company = get_post_meta( $post_id, 'ap_cpt_author_company', true );
                ?>
                <li>
                    <div class="img-holder">
                        <figure><img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" /></figure>
                    </div>
                    <div class="title-name">
                        <h5 class="client-name"><?php the_title(); ?></h5>
                        <span class="client-company">
                            <?php
                                echo esc_attr( $author_position );
                                if ( !empty( $author_company ) ) {
                                    echo ', ' . esc_attr( $author_company );
                                }
                            ?>
                        </span>
                        <?php 
                            $get_post_content = get_the_content();
                            $post_content = the_monday_excerpt_word( $get_post_content, 50 );
                            echo '<p>'. esc_html($post_content) .'</p>';
                        ?>
                    </div>
                </li>
            <?php }//endwhile ?>
            </ul>
        <?php 
            }//endif 
            wp_reset_query();
        ?>
    </div>
</section>