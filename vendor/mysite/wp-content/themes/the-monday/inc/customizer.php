<?php
/**
 * The Monday Theme Customizer
 *
 * @package The Monday
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function the_monday_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/*------------------------------------------------------------------------------------*/
	/**
	 * Upgrade to Uncode Pro
	*/
	// Register custom section types.
	$wp_customize->register_section_type( 'The_Monday_Customize_Section_Pro' );

	// Register sections.
	$wp_customize->add_section(
	    new The_Monday_Customize_Section_Pro(
	        $wp_customize,
	        'monday-pro',
	        array(
	            'title'    => esc_html__( 'Free Vs Pro', 'the-monday' ),
	            'pro_text' => esc_html__( 'Compare','the-monday' ),
	            'pro_url'  => admin_url( 'themes.php?page=themonday-welcome&section=free_vs_pro'),
	            'priority' => 1,
	        )
	    )
	);
	$wp_customize->add_setting(
		'monday_pro_upbuton',
		array(
			'section' => 'monday-pro',
			'sanitize_callback' => 'esc_attr',
		)
	);

	$wp_customize->add_control(
		'monday_pro_upbuton',
		array(
			'section' => 'monday-pro'
		)
	);
}
add_action( 'customize_register', 'the_monday_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function the_monday_customize_preview_js() {
	wp_enqueue_script( 'the_monday_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'jquery', 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'the_monday_customize_preview_js' );

add_action( 'customize_controls_enqueue_scripts', 'the_monday_customize_controls_register_scripts' );
function the_monday_customize_controls_register_scripts() {
    wp_enqueue_script( 'the_monday_customizer_controls', get_template_directory_uri() . '/inc/admin/js/customizer-controls.js', array('jquery'), '20160901', true );
}