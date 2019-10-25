<?php
/**
 * Template display the content of Our Team Members section at home page
 * 
 * @package The Monday
 */
?>

<section class="team" id="tm-section-team">
    <div class="holder">
        <h2><?php echo esc_attr( get_theme_mod( 'team_section_title', __( 'Meet Our Team', 'the-monday' ) ) ); ?></h2>
        <!--<div class="text"><p></p></div>-->
        <div class="four-col">
        <?php
            $postsnum_type = get_theme_mod( 'team_posts_option', 'allposts' );
            if ( $postsnum_type == 'allposts' ) {
                $posts_per_page = -1;
            } else {
                $posts_per_page = get_theme_mod( 'team_posts_count', '4' );
            }
            $team_args = array(
                'post_type' => 'team-members',
                'post_status' => 'publish',
                'posts_per_page' => $posts_per_page,
                'order' => 'DESC'
            );
            $team_query = new WP_Query( $team_args );
            if ( $team_query->have_posts() ) {
                while ( $team_query->have_posts() ) {
                    $team_query->the_post();
                    $post_id = get_the_ID();
                    $image_id = get_post_thumbnail_id();
                    $image_path = wp_get_attachment_image_src( $image_id, 'the-monday-team-thumb', true );
                    $member_position = get_post_meta( $post_id, 'ap_cpt_member_position', true );
                    $member_fb_link = get_post_meta( $post_id, 'ap_cpt_member_fb_link', true );
                    $member_tw_link = get_post_meta( $post_id, 'ap_cpt_member_tw_link', true );
                    $member_gp_link = get_post_meta( $post_id, 'ap_cpt_member_gp_link', true );
                    $member_lnk_link = get_post_meta( $post_id, 'ap_cpt_member_lnk_link', true );
        ?>
            <div class="team-member">
                <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo esc_url( $image_path[0] )?>" alt="<?php the_title();?>" />
                </a>
                <div class="team-info">
                    <h5 class="member-name"><?php the_title();?></h5>
                    <span class="member-postion"><?php echo esc_attr( $member_position );?></span>
                </div>
                <div class="social-icon">
                    <ul>
                        <?php if( !empty( $member_tw_link ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url( $member_tw_link );?>" target="_blank" class="twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if( !empty( $member_fb_link ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url( $member_fb_link );?>" target="_blank" class="facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if( !empty( $member_gp_link ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url( $member_gp_link );?>" target="_blank" class="google">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if( !empty( $member_lnk_link ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url( $member_lnk_link );?>" target="_blank" class="linkedin">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php
                }
            }
            wp_reset_query();
        ?>
        </div><!-- .four-col -->
    </div><!-- .holder -->
</section>