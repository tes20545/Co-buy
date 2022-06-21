<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://shapedplugin.com/
 * @since      1.0.0
 *
 * @package    Woo_Gallery_Slider
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/**
 * Delete plugin data function.
 *
 * @return void
 */
function wcgs_delete_plugin_data() {

	// Delete plugin option settings.
	$option_name = 'wcgs_settings';
	delete_option( $option_name );
	delete_site_option( $option_name ); // For site options in Multisite.
}

// Load WPTP file.
require plugin_dir_path( __FILE__ ) . '/woo-gallery-slider.php';
$wcgs_plugin_settings = get_option( 'wcgs_settings' );
$wcgs_data_delete     = $wcgs_plugin_settings['wcgs_data_remove'];

if ( $wcgs_data_delete ) {
	wcgs_delete_plugin_data();
}
