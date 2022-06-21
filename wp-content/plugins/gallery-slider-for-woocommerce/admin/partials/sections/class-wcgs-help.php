<?php
/**
 * The help tab functionality of this plugin.
 *
 * Defines the sections of help tab.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/admin
 * @author     ShapedPlugin <support@shapedplugin.com>
 */
class WCGS_Help {
	/**
	 * Specify the Help tab for the Woo Gallery Slider.
	 *
	 * @since    1.0.0
	 * @param string $prefix Define prefix wcgs_settings.
	 */
	public static function section( $prefix ) {
			WCGS::createSection(
				$prefix,
				array(
					'name'   => 'help',
					'title'  => '<i class="fa fa-life-ring"></i>' . __( 'Get Help', 'gallery-slider-for-woocommerce' ),
					'fields' => array(
						array(
							'id'   => 'help_key',
							'type' => 'sp_help_free',
						),

					),
				)
			);
	}
}
