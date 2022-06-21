<?php
/**
 * Framework wp_editor field file.
 *
 * @link http://shapedplugin.com
 * @since 2.0.0
 * @package Woo_Product_Slider.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'SPWPS_Field_wp_editor' ) ) {
	/**
	 * Field: wp_editor
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPWPS_Field_wp_editor extends SPWPS_Fields {

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

			$args = wp_parse_args(
				$this->field,
				array(
					'tinymce'       => true,
					'quicktags'     => true,
					'media_buttons' => true,
					'height'        => '',
				)
			);

			$attributes = array(
				'rows'         => 10,
				'class'        => 'wp-editor-area',
				'autocomplete' => 'off',
			);

			$editor_height = ( ! empty( $args['height'] ) ) ? ' style="height:' . esc_attr( $args['height'] ) . ';"' : '';

			$editor_settings = array(
				'tinymce'       => $args['tinymce'],
				'quicktags'     => $args['quicktags'],
				'media_buttons' => $args['media_buttons'],
			);

			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $this->field_before();

			echo ( spwps_wp_editor_api() ) ? '<div class="spwps-wp-editor" data-editor-settings="' . esc_attr( wp_json_encode( $editor_settings ) ) . '">' : '';

			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<textarea name="' . esc_attr( $this->field_name() ) . '"' . $this->field_attributes( $attributes ) . $editor_height . '>' . $this->value . '</textarea>';

			echo ( spwps_wp_editor_api() ) ? '</div>' : '';

			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $this->field_after();

		}

		/**
		 * Enqueue function.
		 */
		public function enqueue() {

			if ( spwps_wp_editor_api() && function_exists( 'wp_enqueue_editor' ) ) {

				wp_enqueue_editor();

				$this->setup_wp_editor_settings();

				add_action( 'print_default_editor_scripts', array( &$this, 'setup_wp_editor_media_buttons' ) );

			}

		}

		/**
		 * Setup wp editor media buttons.
		 */
		public function setup_wp_editor_media_buttons() {

			ob_start();
			echo '<div class="wp-media-buttons">';
			do_action( 'media_buttons' );
			echo '</div>';
			$media_buttons = ob_get_clean();

			echo '<script type="text/javascript">';
			echo 'var spwps_media_buttons = ' . wp_json_encode( $media_buttons ) . ';';
			echo '</script>';

		}

		/**
		 * Setup wp editor settings.
		 */
		public function setup_wp_editor_settings() {

			if ( spwps_wp_editor_api() && class_exists( '_WP_Editors' ) ) {

				$defaults = apply_filters(
					'spwps_wp_editor',
					array(
						'tinymce' => array(
							'wp_skip_init' => true,
						),
					)
				);

				$setup = _WP_Editors::parse_settings( 'spwps_wp_editor', $defaults );

				_WP_Editors::editor_settings( 'spwps_wp_editor', $setup );

			}

		}

	}
}

