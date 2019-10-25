<?php
/**
 * Template display the content of Portfolio Custom Post Type in Portfolio section at home page
 * 
 * @package The Monday
 */
?>
<section class="portfolio" id="tm-section-portfolio">
    <div class="holder">
        <div class="text">
            <h2><?php echo esc_attr( get_theme_mod( 'portfolio_section_title', __( 'What Have We Done So Far?', 'the-monday' ) ) ); ?></h2>
            <!--<p></p>-->
        </div>
        <?php if(class_exists('CPT_Class')) : ?>
            <?php
                $categories = get_terms( 'portfolio_category' );
                if ( !empty( $categories ) ) {
            ?>
            <div class="filter-wrapper">
                <ul class="protfolios-filter" id="filters">
                    <li class="cat-item tm-catname active" id="cat-item-0">
                        <a href="javascript:void(0)" data-filter="*"><?php esc_html_e( 'All', 'the-monday' );?></a>
                    </li>
                <?php 
                    foreach ( $categories as $category ) {
                        $term_link = get_term_link( $category );
                ?>
                    <li class="cat-item tm-catname" id="cat-item-<?php echo esc_attr( $category->term_id );?>">
                        <a href="javascript:void(0)" data-filter=".<?php echo esc_attr( $category->slug );?>"><?php echo esc_attr( $category->name ); ?></a>
                    </li>
                <?php    
                    }
                ?>
                </ul>
            </div><!-- .filter-wrapper -->
            <div class="projects-wrapper" id="protfolios-gallery-container">
                <?php
                    }
                    $portfolios_args = array(
                                'post_type' => 'portfolios',
                                'post_status' => 'publish',
                                'posts_per_page' => -1,
                                'order' => 'DESC',
                            );
                    $portfolios_query = new WP_Query( $portfolios_args );
                    if ( $portfolios_query->have_posts() ) {
                        while ( $portfolios_query->have_posts() ) {
                            $portfolios_query->the_post();
                            $post_id = get_the_ID();
                            $image_id = get_post_thumbnail_id();
                            $image_path = wp_get_attachment_image_src( $image_id, 'the-monday-project-thumb', true );
                            $image_alt = get_post_meta( $image_id, '_wp_attachement_image_alt', true );
                            $term_list = wp_get_post_terms( $post_id, 'portfolio_category', array( "fields" => "all" ) );
                            $termsString = '';
                            foreach ( $term_list as $term ) {
                                $termsString .= $term->slug . ' ';
                                $term_name = $term->name;
                            }
                            $project_custom_link = get_post_meta( $post_id, 'ap_cpt_project_custom_link', true );
                            if( !empty( $project_custom_link ) ) {
                                $project_permalink = esc_url( $project_custom_link );
                                $target_option = '_blank';
                            } else {
                                $project_permalink = get_the_permalink();
                                $target_option = '';
                            }
                ?>
                <div class="col project-item item isotope-item <?php echo esc_attr( $termsString );?>">
                    <a href="<?php echo esc_url($project_permalink); ?>" target="<?php echo esc_attr( $target_option ); ?>"><img src="<?php echo esc_url( $image_path[0] );?>" alt="<?php echo esc_attr( $image_alt );?>" title="<?php the_title();?>" /></a>
                    <div class="caption">
                        <div class="brief">
                            <h5><?php the_title();?></h5>
                            <span><?php echo esc_attr( $term_name );?></span>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                }
                ?>
            </div><!-- #protfolios-gallery-container -->
        <?php endif; ?>
    </div>  
</section>