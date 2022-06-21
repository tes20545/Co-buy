<?php
/**
 * This is to register the shortcode generator post type.
 *
 * @package Woo_Product_Slider
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Product Slider for WooCommerce - SP_WPS_ShortCodes class
 *
 * @since 2.0
 */
class SP_WPS_ShortCodes {

	/**
	 * Single instance of the class.
	 *
	 * @var $_instance
	 */
	private static $_instance;

	/**
	 * GetInstance function of the class.
	 *
	 * @return SP_WPS_ShortCodes
	 */
	public static function getInstance() {
		if ( ! self::$_instance ) {
			self::$_instance = new SP_WPS_ShortCodes();
		}

		return self::$_instance;
	}

	/**
	 * SP_WPS_ShortCodes constructor.
	 */
	public function __construct() {
		add_filter( 'init', array( $this, 'register_post_type' ) );
	}

	/**
	 * ShortCode generator post type.
	 */
	public function register_post_type() {

		$labels = apply_filters(
			'sp_wps_post_type_labels',
			array(
				'name'               => esc_html__( 'All Sliders', 'woo-product-slider' ),
				'singular_name'      => esc_html__( 'Product Slider', 'woo-product-slider' ),
				'menu_name'          => esc_html__( 'Product Slider', 'woo-product-slider' ),
				'all_items'          => esc_html__( 'All Sliders', 'woo-product-slider' ),
				'add_new'            => esc_html__( 'Add New', 'woo-product-slider' ),
				'add_new_item'       => esc_html__( 'Add New Slider', 'woo-product-slider' ),
				'edit'               => esc_html__( 'Edit', 'woo-product-slider' ),
				'edit_item'          => esc_html__( 'Edit Slider', 'woo-product-slider' ),
				'new_item'           => esc_html__( 'Product Slider', 'woo-product-slider' ),
				'search_items'       => esc_html__( 'Search Product Sliders', 'woo-product-slider' ),
				'not_found'          => esc_html__( 'No Product Sliders found', 'woo-product-slider' ),
				'not_found_in_trash' => esc_html__( 'No Product Sliders in Trash', 'woo-product-slider' ),
				'parent'             => esc_html__( 'Parent Product Slider', 'woo-product-slider' ),
			)
		);

		$menu_icon = 'data:image/svg+xml;base64,' . base64_encode( '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 554.3 607.5" enable-background="new 0 0 554.3 607.5" xml:space="preserve"> <g> <path fill="#9FA4AA" d="M523.3,218.6l-385.4-35.9c-2.1-0.3-4.1-0.3-6.1-0.1L116.3,108c-0.4-1.5-0.7-3-1.4-4.3  c-2.4-6-7.4-10.8-13.9-12.8L27.5,69.3C16.3,65.9,4.3,72.4,0.9,83.8c-3.4,11.3,3.1,23.3,14.6,26.6l61.3,18l73.7,355.4 c1.4,10.5,10.4,18.5,21.3,18.5l317.1-0.1c11.8,0,21.4-9.5,21.4-21.4c0-11.8-9.5-21.4-21.4-21.4l-299.6,0.1l-10.2-49.1h315.4 c16.5,0,30.8-10.9,33.8-26l25.5-128.5C557.2,237.7,543.3,220.6,523.3,218.6z M267.4,332.6c0,4.5-4.4,8.2-9.9,8.2h-33.8 c-5.5,0-9.9-3.7-9.9-8.2v-55.2c0-4.5,4.5-8.2,9.9-8.2h33.8c5.5,0,9.9,3.7,9.9,8.2V332.6z M354.9,332.6c0,4.5-4.4,8.2-9.9,8.2h-33.8 c-5.5,0-9.9-3.7-9.9-8.2v-55.2c0-4.5,4.5-8.2,9.9-8.2H345c5.5,0,9.9,3.7,9.9,8.2V332.6z M442.4,332.6c0,4.5-4.4,8.2-9.9,8.2h-33.8  c-5.5,0-9.9-3.7-9.9-8.2v-55.2c0-4.5,4.5-8.2,9.9-8.2h33.8c5.5,0,9.9,3.7,9.9,8.2V332.6z"/> <ellipse transform="matrix(7.088789e-02 -0.9975 0.9975 7.088789e-02 -347.0096 756.711)"  fill="#9FA4AA" cx="232.7" cy="564.6" rx="42.8" ry="42.8"/>  <circle fill="#9FA4AA" cx="437.2" cy="564.6" r="42.8"/> <path fill="#9FA4AA" d="M196,166.2l4.8,0.5L216,168l62.5,5.8l2.3-24c3.1-32.5,31.8-56.2,64.3-53.2c32.5,3.1,56.2,31.8,53.2,64.3  l-2.3,24l62.5,5.8l19.9,1.9c7.4,0.7,13.9-4.7,14.5-12.1l2-21.4c0.7-7.4-4.7-13.9-12.1-14.5l-19.9-1.9c-1.6-16.5-6.6-32.2-14.3-46.3 l15.5-12.8c5.7-4.7,6.5-13.2,1.7-18.9l-13.6-16.5c-4.7-5.7-13.2-6.5-18.9-1.7l-15.5,12.7c-12.5-10.1-26.8-17.9-42.8-22.6l1.9-19.9 c0.7-7.4-4.7-13.9-12.1-14.5l-21.4-2c-7.4-0.7-13.9,4.7-14.5,12.1l-1.9,19.9c-16.5,1.6-32.2,6.6-46.3,14.3l-12.8-15.5 c-4.7-5.7-13.2-6.5-18.9-1.7l-16.5,13.6c-5.7,4.7-6.5,13.2-1.7,18.9l12.8,15.5c-10.1,12.5-17.9,26.8-22.6,42.8l-19.9-1.9  c-7.4-0.7-13.9,4.7-14.5,12.1l-2,21.4C183.2,159,188.7,165.5,196,166.2z"/> </g></svg>' );
		$args      = apply_filters(
			'sp_wps_post_type_args',
			array(
				'labels'          => $labels,
				'hierarchical'    => false,
				'description'     => esc_html__( 'Product Slider for WooCommerce', 'woo-product-slider' ),
				'public'          => false,
				'show_ui'         => current_user_can( 'manage_options' ) ? true : false,
				'show_in_menu'    => current_user_can( 'manage_options' ) ? true : false,
				'menu_icon'       => $menu_icon,
				'menu_position'   => 25,
				'query_var'       => false,
				'capability_type' => 'post',
				'supports'        => array(
					'title',
				),
			)
		);

		register_post_type( 'sp_wps_shortcodes', $args );
	}

}

new SP_WPS_ShortCodes();
