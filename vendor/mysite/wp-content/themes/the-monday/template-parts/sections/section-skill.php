<?php
/**
 * Template display the content of skill section at home page
 * 
 * @package The Monday
 */
?>
<section class="canvas" id="tm-section-skill">
    <div class="holder">
        <div class="text">
            <h2><?php echo esc_attr( get_theme_mod( 'skill_section_title', __( 'We Have Got Skills', 'the-monday' ) ) ); ?></h2>
            <p><?php echo esc_textarea( get_theme_mod( 'skill_section_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'the-monday' ) ) ); ?></p>
        </div>
        <div class="four-col">
        <?php
            $the_monday_primary_color = get_theme_mod( 'primary_color', '#2e8ecb' );
            $default_skill_title = array( '', __( 'Web Design', 'the-monday' ), __( 'Html/Css', 'the-monday' ), __( 'Graphic Design', 'the-monday' ), __( 'UI/UX', 'the-monday' ), __( 'Coding', 'the-monday' ), __( 'Seo', 'the-monday' ) );
            $default_skill_percentage = array( '', __( '90', 'the-monday' ), __( '75', 'the-monday' ), __( '70', 'the-monday' ), __( '85', 'the-monday' ), __( '70', 'the-monday' ), __( '100', 'the-monday' ) );
            for ( $i = 1; $i <= 4; $i++ ) {
                $skill_title = get_theme_mod( 'skill_title_' . $i, $default_skill_title[$i] );
                $skill_info = get_theme_mod( 'skill_info_' . $i, __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', 'the-monday' ) );
                $skill_percentage = get_theme_mod( 'skill_percent_' . $i, $default_skill_percentage[$i] );
        ?>
            <div class="col">
                <?php if ( !empty( $skill_percentage ) ) { ?>
                    <canvas class="loader skill-loader" data-percentage="<?php echo esc_attr( $skill_percentage );?>" color="<?php echo esc_attr( $the_monday_primary_color );?>"></canvas>
                <?php } ?>
                <div class="text-holder">
                    <h5 class="canvas-title"><?php echo esc_attr( $skill_title ); ?></h5>
                    <p><?php echo esc_html( $skill_info ); ?></p>
                </div>
            </div>
        <?php
            }
        ?>
        </div>
    </div>
 </section>