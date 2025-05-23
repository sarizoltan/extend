<?php
/**
 * spfood Theme Customizer
 *
 * @package spfood
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function spfood_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'spfood_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'spfood_customize_partial_blogdescription',
			)
		);
	}
	
	// Add Header Slider Section
	$wp_customize->add_section('spfood_slider_section', array(
        'title'      => __('Header Slider', 'spfood'),
        'priority'   => 30,
    ));
    
    // Add settings for each slide (3 slides)
    for ($i = 1; $i <= 3; $i++) {
        // Slide Image
        $wp_customize->add_setting('spfood_slider_image_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'spfood_slider_image_' . $i, array(
            'label'       => __('Slide', 'spfood') . ' ' . $i . ' ' . __('Image', 'spfood'),
            'description' => __('Recommended size: 1920x600px', 'spfood'),
            'section'     => 'spfood_slider_section',
            'settings'    => 'spfood_slider_image_' . $i,
        )));
        
        // Slide Title
        $wp_customize->add_setting('spfood_slider_title_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('spfood_slider_title_' . $i, array(
            'label'    => __('Slide', 'spfood') . ' ' . $i . ' ' . __('Title', 'spfood'),
            'section'  => 'spfood_slider_section',
            'type'     => 'text',
            'settings' => 'spfood_slider_title_' . $i,
        ));
        
        // Slide Description
        $wp_customize->add_setting('spfood_slider_description_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        ));
        
        $wp_customize->add_control('spfood_slider_description_' . $i, array(
            'label'    => __('Slide', 'spfood') . ' ' . $i . ' ' . __('Description', 'spfood'),
            'section'  => 'spfood_slider_section',
            'type'     => 'textarea',
            'settings' => 'spfood_slider_description_' . $i,
        ));
        
        // Button Text
        $wp_customize->add_setting('spfood_slider_button_text_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control('spfood_slider_button_text_' . $i, array(
            'label'    => __('Slide', 'spfood') . ' ' . $i . ' ' . __('Button Text', 'spfood'),
            'section'  => 'spfood_slider_section',
            'type'     => 'text',
            'settings' => 'spfood_slider_button_text_' . $i,
        ));
        
        // Button URL
        $wp_customize->add_setting('spfood_slider_button_url_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control('spfood_slider_button_url_' . $i, array(
            'label'    => __('Slide', 'spfood') . ' ' . $i . ' ' . __('Button URL', 'spfood'),
            'section'  => 'spfood_slider_section',
            'type'     => 'url',
            'settings' => 'spfood_slider_button_url_' . $i,
        ));
    }
    
    // Lábléc beállítások - FONTOS: ez a függvényen BELÜL kell legyen!
    $wp_customize->add_section('spfood_footer_settings', array(
        'title'    => __('Footer Settings', 'spfood'),
        'priority' => 130,
    ));

    // About Us szöveg
    $wp_customize->add_setting('spfood_about_us_text', array(
        'default'           => __('Delicious food delivered to your doorstep. We are committed to providing healthy, tasty meals with the freshest ingredients.', 'spfood'),
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('spfood_about_us_text', array(
        'label'    => __('About Us Text', 'spfood'),
        'section'  => 'spfood_footer_settings',
        'type'     => 'textarea',
    ));

    // Elérhetőségek
    $wp_customize->add_setting('spfood_contact_address', array(
        'default'           => __('123 Restaurant Street, Food City', 'spfood'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('spfood_contact_address', array(
        'label'    => __('Address', 'spfood'),
        'section'  => 'spfood_footer_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('spfood_contact_phone', array(
        'default'           => __('+1 123 456 7890', 'spfood'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('spfood_contact_phone', array(
        'label'    => __('Phone Number', 'spfood'),
        'section'  => 'spfood_footer_settings',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('spfood_contact_email', array(
        'default'           => __('info@spfood.com', 'spfood'),
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('spfood_contact_email', array(
        'label'    => __('Email Address', 'spfood'),
        'section'  => 'spfood_footer_settings',
        'type'     => 'email',
    ));

    // Közösségi média linkek
    $wp_customize->add_setting('spfood_social_facebook', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('spfood_social_facebook', array(
        'label'    => __('Facebook URL', 'spfood'),
        'section'  => 'spfood_footer_settings',
        'type'     => 'url',
    ));

    $wp_customize->add_setting('spfood_social_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('spfood_social_instagram', array(
        'label'    => __('Instagram URL', 'spfood'),
        'section'  => 'spfood_footer_settings',
        'type'     => 'url',
    ));

    $wp_customize->add_setting('spfood_social_twitter', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('spfood_social_twitter', array(
        'label'    => __('Twitter URL', 'spfood'),
        'section'  => 'spfood_footer_settings',
        'type'     => 'url',
    ));
}
add_action( 'customize_register', 'spfood_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function spfood_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function spfood_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function spfood_customize_preview_js() {
	wp_enqueue_script( 'spfood-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'spfood_customize_preview_js' );