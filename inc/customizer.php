<?php

/**
 * Focus Theme Customizer
 *
 * @package Focus
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function focus_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial('blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'focus_customize_partial_blogname',
		));
		$wp_customize->selective_refresh->add_partial('blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'focus_customize_partial_blogdescription',
		));
	}

	// add a secondary logo to header
	$wp_customize->add_setting('front_page_branding');

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'front_page_branding', array(
		'label' => 'Upload a logo for light backgrounds.',
		'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
		'settings' => 'front_page_branding',
		'priority' => 8 // show it just below the custom-logo
	)));
}
add_action('customize_register', 'focus_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function focus_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function focus_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function focus_customize_preview_js()
{
	wp_enqueue_script('focus-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'focus_customize_preview_js');
