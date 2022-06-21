<?php
/**
 * Framework dimensions field file.
 *
 * @link http://shapedplugin.com
 * @since 2.0.0
 * @package Woo_Product_Slider.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPWPS_Field_dimensions' ) ) {
	/**
	 *
	 * Field: dimensions
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPWPS_Field_dimensions extends SPWPS_Fields {

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
					'width_icon'         => '<i class="fas fa-arrows-alt-h"></i>',
					'height_icon'        => '<i class="fas fa-arrows-alt-v"></i>',
					'width_placeholder'  => esc_html__( 'width', 'woo-product-slider' ),
					'height_placeholder' => esc_html__( 'height', 'woo-product-slider' ),
					'width'              => true,
					'height'             => true,
					'unit'               => true,
					'show_units'         => true,
					'units'              => array( 'px', '%', 'em' ),
					'crop'               => true,
					'disabled'           => 'disabled',
					'show_crop_list'     => false,
					'crop_list'          => array( 'hard-crop', 'soft-crop' ),
				)
			);

			$default_values = array(
				'width'  => '',
				'height' => '',
				'unit'   => 'px',
				'crop'   => '',
			);

			$value   = wp_parse_args( $this->value, $default_values );
			$unit    = ( count( $args['units'] ) === 1 && ! empty( $args['unit'] ) ) ? $args['units'][0] : '';
			$is_unit = ( ! empty( $unit ) ) ? ' spwps--is-unit' : '';

			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $this->field_before();

			echo '<div class="spwps--inputs" ' . esc_attr( $args['disabled'] ) . '>';

			if ( ! empty( $args['width'] ) ) {
				$placeholder = ( ! empty( $args['width_placeholder'] ) ) ? ' placeholder="' . esc_attr( $args['width_placeholder'] ) . '"' : '';
				echo '<div class="spwps--input">';
				echo ( ! empty( $args['width_icon'] ) ) ? '<span class="spwps--label spwps--icon">' . wp_kses_post( $args['width_icon'] ) . '</span>' : '';
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[width]' ) ) . '" value="' . esc_attr( $value['width'] ) . '"' . $placeholder . ' class="spwps-input-number' . esc_attr( $is_unit ) . '" />';
				echo ( ! empty( $unit ) ) ? '<span class="spwps--label spwps--unit">' . esc_attr( $args['units'][0] ) . '</span>' : '';
				echo '</div>';
			}

			if ( ! empty( $args['height'] ) ) {
				$placeholder = ( ! empty( $args['height_placeholder'] ) ) ? ' placeholder="' . esc_attr( $args['height_placeholder'] ) . '"' : '';
				echo '<div class="spwps--input">';
				echo ( ! empty( $args['height_icon'] ) ) ? '<span class="spwps--label spwps--icon">' . wp_kses_post( $args['height_icon'] ) . '</span>' : '';
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[height]' ) ) . '" value="' . esc_attr( $value['height'] ) . '"' . $placeholder . ' class="spwps-input-number' . esc_attr( $is_unit ) . '" />';
				echo ( ! empty( $unit ) ) ? '<span class="spwps--label spwps--unit">' . esc_attr( $args['units'][0] ) . '</span>' : '';
				echo '</div>';
			}

			if ( ! empty( $args['unit'] ) && ! empty( $args['show_units'] ) && count( $args['units'] ) > 1 ) {
				echo '<div class="spwps--input">';
				echo '<select name="' . esc_attr( $this->field_name( '[unit]' ) ) . '">';
				foreach ( $args['units'] as $unit ) {
					$selected = ( $value['unit'] === $unit ) ? ' selected' : '';
					echo '<option value="' . esc_attr( $unit ) . '"' . esc_attr( $selected ) . '>' . esc_attr( $unit ) . '</option>';
				}
				echo '</select>';
				echo '</div>';
			}

			if ( ! empty( $args['crop'] ) && ! empty( $args['show_crop_list'] ) && count( $args['crop_list'] ) > 1 ) {
				echo '<div class="spwps--input">';
				echo '<select name="' . esc_attr( $this->field_name( '[crop]' ) ) . '">';
				foreach ( $args['crop_list'] as $crop ) {
					$selected = ( $value['crop'] === $crop ) ? ' selected' : '';
					echo '<option value="' . esc_attr( $crop ) . '"' . esc_attr( $selected ) . '>' . esc_attr( $crop ) . '</option>';
				}
				echo '</select>';
				echo '</div>';
			}

			echo '</div>';

			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $this->field_after();

		}

	}
}
