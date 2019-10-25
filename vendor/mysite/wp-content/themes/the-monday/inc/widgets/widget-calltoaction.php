<?php
/**
 * Call to Action widget used in various section at homepage.
 * 
 * Adds The Monday Call to Action widget.
 *
 * @package The Monday
 */
add_action( 'widgets_init', 'the_monday_register_call_to_action_widget' );

function the_monday_register_call_to_action_widget() {
    register_widget( 'the_monday_call_to_action' );
}

class The_Monday_Call_to_Action extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'the_monday_call_to_action', 'The Monday : Call to Action', array(
                'description' => __( 'A widget that shows Call to Action.', 'the-monday' )
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'cta_title' => array(
                'the_monday_widgets_name' => 'cta_title',
                'the_monday_widgets_title' => __( 'Call to Action Title', 'the-monday' ),
                'the_monday_widgets_field_type' => 'text',
            ),
            'cta_info' => array(
                'the_monday_widgets_name' => 'cta_info',
                'the_monday_widgets_title' => __( 'Call to Action Description', 'the-monday' ),
                'the_monday_widgets_field_type' => 'textarea',
                'the_monday_widgets_row' => '5'
            ),
            'cta_upload' => array(
                'the_monday_widgets_name' => 'cta_upload',
                'the_monday_widgets_title' => __( 'Section background Image', 'the-monday' ),
                'the_monday_widgets_field_type' => 'upload',
            ),
            'cta_button_url' => array(
                'the_monday_widgets_name' => 'cta_button_url',
                'the_monday_widgets_title' => __( 'Button Url', 'the-monday' ),
                'the_monday_widgets_field_type' => 'url',
            ),
            'cta_button_text' => array(
                'the_monday_widgets_name' => 'cta_button_text',
                'the_monday_widgets_title' => __( 'Button Text', 'the-monday' ),
                'the_monday_widgets_field_type' => 'text',
            ),
        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);
        if( empty( $instance ) ) {
            return ;
        }
        $cta_bg_image = $instance['cta_upload'];
        $cta_title = $instance['cta_title'];
        $cta_description = $instance['cta_info'];
        $cta_button_url = $instance['cta_button_url'];
        $cta_button_text = $instance['cta_button_text'];

        echo wp_kses_post($before_widget);

        $attachment_id = the_monday_get_attachment_id_from_url( $cta_bg_image );
        if ( !empty( $attachment_id ) ) {
            $image = wp_get_attachment_image_src( $attachment_id, 'thumbnail', true );
            $image_link = $image[0];
            $image_full = wp_get_attachment_image_src( $attachment_id, 'full' );
            $image_full_link = $image_full[0];                    
        } else {
            $image_link = $cta_bg_image;
            $$image_full_link = $cta_bg_image;                    
        }            
        ?>
        <div class="cta-wrapper">
            <div class="holder">
                <div class="text-holder">   
                    <h2><?php echo esc_attr( $cta_title ); ?></h2>
                    <span><?php echo esc_html( $cta_description );?></span>
                </div>
                <div class="btn-holder">
                    <a href="<?php echo esc_url( $cta_button_url );?>"><?php echo esc_attr( $cta_button_text );?></a>
                </div>
            </div>
        </div>  

        <?php
        if ( !empty( $attachment_id ) ) {
            ?>
            <style>
                .cta-wrapper {
                    background-image: url('<?php echo esc_url( $image_full_link ); ?>');
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                }
            </style>
            <?php
        }
        echo wp_kses_post($after_widget);
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	the_monday_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$the_monday_widgets_name] = the_monday_widgets_updated_field_value( $widget_field, $new_instance[$the_monday_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	the_monday_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $the_monday_widgets_field_value = !empty( $instance[$the_monday_widgets_name]) ? esc_attr($instance[$the_monday_widgets_name] ) : '';
            the_monday_widgets_show_widget_field( $this, $widget_field, $the_monday_widgets_field_value );
        }
    }

}
