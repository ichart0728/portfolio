<?php
/**
 * Template display the content of Latest Blog section at home page
 * 
 * @package The Monday
 */
?>
<section class="plan" id="tm-section-price_tables">
    <div class="holder">
        <div class="text">
            <h2><?php echo esc_attr( get_theme_mod( 'price_tables_section_title', __( 'Chose Your Plan', 'the-monday' ) ) ); ?></h2>
            <p><?php echo esc_html( get_theme_mod( 'price_tables_section_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'the-monday' ) ) );?></p>
        </div>
        <div class="four-col">
        <?php
            $table_args = array(
                'post_type' => 'price-table',
                'post_status' => 'publish',
                'posts_per_page' => 4,
                'order' => 'DESC'
            );
            $table_query = new WP_Query( $table_args );
            $t_count = 0;
            if ( $table_query->have_posts() ) {
                while ( $table_query->have_posts() ) {
                    $t_count++;
                    $table_query->the_post();
                    $post_id = get_the_ID();
                    $table_icon = get_post_meta( $post_id, 'table_icon', true );
                    $table_tag = get_post_meta( $post_id, 'table_tag', true );
                    $table_price = get_post_meta( $post_id, 'table_price', true );
                    $table_price_per = get_post_meta( $post_id, 'table_price_per', true );
                    $table_button_link = get_post_meta( $post_id, 'table_button_link', true );
                    $table_button_text = get_post_meta( $post_id, 'table_button_text', true );
        ?>
            <div class="col table<?php echo esc_attr( $t_count );?>">
                <?php if( !empty( $table_tag ) ) { ?><div class="table-ribbon"><?php echo esc_attr( $table_tag );?></div><?php } ?>
                <h3><?php the_title();?></h3>
                <div class="icon-holder">
                    <?php if( !empty( $table_icon ) ) { ?>
                        <i class="fa <?php echo esc_attr( $table_icon );?>"></i>
                    <?php } ?>
                </div>
                <ul>
                <?php
                    $table_feature = get_post_meta( $post->ID, 'table_feature', true );
                    if ( !empty( $table_feature ) ) {
                        foreach ( $table_feature as $key => $value ) {
                ?>
                    <li><?php echo esc_attr( $value['pricing_feature'] ); ?></li>
                <?php
                        }
                    }
                ?>
                </ul>
                <div class="text1">     
                    <p><strong><?php echo esc_attr( '$', 'the-monday' ).esc_attr( $table_price ); ?></strong>/<?php echo esc_attr( $table_price_per ); ?></p>
                </div>
                <a href="<?php echo esc_url( $table_button_link );?>"><?php echo esc_attr( $table_button_text );?></a>
            </div>
        <?php
                }
            }
        ?>
        </div>
    </div>
</section>