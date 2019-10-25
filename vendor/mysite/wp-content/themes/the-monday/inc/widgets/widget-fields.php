<?php
/**
 * Define custom fields for widgets
 * 
 * @package The Monday
 */
function the_monday_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {
    
    extract( $widget_field );

    switch ( $the_monday_widgets_field_type ) {

        // Standard text field
        case 'text' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id( $the_monday_widgets_name )); ?>"><?php echo esc_html($the_monday_widgets_title); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr($instance->get_field_id( $the_monday_widgets_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $the_monday_widgets_name )); ?>" type="text" value="<?php echo esc_html($athm_field_value); ?>" />

                <?php if ( isset( $the_monday_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html($the_monday_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Standard url field
        case 'url' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id( $the_monday_widgets_name )); ?>"><?php echo esc_html($the_monday_widgets_title); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr($instance->get_field_id( $the_monday_widgets_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $the_monday_widgets_name )); ?>" type="text" value="<?php echo esc_url($athm_field_value); ?>" />

                <?php if ( isset( $the_monday_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html($the_monday_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Textarea field
        case 'textarea' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id( $the_monday_widgets_name )); ?>"><?php echo esc_html($the_monday_widgets_title); ?>:</label>
                <textarea class="widefat" rows="<?php echo esc_attr($the_monday_widgets_row); ?>" id="<?php echo esc_attr($instance->get_field_id( $the_monday_widgets_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $the_monday_widgets_name )); ?>"><?php echo esc_textarea($athm_field_value); ?></textarea>
            </p>
            <?php
            break;

        case 'upload' :

            $id = $instance->get_field_id( $the_monday_widgets_name );
            $class = '';
            $int = '';
            $value = $athm_field_value;
            $name = $instance->get_field_name( $the_monday_widgets_name );


            if ( $value ) {
                $class = ' has-file';
                $value = explode( 'wp-content', $value );
                $value = content_url().$value[1];
            }
            ?>
            <div class="sub-option widget-upload">
            <label for="<?php echo esc_attr($instance->get_field_id( $the_monday_widgets_name )); ?>"><?php esc_html($the_monday_widgets_title); ?></label><br/>
            <input id="<?php echo esc_attr($id); ?>" class="upload<?php echo esc_attr($class); ?>" type="text" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_url($value); ?>" placeholder="<?php esc_html_e( 'No file chosen', 'the-monday' ); ?>" />
            <?php
            if ( function_exists( 'wp_enqueue_media' ) ) {
                if ( ( $value == '') ) {
                    ?>
                    <input id="upload-<?php echo esc_attr($id); ?>" class="upload-button-widget button" type="button" value="<?php esc_html_e( 'Upload', 'the-monday' ); ?>" />
                    <?php
                } else {
                    ?>
                    <input id="remove-<?php echo esc_attr($id); ?>" class="remove-file button" type="button" value="<?php echo esc_html__( 'Remove', 'the-monday' ); ?>" />
                    <?php
                }
            } else {
                ?>
                <p><i><?php esc_html_e( 'Upgrade your version of WordPress for full media support.', 'the-monday' ); ?></i></p>
                <?php
            }

            ?>
            <div class="screenshot upload-thumb" id="<?php echo esc_attr($id); ?>-image">
            <?php

            if ($value != '') {
                $attachment_id = the_monday_get_attachment_id_from_url( $value );
                $image_array = wp_get_attachment_image_src( $attachment_id, 'medium' );
                $image = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value );
                if ($image) {
                    ?>
                    <img src="<?php echo esc_url($image_array[0]); ?>" alt="" />
                    <?php
                } else {
                    $parts = explode( "/", $value );
                    for ( $i = 0; $i < sizeof( $parts ); ++$i ) {
                        $title = $parts[$i];
                    }

                    ?>
                    <div class="no-image"><span class="file_link"><a href="<?php esc_url($value); ?>" target="_blank" rel="external"><?php esc_html_e( 'View File', 'the-monday' ); ?></a></span></div>
                    <?php
                }
            }
            ?>
            </div>
            </div>
            <?php
            break;

    }
}

function the_monday_widgets_updated_field_value( $widget_field, $new_field_value ) {

    extract( $widget_field );

    // Allow only integers in number fields
    if ( $the_monday_widgets_field_type == 'number') {
        return the_monday_sanitize_number( $new_field_value );

        // Allow some tags in textareas
    } elseif ( $the_monday_widgets_field_type == 'textarea' ) {
        // Check if field array specifed allowed tags
        if ( !isset( $the_monday_widgets_allowed_tags ) ) {
            // If not, fallback to default tags
            $the_monday_widgets_allowed_tags = '<p><strong><em><a>';
        }
        return strip_tags( $new_field_value, $the_monday_widgets_allowed_tags );

        // No allowed tags for all other fields
    } elseif ( $the_monday_widgets_field_type == 'url' ) {
        return esc_url( $new_field_value );
    } else {
        return strip_tags( $new_field_value );
    }
}

/**
 * Enqueue scripts for file uploader
 */
global $pagenow;
function the_monday_widget_admin_scripts( $hook ) {
    if ( ( $hook == 'widgets.php' || $hook == 'customize.php' ) ) {
    if ( function_exists( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }
    wp_register_script( 'ap-widget-js', get_template_directory_uri() . '/inc/admin/js/media-uploader.js', array('jquery') );
    wp_enqueue_script( 'ap-widget-js' );
    }
}
add_action( 'admin_enqueue_scripts', 'the_monday_widget_admin_scripts' );

