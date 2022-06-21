<?php
/**
 * The admin settings page of this plugin.
 *
 * Defines various settings of Gallery Slider for WooCommerce.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/admin
 * @author     Shapedplugin <support@shapedplugin.com>
 */

/**
 * WCGS Settings class
 */
class WCGS_Settings {
	/**
	 * Initialize the WooCommerce Settings page for the admin area.
	 *
	 * @since    1.0.0
	 * @param string $prefix Define prefix wcgs_settings.
	 */
	public static function options( $prefix ) {
		WCGS::createOptions(
			$prefix,
			array(
				'framework_title'    => '',
				'framework_class'    => 'wcgs-settings',
				'class'              => 'wcgs-preloader',
				'menu_title'         => esc_html__( 'WooGallery Slider', 'gallery-slider-for-woocommerce' ),
				'menu_slug'          => 'wpgs-settings',
				'menu_icon'          => 'data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9JzMwMHB4JyB3aWR0aD0nMzAwcHgnICBmaWxsPSIjOUZBNEE5IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMTAwIDEwMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMTAwIDEwMCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PGc+PHBhdGggZmlsbD0ibm9uZSIgZD0iTTIxLjAzMywzNS42ODFjMi4wNjYsMCwzLjczNS0xLjY2OCwzLjczNS0zLjY5YzAtMi4wMzEtMS42NjktMy43MDItMy43MzUtMy43MDIgICBjLTIuMDU5LDAtMy43MjksMS42Ny0zLjcyOSwzLjcwMkMxNy4zMDMsMzQuMDEzLDE4Ljk3NCwzNS42ODEsMjEuMDMzLDM1LjY4MXoiPjwvcGF0aD48Zz48cGF0aCBkPSJNMTIsMTUuNjY3djY3LjU1Nmg3NlY4MS44MlYxNS42NjdIMTJ6IE04NC4xMjQsMTkuODY4Vjc5LjAySDE1Ljg3NVYxOS44NjhIODQuMTI0eiI+PC9wYXRoPjxwYXRoIGQ9Ik0xOS43MjksMjMuNjI1djM2LjU5M2g2MC41NDJWMjMuNjI1SDE5LjcyOXogTTI0LjMyMyw1NS42NDFsLTAuMjcsMC44NjJ2LTAuODYySDI0LjMyM2w4LjM3OS0yNi41ODJsMTUuMTM1LDE4LjI5OCAgICBsOC42NTEtNC41NzdsMi4xNiwxMi44NTlIMjQuMzIzVjU1LjY0MXogTTY5LjUwNCw0MS45MTdjLTMuNTgsMC02LjQ4Mi0zLjA3LTYuNDgyLTYuODYxczIuOTAyLTYuODYxLDYuNDgyLTYuODYxICAgIGMzLjU4MywwLDYuNDg3LDMuMDcxLDYuNDg3LDYuODYxUzczLjA4Nyw0MS45MTcsNjkuNTA0LDQxLjkxN3oiPjwvcGF0aD48cG9seWdvbiBwb2ludHM9IjI0Ljg1Miw0OS42NjkgMjUuMTExLDQ4LjkwMiAyNC44NTIsNDguOTAyICAgIj48L3BvbHlnb24+PHBvbHlnb24gcG9pbnRzPSIyNC44NTIsNDguOTAyIDI0Ljg1Miw0OS42NjkgMjUuMTExLDQ4LjkwMiAgICI+PC9wb2x5Z29uPjxyZWN0IHg9IjE5LjcyOSIgeT0iNjUuNTM2IiB3aWR0aD0iMTUuMzk3IiBoZWlnaHQ9IjkuODUzIj48L3JlY3Q+PHJlY3QgeD0iNDIuNDgzIiB5PSI2NS41MzYiIHdpZHRoPSIxNS40IiBoZWlnaHQ9IjkuODUzIj48L3JlY3Q+PHJlY3QgeD0iNjQuODc0IiB5PSI2NS41MzYiIHdpZHRoPSIxNS4zOTciIGhlaWdodD0iOS44NTMiPjwvcmVjdD48L2c+PC9nPjwvc3ZnPg==',
				'show_reset_section' => true,
				'show_search'        => false,
				'show_all_options'   => false,
				'theme'              => 'light',
				'show_footer'        => false,
				'sticky_header'      => true,
				'show_sub_menu'      => false,
				'footer_credit'      => __( 'If you like <strong>Gallery Slider for WooCommerce</strong>, please leave us a <a href="https://wordpress.org/support/plugin/gallery-slider-for-woocommerce/reviews/?filter=5#new-post" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more.', 'gallery-slider-for-woocommerce' ),
				'footer_after'       => "<div id='BuyProPopupContent' style='display: none;'>
				<div class='wcgs-popup-content'><h2> <i class='fa fa-lock'></i> Available in Pro</h2><p>" . __( 'Please upgrade to the Pro version  to unlock all these amazing features.', 'gallery-slider-for-woocommerce' ) . "</p> <p><a href='" . esc_url( WOO_GALLERY_SLIDER_PRO_LINK ) . "' target='_blank' class='btn'>" . __( 'Get the Pro version', 'gallery-slider-for-woocommerce' ) . '</a></p></div></div><div id="myOnPageContent" style="display: none;"> <div class="wcgs-popup-content"><h2> <i class="fa fa-lock"></i> Available in Pro</h2><p>Please upgrade to the Pro version  to unlock all these amazing features</p> <p><a target="_blank" href=' . esc_url( WOO_GALLERY_SLIDER_PRO_LINK ) . ' class="btn">Get the Pro version</a></p></div> </div>',
			)
		);

		WCGS_General::section( $prefix );
		WCGS_Gallery::section( $prefix );
		WCGS_Lightbox::section( $prefix );
		WCGS_Advance::section( $prefix );
		// WCGS_License::section( $prefix );
		WCGS_Help::section( $prefix );
	}
}
