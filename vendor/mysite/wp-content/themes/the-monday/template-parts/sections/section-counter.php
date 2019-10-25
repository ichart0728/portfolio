<?php
/**
 * Template display the Static Counter section at home page
 * 
 * @package The Monday
 */
?>
<section class="static-counter" id="tm-section-counter">
    <div class="holder">
        <div class="four-col">
        <?php
            $default_counter_icon = array( '', __( "fa-code", "the-monday" ), __( 'fa-beer', 'the-monday' ), __( 'fa-rocket', 'the-monday' ), __( 'fa-trophy', 'the-monday' ) );
            $default_counter_number = array( '', '76294', '40', '350', '72' );
            $default_counter_title = array( '', __( 'Lines of Code', 'the-monday' ), __( 'Mugs of Beer', 'the-monday' ), __( 'Completed Projects', 'the-monday' ), __( 'Awards Achieved', 'the-monday' ) );
            $array_counter = count( $default_counter_icon );
            for ( $i = 1; $i < $array_counter; $i++ ) {
                $counter_icon = get_theme_mod( 'static_counter_icon_' . $i, $default_counter_icon[$i] );
                $counter_number = get_theme_mod( 'static_counter_number_' . $i, $default_counter_number[$i] );
                $counter_title = get_theme_mod( 'static_counter_title_' . $i, $default_counter_title[$i] );
                if( !empty( $counter_icon ) || !empty( $counter_number ) || !empty( $counter_title ) ) {
        ?>
                <div class="col" id="counter-post-<?php echo absint($i); ?>">
                    <div class="icon-holder icon<?php echo absint($i); ?>">
                        <i class="fa <?php echo esc_attr( $counter_icon );?>"></i>
                    </div>
                    <h4 class="counter"><?php echo esc_attr( $counter_number ); ?></h4>
                    <span class="counter-title"><?php echo esc_attr( $counter_title ); ?></span>
                </div>
        <?php
                }
            }
        ?>
        </div>
    </div>
</section>