<?php
/**
 * Settings page configuration.
 *
 * @since      2.2.0
 * @package    Woo_Product_Slider
 * @subpackage Woo_Product_Slider/admin/view
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.

//
// Set a unique slug-like ID.
//
$prefix = 'sp_woo_product_slider_options';

//
// Create a settings page.
//
SPWPS::create_options(
	$prefix,
	array(
		'menu_title'       => __( 'Settings', 'woo-product-slider' ),
		'menu_slug'        => 'wps_settings',
		'menu_parent'      => 'edit.php?post_type=sp_wps_shortcodes',
		'menu_type'        => 'submenu',
		'theme'            => 'light',
		'class'            => 'wps-settings-page',
		'show_search'      => false,
		'show_all_options' => false,
		'show_reset_all'  => false,
		'framework_title'  => __( 'Settings', 'woo-product-slider' ),
	)
);

//
// Advanced Settings section.
//
SPWPS::create_section(
	$prefix,
	array(
		'id'     => 'advanced_settings',
		'title'  => __( 'Advanced Settings', 'woo-product-slider' ),
		'icon'   => 'fa fa-cogs',
		'fields' => array(
			array(
				'id'         => 'wpsp_delete_all_data',
				'type'       => 'checkbox',
				'class'      => 'wpsp_delete_all_data',
				'title'      => __( 'Clean-up Data on Deletion', 'woo-product-slider' ),
				'title_help' => __( 'Check to remove plugin\'s data when plugin is uninstalled or deleted.', 'woo-product-slider' ),
				'default'    => false,
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Enqueue/Dequeue CSS', 'woo-product-slider' ),
			),
			array(
				'id'         => 'enqueue_font_awesome',
				'type'       => 'switcher',
				'title'      => __( 'FontAwesome CSS', 'woo-product-slider' ),
				'text_on'    => __( 'Enqueue', 'woo-product-slider' ),
				'text_off'   => __( 'Dequeue', 'woo-product-slider' ),
				'text_width' => 95,
				'default'    => true,
			),
			array(
				'id'         => 'enqueue_slick_css',
				'type'       => 'switcher',
				'title'      => __( 'Slick CSS', 'woo-product-slider' ),
				'text_on'    => __( 'Enqueue', 'woo-product-slider' ),
				'text_off'   => __( 'Dequeue', 'woo-product-slider' ),
				'text_width' => 95,
				'default'    => true,
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Enqueue/Dequeue JS', 'woo-product-slider' ),
			),
			array(
				'id'         => 'enqueue_slick_js',
				'type'       => 'switcher',
				'title'      => __( 'Slick JS', 'woo-product-slider' ),
				'text_on'    => __( 'Enqueue', 'woo-product-slider' ),
				'text_off'   => __( 'Dequeue', 'woo-product-slider' ),
				'text_width' => 95,
				'default'    => true,
			),

		),
	)
);

//
// Custom CSS section.
//
SPWPS::create_section(
	$prefix,
	array(
		'id'     => 'custom_css_section',
		'title'  => __( 'Custom CSS', 'woo-product-slider' ),
		'icon'   => 'fa fa-css3',
		'fields' => array(

			array(
				'id'       => 'custom_css',
				'type'     => 'code_editor',
				'title'    => __( 'Custom CSS', 'woo-product-slider' ),
				'settings' => array(
					'theme' => 'dracula',
					'mode'  => 'css',
				),
			),

		),
	)
);
