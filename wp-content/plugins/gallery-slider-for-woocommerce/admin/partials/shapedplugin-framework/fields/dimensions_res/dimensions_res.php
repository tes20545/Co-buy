<?php
/**
 * Framework dimensions field.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/public
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'WCGS_Field_dimensions_res' ) ) {
	/**
	 *
	 * Field: dimensions
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class WCGS_Field_dimensions_res extends WCGS_Fields {

		/**
		 * Field constructor.
		 *
		 * @param array  $field The field type.
		 * @param string $value The values of the field.
		 * @param string $unique The unique ID for the field.
		 * @param string $where To where show the output CSS.
		 * @param string $parent The parent args.
		 */
		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {

			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		/**
		 * Render field
		 *
		 * @return void
		 */
		public function render() {

			$args = wp_parse_args(
				$this->field,
				array(
					'width_icon'   => '<i class="fa fa-laptop"></i>',
					'height_icon'  => '<i class="fa fa-tablet"></i>',
					'height2_icon' => '<i class="fa fa-mobile"></i>',
					'width'        => true,
					'height'       => true,
					'height2'      => true,
					'unit'         => true,
					'show_units'   => true,
					'units'        => array( 'px', '%', 'em' ),
				)
			);

			$default_values = array(
				'width'   => '',
				'height'  => '',
				'height2' => '',
				'unit'    => 'px',
			);

			$value = wp_parse_args( $this->value, $default_values );

			echo wp_kses_post( $this->field_before() );

			if ( ! empty( $args['width'] ) ) {

				$placeholder = ( ! empty( $args['width_placeholder'] ) ) ? ' placeholder="' . $args['width_placeholder'] . '"' : '';

				echo '<div class="wcgs--input">';
				echo ( ! empty( $args['width_icon'] ) ) ? '<span class="wcgs--label wcgs--label-icon">' . wp_kses_post( $args['width_icon'] ) . '</span>' : '';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[width]' ) ) . '" value="' . esc_attr( $value['width'] ) . '"' . wp_kses_post( $placeholder ) . ' class="wcgs-number" />';
				echo ( count( $args['units'] ) === 1 && ! empty( $args['unit'] ) ) ? '<span class="wcgs--label wcgs--label-unit">' . esc_html( $args['units'][0] ) . '</span>' : '';
				echo '</div>';

			}

			if ( ! empty( $args['height'] ) ) {

				$placeholder = ( ! empty( $args['height_placeholder'] ) ) ? ' placeholder="' . $args['height_placeholder'] . '"' : '';

				echo '<div class="wcgs--input">';
				echo ( ! empty( $args['height_icon'] ) ) ? '<span class="wcgs--label wcgs--label-icon">' . wp_kses_post( $args['height_icon'] ) . '</span>' : '';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[height]' ) ) . '" value="' . esc_attr( $value['height'] ) . '"' . wp_kses_post( $placeholder ) . ' class="wcgs-number" />';
				echo ( count( $args['units'] ) === 1 && ! empty( $args['unit'] ) ) ? '<span class="wcgs--label wcgs--label-unit">' . esc_html( $args['units'][0] ) . '</span>' : '';
				echo '</div>';

			}
			if ( ! empty( $args['height2'] ) ) {

				$placeholder = ( ! empty( $args['height2_placeholder'] ) ) ? ' placeholder="' . $args['height2_placeholder'] . '"' : '';

				echo '<div class="wcgs--input">';
				echo ( ! empty( $args['height2_icon'] ) ) ? '<span class="wcgs--label wcgs--label-icon">' . wp_kses_post( $args['height2_icon'] ) . '</span>' : '';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[height2]' ) ) . '" value="' . esc_attr( $value['height2'] ) . '"' . wp_kses_post( $placeholder ) . ' class="wcgs-number" />';
				echo ( count( $args['units'] ) === 1 && ! empty( $args['unit'] ) ) ? '<span class="wcgs--label wcgs--label-unit">' . esc_html( $args['units'][0] ) . '</span>' : '';
				echo '</div>';
			}

			if ( ! empty( $args['unit'] ) && ! empty( $args['show_units'] ) && count( $args['units'] ) > 1 ) {
				echo '<select name="' . esc_attr( $this->field_name( '[unit]' ) ) . '">';
				foreach ( $args['units'] as $unit ) {
					$selected = ( $value['unit'] === $unit ) ? ' selected' : '';
					echo '<option value="' . esc_attr( $unit ) . '"' . esc_attr( $selected ) . '>' . esc_html( $unit ) . '</option>';
				}
				echo '</select>';
			}
			echo wp_kses_post( $this->field_after() );
			echo '<div class="clear"></div>';
		}

		/**
		 * Output
		 *
		 * @return statement
		 */
		public function output() {

			$output    = '';
			$element   = ( is_array( $this->field['output'] ) ) ? join( ',', $this->field['output'] ) : $this->field['output'];
			$prefix    = ( ! empty( $this->field['output_prefix'] ) ) ? $this->field['output_prefix'] . '-' : '';
			$important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';
			$unit      = ( ! empty( $this->value['unit'] ) ) ? $this->value['unit'] : 'px';
			$width     = ( isset( $this->value['width'] ) && '' !== $this->value['width'] ) ? $prefix . 'width:' . $this->value['width'] . $unit . $important . ';' : '';
			$height    = ( isset( $this->value['height'] ) && '' !== $this->value['width'] ) ? $prefix . 'height:' . $this->value['height'] . $unit . $important . ';' : '';

			if ( '' !== $width || '' !== $height ) {
				$output = $element . '{' . $width . $height . '}';
			}

			$this->parent->output_css .= $output;

			return $output;

		}

	}
}
