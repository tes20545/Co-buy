<?php
/**
 * Framework Custom_import field file.
 *
 * @link http://shapedplugin.com
 * @since 2.0.0
 * @package Woo_Product_Slider.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPWPS_Field_custom_import' ) ) {
	/**
	 *
	 * Field: Custom_import
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPWPS_Field_custom_import extends SPWPS_Fields {

		/**
		 * Constructor function.
		 *
		 * @param array  $field field.
		 * @param string $value field value.
		 * @param string $unique field unique.
		 * @param string $where field where.
		 * @param string $parent field parent.
		 * @since 2.0
		 */
		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}
		/**
		 * Render function.
		 */
		public function render() {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $this->field_before();
			$wps_shortcodelink = admin_url( 'edit.php?post_type=sp_wps_shortcodes' );
				echo '<p><input type="file" id="import" accept=".json"></p>';
				echo '<p><button type="button" class="import">Import</button></p>';
				echo '<a id="wps_shortcode_link_redirect" href="' . esc_attr( $wps_shortcodelink ) . '"></a>';
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $this->field_after();
		}
	}
}
