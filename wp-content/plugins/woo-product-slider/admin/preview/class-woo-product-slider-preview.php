<?php
/**
 * The admin preview.
 *
 * @link        http://shapedplugin.com/
 * @since      2.1.4
 *
 * @package    Woo_Product_Slider
 * @subpackage Woo_Product_Slider/admin
 */

/**
 * The admin preview.
 *
 * @package    Woo_Product_Slider
 * @subpackage Woo_Product_Slider/admin
 * @author     ShapedPlugin <support@shapedplugin.com>
 */
class Woo_Product_Slider_Preview {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.1.4
	 */
	public function __construct() {
		$this->woo_product_slider_preview_action();
	}

	/**
	 * Public Action
	 *
	 * @return void
	 */
	private function woo_product_slider_preview_action() {
		// admin Preview.
		add_action( 'wp_ajax_spwps_preview_meta_box', array( $this, 'spwps_preview_meta_box' ) );

	}

	/**
	 * Function Backed preview.
	 *
	 * @since 2.2.5
	 */
	public function spwps_preview_meta_box() {
		$nonce = isset( $_POST['ajax_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['ajax_nonce'] ) ) : '';
		if ( ! wp_verify_nonce( $nonce, 'spwps_metabox_nonce' ) ) {
			return;
		}

		$setting = array();
		// XSS ok.
		// No worries, This "POST" requests is sanitizing in the below array map.
		$data = ! empty( $_POST['data'] ) ? wp_unslash( $_POST['data'] )  : ''; // phpcs:ignore
		parse_str( $data, $setting );
		// Shortcode id.
		$post_id        = $setting['post_ID'];
		$shortcode_meta = $setting['sp_wps_shortcode_options'];
		$title          = $setting['post_title'];

		SP_WPS_ShortCode::spwps_html_show( $post_id, $shortcode_meta, $title );
		?>
		<script src="<?php echo esc_url( SP_WPS_URL . 'public/assets/js/slick-config.min.js' ); ?>" ></script>
		<?php

		die();
	}

}
new Woo_Product_Slider_Preview();
