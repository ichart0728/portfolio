<?php
/**
 * Template to display content of about us section at home page
 * 
 * @package The Monday
 */
?>
<section class="about" id="tm-section-about">
<?php
$about_page_id = get_theme_mod( 'about_section_page', '' );
if( !empty( $about_page_id ) && $about_page_id != '0' ) {
    $about_page_query = new WP_Query( 'page_id='.$about_page_id );
    if( $about_page_query->have_posts() ) {
        while( $about_page_query->have_posts() ) {
            $about_page_query->the_post();
            $image_id = get_post_thumbnail_id();
            $image_path = wp_get_attachment_image_src( $image_id, 'large', true );
            $section_button_text = get_theme_mod( 'about_section_button_text', __( 'Read More', 'the-monday' ) );
?>
    <div class="about-img" style="background: url('<?php echo esc_url( $image_path[0] );?>'); background-position: center top; background-repeat: no-repeat; background-size: cover;">     
    </div>
    <div class="holder">    
        <div class="about-content">
            <h2><?php the_title();?></h2>
            <?php 
                $about_get_content = get_the_content();
                $about_content = the_monday_excerpt_word( $about_get_content, 99 );
                echo '<p>'. esc_html($about_content) .'</p>';
            ?>
            <a href="<?php the_permalink();?>" class="read-btn"><?php echo esc_attr( $section_button_text );?></a>
        </div>
    </div>
<?php
        }//while 
    }//query if
}//right_page_id
?>
    <div class="clear"></div>
</section>