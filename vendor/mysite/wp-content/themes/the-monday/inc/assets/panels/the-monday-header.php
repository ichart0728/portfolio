<?php
/**
 * Header Settings Panel for customizer page
 *
 * @package The Monday
 */
 
add_action( 'customize_register', 'the_monday_header_settings_panel' );

function the_monday_header_settings_panel( $wp_customize ) {
    
    $wp_customize->remove_control( 'display_header_text' );
    
    $wp_customize->add_panel( 
        'the_monday_header_panel', 
            array(
                'priority'       => 4,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Header Settings', 'the-monday' ),
            ) 
    );
     
/*---------------------------------------------------------------------------------------------------*/
    /**
     * Header Type section 
     */
    $wp_customize->add_section(
        'the_monday_header_type',
        array(
            'title'         => __( 'Header type', 'the-monday' ),
            'priority'      => 10,
            'panel'         => 'the_monday_header_panel', 
            'description'   => __( 'You can select your header type from here. After that, continue below to the next two tabs (Header Slider and Header Image) and configure them.', 'the-monday' ),
        )
    );
    //Front page
    $wp_customize->add_setting(
        'front_header_type',
        array(
            'default'           => 'image',
            'sanitize_callback' => 'the_monday_sanitize_layout',
        )
    );
    $wp_customize->add_control(
        'front_header_type',
        array(
            'type'        => 'radio',
            'label'       => __( 'Front page header type', 'the-monday' ),
            'section'     => 'the_monday_header_type',
            'description' => __( 'Select the header type for your front page', 'the-monday' ),
            'choices' => array(
                'slider'    => __( 'Full screen slider', 'the-monday' ),
                'image'     => __( 'Image', 'the-monday' ),
                'nothing'   => __( 'No header (only menu)', 'the-monday' )
            ),
        )
    );
    
    // Whole Site except home page
    $wp_customize->add_setting(
        'inner_header_type',
        array(
            'default'           => 'image',
            'sanitize_callback' => 'the_monday_sanitize_inner_layout',
        )
    );
    $wp_customize->add_control(
        'inner_header_type',
        array(
            'type'        => 'radio',
            'label'       => __( 'Site header type', 'the-monday' ),
            'section'     => 'the_monday_header_type',
            'description' => __( 'Select the header type for all pages except the front page', 'the-monday' ),
            'choices' => array(
                'image'     => __( 'Image', 'the-monday' ),
                'nothing'   => __( 'No header (only menu)', 'the-monday' )
            ),
        )
    );  
/*------------------------------------------------------------------------------------------------------------*/
    /**
     * Header slider section
     */
     
    $wp_customize->add_section(
        'the_monday_header_slider',
        array(
            'title'         => __( 'Header Slider', 'the-monday' ),
            'description'   => __( 'You can select posts from category to use as header slider', 'the-monday' ),
            'priority'      => 11,
            'panel'         => 'the_monday_header_panel',
        )
    );
    
    $wp_customize->add_setting(
        'slider_category',
        array(
            'default' => 0,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'the_monday_sanitize_text'
        )
    );
    $wp_customize->add_control( 
        new The_Monday_Customize_Category_Control( 
        $wp_customize,
        'slider_category', 
        array(
            'label' => __( "Slider's Category", 'the-monday' ),
            'description' => __( "Select cateogry for Header slider", "the-monday" ),
            'section' => 'the_monday_header_slider',
            'priority' => 5
            )
        )
    );
    
    //Speed for image slider
    $wp_customize->add_setting(
        'slider_speed',
        array(
            'default' => '5000',
            'sanitize_callback' => 'the_monday_sanitize_number',
        )
    );
    $wp_customize->add_control( new The_Monday_Range_Custom_Control(
        $wp_customize, 
            'slider_speed', 
            array(
                'priority'  => 7,
                'label' => __( 'About Us Section', 'the-monday' ),
                'description' => __( 'Choose option to display About Us section at home page', 'the-monday' ),
                'section' => 'the_monday_header_slider',
                'input_attrs' => array(
                    'min'   => 1500,
                    'max'   => 25000,
                    'step'  => 50
                )
            )
        )
    );

/*---------------------------------------------------------------------------------------------------------*/
   /**
    * Select Front Page Header image section
    */
      
    $wp_customize->add_section(
        'the_monday_front_header_image_section',
        array(
            'title'         => __('Front Header Image', 'the-monday'),
            //'description'   => __('You can select posts from category to use as header slider', 'the-monday'),
            'priority'      => 12,
            'panel'         => 'the_monday_header_panel',
        )
    );
    
    // Front page header image settings
    $wp_customize->add_setting(
        'front_header_image',
        array(
            'default' => THE_MONDAY_IMAGES_URL . '/front-header.jpg',
            'sanitize_callback' => 'esc_url',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'front_header_image',
            array(
               'label'          => __( 'Upload your Header Image', 'the-monday' ),
               'section'        => 'the_monday_front_header_image_section',
               'priority'       => 4,
            )
        )
    );

    //Image caption
    $wp_customize->add_setting(
        'front_image_caption', 
            array(
                'default' => __( 'Most Powerfull', 'the-monday' ),
                'sanitize_callback' => 'the_monday_sanitize_text',
                'transport' => 'postMessage'
           )
    );    
    $wp_customize->add_control(
        'front_image_caption',
            array(
            'type' => 'text',
            'label' => __( 'Image Caption', 'the-monday' ),
            'section' => 'the_monday_front_header_image_section',
            'priority' => 5
            )
    );

    //Front image description
    $wp_customize->add_setting(
        'front_image_description',
        array(
            'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'the-monday' ),
            'sanitize_callback' => 'the_monday_sanitize_text',
            'transport' => 'postMessage'
            )
    );

    $wp_customize->add_control( new The_Monday_Textarea_Custom_Control(
        $wp_customize,
        'front_image_description',
            array(
                'type' => 'the_monday_textarea',
                'label' => __( 'Image Description', 'the-monday' ),
                'priority' => 6,
                'section' => 'the_monday_front_header_image_section'
                )
        )
    );
/*------------------------------------------------------------------------------------------------------------*/
   /**
    * Select Inner Pages Header image section
    */      
    $wp_customize->add_section(
        'the_monday_inner_header_image_section',
        array(
            'title'         => __( 'Inner Pages Header Image', 'the-monday' ),
            'priority'      => 13,
            'panel'         => 'the_monday_header_panel',
        )
    );
    
    // Inner page header image settings
    $wp_customize->add_setting(
        'inner_header_image',
        array(
            'default' => THE_MONDAY_IMAGES_URL . '/inner-header.jpg',
            'sanitize_callback' => 'esc_url',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'inner_header_image',
            array(
               'label'          => __( 'Upload your Header Image', 'the-monday' ),
               'section'        => 'the_monday_inner_header_image_section',
               'priority'       => 4,
            )
        )
    );
/*------------------------------------------------------------------------------------------------------*/    
    /**
     * Menu settings
     */ 
    
    $wp_customize->add_section(
        'the_monday_menu_style',
        array(
            'title'         => __('Primary Menu Settings', 'the-monday'),
            'priority'      => 15,
            'panel'         => 'the_monday_header_panel', 
        )
    );
    
    //Sticky menu
    $wp_customize->add_setting(
        'the_monday_main_sticky_menu',
        array(
            'default' => 'sticky',
            'sanitize_callback' => 'the_monday_sanitize_sticky',
        )
    );
    $wp_customize->add_control(
        'the_monday_main_sticky_menu',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __( 'Sticky menu', 'the-monday' ),
            'section' => 'the_monday_menu_style',
            'choices' => array(
                'sticky'   => __( 'Sticky', 'the-monday' ),
                'static'   => __( 'Static', 'the-monday' ),
            ),
        )
    );

    //Disable Single page menu
    $wp_customize->add_setting(
        'single_page_menu_option',
        array(
            'sanitize_callback' => 'the_monday_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'single_page_menu_option',
        array(
            'type'      => 'checkbox',
            'label'     => __( 'Disable Single page Menu', 'the-monday' ),
            'section'   => 'the_monday_menu_style',
            'priority'  => 11,
        )
    );

    //Home tab text
    $wp_customize->add_setting(
        'single_menu_home_text', 
            array(
                'default' => __( 'Home', 'the-monday' ),
                'sanitize_callback' => 'the_monday_sanitize_text',
                'transport' => 'postMessage'
           )
    );    
    $wp_customize->add_control(
        'single_menu_home_text',
            array(
            'type' => 'text',
            'label' => __( 'Home Tab Text', 'the-monday' ),
            'section' => 'the_monday_menu_style',
            'priority' => 12
            )
    );

    //Disable Home tab
    $wp_customize->add_setting(
        'single_page_menu_home_option',
        array(
            'sanitize_callback' => 'the_monday_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'single_page_menu_home_option',
        array(
            'type'      => 'checkbox',
            'label'     => __( 'Disable Home Tab', 'the-monday' ),
            'section'   => 'the_monday_menu_style',
            'priority'  => 13,
        )
    );
}