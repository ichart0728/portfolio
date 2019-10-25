<?php
/**
 * The Monday Custom calsses and definitions
 *
 * @package The Monday
 * 
 */
 
if ( class_exists( 'WP_Customize_Control' ) ) {
    
    class The_Monday_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         *
         * @since 3.4.0
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select Category &mdash;', 'the-monday' ),
                    'option_none_value' => 0,
                    'selected'          => $this->value(),
                )
            );
 
            // Hackily add in the data link parameter.
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span><span class="description customize-control-description">%s</span> %s </label>',
                esc_html($this->label),
                esc_html($this->description),
                $dropdown
            );
        }
    }
    
    /**
     * Cutomize control for switch option
     */
    
    class The_Monday_Customize_Switch_Control extends WP_Customize_Control {
  		public $type = 'switch';    
  		public function render_content() {
  		?>
  			<label>
  				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
  		        <div class="switch_options">
                    <span class="switch_enable"> <?php esc_html_e('Enable', 'the-monday'); ?> </span>
                    <span class="switch_disable"> <?php esc_html_e('Disable', 'the-monday'); ?> </span>  
                    <input type="hidden" id="enable_switch_option" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" />
                </div>
            </label>
  		<?php
  		}
	}
    
    /**
     * Cutomize control for switch option Yes/No
     */    
    class The_Monday_Customize_Switch_Yesno_Control extends WP_Customize_Control {
		public $type = 'yn_switch';    
		public function render_content() {
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		        <div class="yes_no_switch_options">
                    <span class="switch_enable"> <?php esc_html_e('Yes', 'the-monday'); ?> </span>
                    <span class="switch_disable"> <?php esc_html_e('No', 'the-monday'); ?> </span>  
                    <input type="hidden" id="enable_switch_option_yesno" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" />
                </div>
            </label>
		<?php
		}
	}
    
    /**
     * Theme info 
     */
     class The_Monday_Theme_Info extends WP_Customize_Control {
        public $type = 'theme_info';
        public $label = '';
        public function render_content() {
        ?>
            <label class="customize-control-select">
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
            </label>
        <?php
        }
    }
    
    /**
     * Multiple settings seperatior
     */
    class The_Monday_Settings_Seperator extends WP_Customize_Control {
        public $type = 'settings_seperator';
        public $label = '';
        public function render_content() {
        ?>
            <h3 style="margin-top:30px;border:1px solid;padding:5px;color:#58719E;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
    
    /**
     * Customize for textarea, extend the WP customizer
     */
    class The_Monday_Textarea_Custom_Control extends WP_Customize_Control{
    	/**
    	 * Render the control's content.
    	 * 
    	 */
    	public $type = 'the_monday_textarea';
        public function render_content() {
    		?>
    		<label>
    			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?>>
        			<?php echo esc_textarea( $this->value() ); ?>
        		</textarea>
    		</label>
    	<?php
    	}
    }

    /**
     * Customize for textarea, extend the WP customizer
     *
     * @since 1.2.7
     */
    class The_Monday_Range_Custom_Control extends WP_Customize_Control{
        /**
         * Render the control's content.
         * 
         */
        public $type = 'the_monday_range';
        public function render_content() {
            $int_attrs = $this->input_attrs;
            foreach ($int_attrs as $key => $value) {
                $$key = $value;
            }
    ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <span <?php $this->link(); ?>  value="<?php echo intval( $this->value() ); ?>" class="tmp-range-value-size"></span>
                <div class="tmp-control-range-size" data-min="<?php echo intval( $min ); ?>" data-max="<?php echo intval( $max ); ?>" data-step="<?php echo intval( $step ); ?>" value="<?php echo intval( $this->value() ); ?>"></div>
            </label>
            <?php //var_dump( $this->input_attrs() ); ?>
        <?php
        }
    }
    
    /**
     * Image control by radtion button 
     */
    class The_Monday_Image_Radio_Control extends WP_Customize_Control {

 		public function render_content() {

			if ( empty( $this->choices ) )
				return;

			$name = '_customize-radio-' . $this->id;

			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<ul class="controls" id ="the-monday-img-container">
			<?php
				foreach ( $this->choices as $value => $label ) :
					$class = ($this->value() == $value)?'the-monday-radio-img-selected the-monday-radio-img-img':'the-monday-radio-img-img';
					?>
					<li class="inc-radio-image">
					<label>
						<input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
						<img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo esc_attr($class); ?>' />
					</label>
					</li>
					<?php
				endforeach;
			?>
			</ul>
			<?php
		}
	}
    
    /**
     * Typography
     * 
     * A class to create a dropdown for all categories in your wordpress site
     * 
     */     
    class The_Monday_Typography_Dropdown extends WP_Customize_Control {
        public $type = 'select';
        /**
         * Render the content of the category dropdown
         *
         * @return HTML
         */
        public function render_content() {
    ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
            <select class="typography-selected" data-customize-setting-link="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" id="<?php echo esc_attr($this->id); ?>">
                <option value=" "><?php esc_html_e( 'Choose Fonts', 'the-monday' );?></option>
                <option value="Open Sans"><?php esc_html_e( 'Open Sans', 'the-monday' ); ?></option>
                <option value="Roboto"><?php esc_html_e( 'Roboto', 'the-monday' ); ?></option>
                <option value="Arimo"><?php esc_html_e( 'Arimo', 'the-monday' ); ?></option>
                <option value="Oswald"><?php esc_html_e( 'Oswald', 'the-monday' ); ?></option>
                <option value="Lato"><?php esc_html_e( 'Lato', 'the-monday' ); ?></option>
                <option value="PT Sans"><?php esc_html_e( 'PT Sans', 'the-monday' ); ?></option>
                <option value="Raleway"><?php esc_html_e( 'Raleway', 'the-monday' ); ?></option>
                <option value="Ubuntu"><?php esc_html_e( 'Ubuntu', 'the-monday' ); ?></option>
                <option value="Montserrat"><?php esc_html_e( 'Montserrat', 'the-monday' ); ?></option>
                <option value="Merriweather"><?php esc_html_e( 'Merriweather', 'the-monday' ); ?></option>
                <option value="Lora"><?php esc_html_e( 'Lora', 'the-monday' ); ?></option>
                <option value="Bitter"><?php esc_html_e( 'Bitter', 'the-monday' ); ?></option>
                <option value="Lobster"><?php esc_html_e( 'Lobster', 'the-monday' ); ?></option>
                <option value="Arvo"><?php esc_html_e( 'Arvo', 'the-monday' ); ?></option>
                <option value="Oxygen"><?php esc_html_e( 'Oxygen', 'the-monday' ); ?></option>
                <option value="Dosis"><?php esc_html_e( 'Dosis', 'the-monday' ); ?></option>
                <option value="Cabin"><?php esc_html_e( 'Cabin', 'the-monday' ); ?></option>
                <option value="Muli"><?php esc_html_e( 'Muli', 'the-monday' ); ?></option>
            </select>
        </label>
    <?php
        }
    }

    /**
     * Multiple checkbox customize control class.
     *
     * @since  1.0.0
     * @access public
     */
    class The_Monday_Customize_Control_Checkbox_Multiple extends WP_Customize_Control {

        /**
         * The type of customize control being rendered.
         *
         * @since  1.2.7
         * @access public
         * @var    string
         */
        public $type = 'checkbox-multiple';

        /**
         * Displays the control content.
         *
         * @since  1.2.7
         * @access public
         * @return void
         */
        public function render_content() {

            if ( empty( $this->choices ) )
                return; ?>

            <?php if ( !empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php endif; ?>

            <?php if ( !empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>

            <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

            <ul>
                <?php foreach ( $this->choices as $value => $label ) : ?>

                    <li>
                        <label>
                            <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
                            <?php echo esc_html( $label ); ?>
                        </label>
                    </li>

                <?php endforeach; ?>
            </ul>

            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
        <?php }
    }

    /**
     * Pro customizer section.
     *
     * @since  1.0.0
     * @access public
     */
    class The_Monday_Customize_Section_Pro extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'monday-pro';

        /**
         * Custom button text to output.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_text = '';

        /**
         * Custom pro button URL.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_url = '';

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function json() {
            $json = parent::json();
            $json['pro_text'] = $this->pro_text;
            $json['pro_url']  = esc_url( $this->pro_url );
            return $json;
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        protected function render_template() { ?>

            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
                <h3 class="accordion-section-title">
                    {{ data.title }}
                    <# if ( data.pro_text && data.pro_url ) { #>
                        <a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
                    <# } #>
                </h3>
            </li>
        <?php }
    }
    
}