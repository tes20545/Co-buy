<?php
/**
 * The license tab functionality of this plugin.
 *
 * Defines the sections of license tab.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/admin
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

/**
 * WCGS License class
 */
class WCGS_License {
	/**
	 * Specify the License tab for the Woo Gallery Slider.
	 *
	 * @since    1.0.0
	 * @param string $prefix Define prefix wcgs_settings.
	 */
	public static function section( $prefix ) {
		if ( ! in_array( 'woo-gallery-slider-pro/woo-gallery-slider-pro.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {
			return;
		}
		WCGS::createSection(
			$prefix,
			array(
				'name'   => 'license',
				'title'  => '<i class="fa fa-key"></i>' . __( 'License', 'gallery-slider-for-woocommerce' ),
				'fields' => array(

					array(
						'id'   => 'license_key',
						'type' => 'license',
					),

				),
			)
		);
	}
}
