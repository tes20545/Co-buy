<?php
/**
 * The Free Loader Class.
 *
 * @package    Woo_Product_Slider
 */

/**
 * SP_WPS_Free_Loader class.
 */
class SP_WPS_Free_Loader {

	/**
	 * SP_WPS_Free_Loader constructor.
	 */
	public function __construct() {
		require_once SP_WPS_PATH . 'public/views/shortcoderender.php';
		require_once SP_WPS_PATH . 'public/views/shortcode-deprecated.php';
		require_once SP_WPS_PATH . 'public/views/scripts.php';
		require_once SP_WPS_PATH . 'admin/views/scripts.php';
		require_once SP_WPS_PATH . 'admin/views/mce-button.php';
		require_once SP_WPS_PATH . 'admin/views/notices/review.php';
		require_once SP_WPS_PATH . 'admin/preview/class-woo-product-slider-preview.php';
		require_once SP_WPS_PATH . 'includes/class-woo-product-slider-import-export.php';
	}

}

new SP_WPS_Free_Loader();
