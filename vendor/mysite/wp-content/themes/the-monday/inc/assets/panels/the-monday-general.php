<?php
/**
 * General Settings Panel for customizer page
 *
 * @package The Monday
 */
 
add_action( 'customize_register', 'the_monday_general_settings_panel' );

function the_monday_general_settings_panel( $wp_customize ){ 
    
    $wp_customize->get_section( 'title_tagline' )->panel = 'the_monday_general_settings';
    $wp_customize->get_section( 'title_tagline' )->priority = '3';
    $wp_customize->get_section( 'header_image' )->title = __( 'Site Logo', 'the-monday' );
    $wp_customize->get_section( 'header_image' )->panel = 'the_monday_general_settings';
    $wp_customize->get_section( 'header_image' )->priority = '4';
    $wp_customize->get_section( 'background_image' )->panel = 'the_monday_general_settings';
    $wp_customize->get_section( 'background_image' )->priority = '6';
    $wp_customize->get_section( 'colors' )->panel = 'the_monday_general_settings';
    $wp_customize->get_section( 'colors' )->priority = '7';
    $wp_customize->get_section( 'static_front_page' )->panel = 'the_monday_general_settings';
    $wp_customize->get_section( 'static_front_page' )->priority = '7';
    
    $wp_customize->add_panel( 
        'the_monday_general_settings', 
            array(
              'priority'       => 3,
              'capability'     => 'edit_theme_options',
              'theme_supports' => '',
              'title'          => __('General Settings', 'the-monday'),
            ) 
     );
    
/*-------------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * Color section
     */
    //Primary color
    $wp_customize->add_setting(
        'primary_color',
        array(
            'default'           => '#2e8ecb',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'primary_color',
            array(
                'label'         => __( 'Theme color', 'the-monday' ),
                'section'       => 'colors',
                'settings'      => 'primary_color',
                'priority'      => 11
            )
        )
    );
}