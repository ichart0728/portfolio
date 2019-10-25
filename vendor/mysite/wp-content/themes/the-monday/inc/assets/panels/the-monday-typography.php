<?php
/**
 * Typography Settings Panel for customizer page
 *
 * @package The Monday
 */
 
 
 

add_action( 'customize_register', 'the_monday_typography_customize_register');
function the_monday_typography_customize_register( $wp_customize ) {

	
	// Add the typography panel.
	$wp_customize->add_panel( 
        'the_monday_typography', 
        array( 
            'title' => esc_html__( 'Typography', 'the-monday' ),
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'priority' => 7, 
             ) 
    );

/*-------------------------------------------------------------------------------------------------------------------------------------------*/
     /**
      * Font Family dropdwon section
      */

	$wp_customize->add_section( 
        'the_monday_font_family', 
		array( 
            'title' => __( 'Font Family Options', 'the-monday' ),
            'panel' => 'the_monday_typography',
            'priority' => 3
             )
	);

	// Header typography
    $wp_customize->add_setting(
        'header_fonts',
        array(
            'default' => __( 'Ubuntu, sans-serif', 'the-monday' ),
            'sanitize_callback' => 'the_monday_sanitize_text',
            'transport' => 'postMessage'
            )
    );
	$wp_customize->add_control(
		new The_Monday_Typography_Dropdown(
			$wp_customize, 'header_fonts',
			array(
				'label'       => __( 'Header Fonts', 'the-monday' ),
				'description' => __( 'Choose a font for the heading H1, H2, H3, H4, H5, H6 text.', 'the-monday' ),
				'section'     => 'the_monday_font_family',
                'type'        => 'select',
                'priority'    => 3
			)
		)
	);
    
    // Body typography
    $wp_customize->add_setting(
        'body_fonts',
        array(
            'default' => __( 'Open Sans,sans-serif', 'the-monday' ),
            'sanitize_callback' => 'the_monday_sanitize_text',
            'transport' => 'postMessage'
            )
    );
	$wp_customize->add_control(
		new The_Monday_Typography_Dropdown(
			$wp_customize, 'body_fonts',
			array(
				'label'       => __( 'Body Fonts', 'the-monday' ),
				'description' => __( 'Choose fonts for body text', 'the-monday' ),
				'section'     => 'the_monday_font_family',
                'type'        => 'select',
                'priority'    => 4
			)
		)
	);

/*-------------------------------------------------------------------------------------------------------------------------------------------*/
     /**
      * Font size
      */
    
    $wp_customize->add_section( 
        'the_monday_font_size', 
		array( 
            'title' => __( 'Font Size', 'the-monday' ),
            'panel' => 'the_monday_typography',
            'priority' => 4
             )
	);
    
    //Home page section title   
    $wp_customize->add_setting(
        'home_section_title_size',
        array(
            'default' => '24',
            'sanitize_callback' => 'the_monday_sanitize_number',
        )
    );
    $wp_customize->add_control(
        'home_section_title_size',
        array(
            'type' => 'number',
            'priority' => 2,
            'label' => __( 'Section Title Size', 'the-monday' ),
            'description'   => __( 'Set the font size for section title.', 'the-monday' ),
            'section' => 'the_monday_font_size',
            'input_attrs' => array(
                'min'   => 1,
                'max'   => 100,
                'step'  => 1
                ),
            )
    );
    
    //Body Font size   
    $wp_customize->add_setting(
        'body_font_size',
        array(
            'default' => '14',
            'sanitize_callback' => 'the_monday_sanitize_number',
        )
    );
    $wp_customize->add_control(
        'body_font_size',
        array(
            'type' => 'number',
            'priority' => 3,
            'label' => __( 'Body Font Size', 'the-monday' ),
            'description'   => __( 'Set the font size for body text.', 'the-monday' ),
            'section' => 'the_monday_font_size',
            'input_attrs' => array(
                'min'   => 1,
                'max'   => 100,
                'step'  => 1
                ),
            )
    );
    
    //H1 Font size   
    $wp_customize->add_setting(
        'h1_font_size',
        array(
            'default' => '26',
            'sanitize_callback' => 'the_monday_sanitize_number',
        )
    );
    $wp_customize->add_control(
        'h1_font_size',
        array(
            'type' => 'number',
            'priority' => 4,
            'label' => __( 'H1 Font Size', 'the-monday' ),
            'description'   => __( 'Set the font size for H1 text.', 'the-monday' ),
            'section' => 'the_monday_font_size',
            'input_attrs' => array(
                'min'   => 1,
                'max'   => 100,
                'step'  => 1
                ),
            )
    );
    
    //H2 Font size   
    $wp_customize->add_setting(
        'h2_font_size',
        array(
            'default' => '24',
            'sanitize_callback' => 'the_monday_sanitize_number',
        )
    );
    $wp_customize->add_control(
        'h2_font_size',
        array(
            'type' => 'number',
            'priority' => 5,
            'label' => __( 'H2 Font Size', 'the-monday' ),
            'description'   => __( 'Set the font size for H2 text.', 'the-monday' ),
            'section' => 'the_monday_font_size',
            'input_attrs' => array(
                'min'   => 1,
                'max'   => 100,
                'step'  => 1
                ),
            )
    );
    
    //H3 Font size   
    $wp_customize->add_setting(
        'h3_font_size',
        array(
            'default' => '22',
            'sanitize_callback' => 'the_monday_sanitize_number',
        )
    );
    $wp_customize->add_control(
        'h3_font_size',
        array(
            'type' => 'number',
            'priority' => 6,
            'label' => __( 'H3 Font Size', 'the-monday' ),
            'description'   => __( 'Set the font size for H3 text.', 'the-monday' ),
            'section' => 'the_monday_font_size',
            'input_attrs' => array(
                'min'   => 1,
                'max'   => 100,
                'step'  => 1
                ),
            )
    );
    
    //H4 Font size   
    $wp_customize->add_setting(
        'h4_font_size',
        array(
            'default' => '20',
            'sanitize_callback' => 'the_monday_sanitize_number',
        )
    );
    $wp_customize->add_control(
        'h4_font_size',
        array(
            'type' => 'number',
            'priority' => 7,
            'label' => __( 'H4 Font Size', 'the-monday' ),
            'description'   => __( 'Set the font size for H4 text.', 'the-monday' ),
            'section' => 'the_monday_font_size',
            'input_attrs' => array(
                'min'   => 1,
                'max'   => 100,
                'step'  => 1
                ),
            )
    );
    
    //H5 Font size   
    $wp_customize->add_setting(
        'h5_font_size',
        array(
            'default' => '18',
            'sanitize_callback' => 'the_monday_sanitize_number',
        )
    );
    $wp_customize->add_control(
        'h5_font_size',
        array(
            'type' => 'number',
            'priority' => 8,
            'label' => __( 'H5 Font Size', 'the-monday' ),
            'description'   => __( 'Set the font size for H5 text.', 'the-monday' ),
            'section' => 'the_monday_font_size',
            'input_attrs' => array(
                'min'   => 1,
                'max'   => 100,
                'step'  => 1
                ),
            )
    );
    
    //H6 Font size   
    $wp_customize->add_setting(
        'h6_font_size',
        array(
            'default' => '16',
            'sanitize_callback' => 'the_monday_sanitize_number',
        )
    );
    $wp_customize->add_control(
        'h6_font_size',
        array(
            'type' => 'number',
            'priority' => 9,
            'label' => __( 'H6 Font Size', 'the-monday' ),
            'description'   => __( 'Set the font size for H6 text.', 'the-monday' ),
            'section' => 'the_monday_font_size',
            'input_attrs' => array(
                'min'   => 1,
                'max'   => 100,
                'step'  => 1
                ),
            )
    );
    
/*-------------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * Font Color 
     */
     
    $wp_customize->add_section( 
        'the_monday_font_color', 
		array( 
            'title' => __( 'Font Color', 'the-monday' ),
            'panel' => 'the_monday_typography',
            'priority' => 4
             )
	);
}    