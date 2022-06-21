<?php
/**
 * Admin page enqueue scripts and css files.
 *
 * @link http://shapedplugin.com
 * @since 2.0.0
 * @package Woo_Product_Slider.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

/**
 * Scripts and styles
 */
class SP_WPS_Admin_Scripts {

	/**
	 * Single instance of the class.
	 *
	 * @var null
	 * @since 2.0
	 */
	protected static $_instance = null;

	/**
	 * Main SP_WPS_Admin_Scripts Instance function.
	 *
	 * @return null|SP_WPS_Admin_Scripts
	 * @since 2.0
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Initialize the class
	 */
	public function __construct() {

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}

	/**
	 * Enqueue all styles for the meta boxes
	 */
	public function admin_scripts() {
		wp_enqueue_style( 'sp-wps-admin-style', esc_url( SP_WPS_URL . 'admin/assets/css/admin.min.css' ), array(), SP_WPS_VERSION );
		wp_enqueue_style( 'sp-wps-font-awesome', esc_url( SP_WPS_URL . 'public/assets/css/font-awesome.min.css' ), array(), SP_WPS_VERSION );

		wp_enqueue_script( 'jquery-masonry', '', array( 'jquery' ), SP_WPS_VERSION, false );
		wp_enqueue_script( 'sp-wps-admin', esc_url( SP_WPS_URL . 'admin/assets/js/admin.min.js' ), array( 'jquery' ), SP_WPS_VERSION, false );
	}

}

new SP_WPS_Admin_Scripts();
