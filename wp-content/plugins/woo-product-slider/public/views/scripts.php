<?php
/**
 * Enqueue Scripts and Styles files.
 *
 * @package    Woo_Product_Slider
 * @subpackage Woo_Product_Slider/public/views
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; }  // if direct access

/**
 * Scripts and styles
 */
class SP_WPS_Front_Scripts {

	/**
	 * SP_WPS_Front_Scripts single instance of the class
	 *
	 * @var null
	 * @since 2.0
	 */
	protected static $_instance = null;

	/**
	 * SP_WPS_Front_Scripts Instance function.
	 *
	 * @return SP_WPS_Scripts
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

		add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}

	/**
	 * Plugin Scripts and Styles
	 */
	public function front_scripts() {
		// CSS Files.
		wp_register_style( 'sp-wps-slick', esc_url( SP_WPS_URL . 'public/assets/css/slick.min.css' ), array(), SP_WPS_VERSION );
		wp_register_style( 'sp-wps-font-awesome', esc_url( SP_WPS_URL . 'public/assets/css/font-awesome.min.css' ), array(), SP_WPS_VERSION );
		wp_register_style( 'sp-wps-style', esc_url( SP_WPS_URL . 'public/assets/css/style.min.css' ), array(), SP_WPS_VERSION );
		wp_register_style( 'sp-wps-style-dep', esc_url( SP_WPS_URL . 'public/assets/css/style-deprecated.min.css' ), array(), SP_WPS_VERSION );
		include SP_WPS_PATH . '/includes/custom-css.php';
		wp_add_inline_style( 'sp-wps-style', $custom_css );

		// JS Files.
		wp_register_script( 'sp-wps-slick-min-js', esc_url( SP_WPS_URL . 'public/assets/js/slick.min.js' ), array( 'jquery' ), SP_WPS_VERSION, false );
		wp_register_script( 'sp-wps-slick-config-js', esc_url( SP_WPS_URL . 'public/assets/js/slick-config.min.js' ), array( 'jquery' ), SP_WPS_VERSION, false );

	}

	/**
	 * Live preview Scripts and Styles
	 */
	public function admin_scripts() {
		// CSS Files.
		wp_enqueue_style( 'sp-wps-slick', esc_url( SP_WPS_URL . 'public/assets/css/slick.min.css' ), array(), SP_WPS_VERSION );
		wp_enqueue_style( 'sp-wps-font-awesome', esc_url( SP_WPS_URL . 'public/assets/css/font-awesome.min.css' ), array(), SP_WPS_VERSION );
		wp_enqueue_style( 'sp-wps-style', esc_url( SP_WPS_URL . 'public/assets/css/style.min.css' ), array(), SP_WPS_VERSION );
		wp_enqueue_style( 'sp-wps-style-dep', esc_url( SP_WPS_URL . 'public/assets/css/style-deprecated.min.css' ), array(), SP_WPS_VERSION );
		include SP_WPS_PATH . '/includes/custom-css.php';
		wp_add_inline_style( 'sp-wps-style', $custom_css );

		// JS Files.
		wp_enqueue_script( 'sp-wps-slick-min-js', esc_url( SP_WPS_URL . 'public/assets/js/slick.min.js' ), array( 'jquery' ), SP_WPS_VERSION, false );
		// wp_enqueue_script( 'sp-wps-slick-config-js', esc_url( SP_WPS_URL . 'public/assets/js/slick-config.min.js' ), array( 'jquery' ), SP_WPS_VERSION, false );

	}

}
new SP_WPS_Front_Scripts();
