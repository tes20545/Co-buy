<?php
/**
 * Framework border field.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/public
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'WCGS_Field_border' ) ) {
	/**
	 *
	 * Field: border
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class WCGS_Field_border extends WCGS_Fields {

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
					'top_icon'           => '<i class="fa fa-long-arrow-up"></i>',
					'left_icon'          => '<i class="fa fa-long-arrow-left"></i>',
					'bottom_icon'        => '<i class="fa fa-long-arrow-down"></i>',
					'right_icon'         => '<i class="fa fa-long-arrow-right"></i>',
					'all_icon'           => '<i class="fa fa-arrows"></i>',
					'top_placeholder'    => esc_html__( 'top', 'gallery-slider-for-woocommerce' ),
					'right_placeholder'  => esc_html__( 'right', 'gallery-slider-for-woocommerce' ),
					'bottom_placeholder' => esc_html__( 'bottom', 'gallery-slider-for-woocommerce' ),
					'left_placeholder'   => esc_html__( 'left', 'gallery-slider-for-woocommerce' ),
					'all_placeholder'    => esc_html__( 'all', 'gallery-slider-for-woocommerce' ),
					'top'                => true,
					'left'               => true,
					'bottom'             => true,
					'right'              => true,
					'all'                => false,
					'color'              => true,
					'color2'             => true,
					'color3'             => true,
					'style'              => true,
					'unit'               => 'px',
				)
			);

			$default_value = array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
				'color'  => '',
				'style'  => 'solid',
				'all'    => '',
			);

			$border_props = array(
				'solid'  => esc_html__( 'Solid', 'gallery-slider-for-woocommerce' ),
				'dashed' => esc_html__( 'Dashed', 'gallery-slider-for-woocommerce' ),
				'dotted' => esc_html__( 'Dotted', 'gallery-slider-for-woocommerce' ),
				'double' => esc_html__( 'Double', 'gallery-slider-for-woocommerce' ),
				'inset'  => esc_html__( 'Inset', 'gallery-slider-for-woocommerce' ),
				'outset' => esc_html__( 'Outset', 'gallery-slider-for-woocommerce' ),
				'groove' => esc_html__( 'Groove', 'gallery-slider-for-woocommerce' ),
				'ridge'  => esc_html__( 'ridge', 'gallery-slider-for-woocommerce' ),
				'none'   => esc_html__( 'None', 'gallery-slider-for-woocommerce' ),
			);

			$default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

			$value = wp_parse_args( $this->value, $default_value );

			echo wp_kses_post( $this->field_before() );

			if ( ! empty( $args['all'] ) ) {

				$placeholder = ( ! empty( $args['all_placeholder'] ) ) ? ' placeholder="' . $args['all_placeholder'] . '"' : '';

				echo '<div class="wcgs--left wcgs--input">';
				echo ( ! empty( $args['all_icon'] ) ) ? '<span class="wcgs--label wcgs--label-icon">' . wp_kses_post( $args['all_icon'] ) . '</span>' : '';

				echo '<input type="number" name="' . esc_attr( $this->field_name( '[all]' ) ) . '" value="' . esc_attr( $value['all'] ) . '"' . wp_kses_post( $placeholder ) . ' class="wcgs-number" />';
				echo ( ! empty( $args['unit'] ) ) ? '<span class="wcgs--label wcgs--label-unit">' . esc_html( $args['unit'] ) . '</span>' : '';
				echo '</div>';

			} else {

				$properties = array();

				foreach ( array( 'top', 'right', 'bottom', 'left' ) as $prop ) {
					if ( ! empty( $args[ $prop ] ) ) {
						$properties[] = $prop;
					}
				}

				$properties = ( array( 'right', 'left' ) === $properties ) ? array_reverse( $properties ) : $properties;

				foreach ( $properties as $property ) {

					$placeholder = ( ! empty( $args[ $property . '_placeholder' ] ) ) ? ' placeholder="' . $args[ $property . '_placeholder' ] . '"' : '';

					echo '<div class="wcgs--left wcgs--input">';
					echo ( ! empty( $args[ $property . '_icon' ] ) ) ? '<span class="wcgs--label wcgs--label-icon">' . wp_kses_post( $args[ $property . '_icon' ] ) . '</span>' : '';
					echo '<div class="wcgs--title">width</div>';
					echo '<input type="text" name="' . esc_attr( $this->field_name( '[' . $property . ']' ) ) . '" value="' . esc_attr( $value[ $property ] ) . '"' . wp_kses_post( $placeholder ) . ' class="wcgs-number" />';
					echo ( ! empty( $args['unit'] ) ) ? '<span class="wcgs--label wcgs--label-unit">' . esc_html( $args['unit'] ) . '</span>' : '';
					echo '</div>';

				}
			}

			if ( ! empty( $args['style'] ) ) {
				echo '<div class="wcgs--left wcgs--input">';
				echo '<select name="' . esc_attr( $this->field_name( '[style]' ) ) . '">';
				foreach ( $border_props as $border_prop_key => $border_prop_value ) {
					$selected = ( $value['style'] === $border_prop_key ) ? ' selected' : '';
					echo '<option value="' . esc_attr( $border_prop_key ) . '"' . esc_attr( $selected ) . '>' . esc_html( $border_prop_value ) . '</option>';
				}
				echo '</select>';
				echo '</div>';
			}
			if ( ! empty( $args['color'] ) ) {
				$default_color_attr = ( ! empty( $default_value['color'] ) ) ? ' data-default-color="' . $default_value['color'] . '"' : '';
				echo '<div class="wcgs--left wcgs-field-color">';
				echo '<div class="wcgs--title">Normal</div>';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[color]' ) ) . '" value="' . esc_attr( $value['color'] ) . '" class="wcgs-color"' . wp_kses_post( $default_color_attr ) . ' />';
				echo '</div>';
			}
			if ( ! empty( $args['color2'] ) ) {
				$default_color_attr = ( ! empty( $default_value['color2'] ) ) ? ' data-default-color="' . $default_value['color'] . '"' : '';
				echo '<div class="wcgs--left wcgs-field-color">';
				echo '<div class="wcgs--title">Active</div>';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[color2]' ) ) . '" value="' . esc_attr( $value['color2'] ) . '" class="wcgs-color"' . wp_kses_post( $default_color_attr ) . ' />';
				echo '</div>';
			}
			if ( ! empty( $args['color3'] ) ) {
				$default_color_attr = ( ! empty( $default_value['color3'] ) ) ? ' data-default-color="' . $default_value['color3'] . '"' : '';
				echo '<div class="wcgs--left wcgs-field-color">';
				echo '<div class="wcgs--title">Hover</div>';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[color3]' ) ) . '" value="' . esc_attr( $value['color3'] ) . '" class="wcgs-color"' . wp_kses_post( $default_color_attr ) . ' />';
				echo '</div>';
			}

			echo '<div class="clear"></div>';

			echo wp_kses_post( $this->field_after() );

		}

		/**
		 * Output
		 *
		 * @return statement
		 */
		public function output() {

			$output    = '';
			$unit      = ( ! empty( $this->value['unit'] ) ) ? $this->value['unit'] : 'px';
			$important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';
			$element   = ( is_array( $this->field['output'] ) ) ? join( ',', $this->field['output'] ) : $this->field['output'];

			// properties.
			$top    = ( isset( $this->value['top'] ) && '' !== $this->value['top'] ) ? $this->value['top'] : '';
			$right  = ( isset( $this->value['right'] ) && '' !== $this->value['right'] ) ? $this->value['right'] : '';
			$bottom = ( isset( $this->value['bottom'] ) && '' !== $this->value['bottom'] ) ? $this->value['bottom'] : '';
			$left   = ( isset( $this->value['left'] ) && '' !== $this->value['left'] ) ? $this->value['left'] : '';
			$style  = ( isset( $this->value['style'] ) && '' !== $this->value['style'] ) ? $this->value['style'] : '';
			$color  = ( isset( $this->value['color'] ) && '' !== $this->value['color'] ) ? $this->value['color'] : '';
			$all    = ( isset( $this->value['all'] ) && '' !== $this->value['all'] ) ? $this->value['all'] : '';

			if ( ! empty( $this->field['all'] ) && ( '' !== $all || '' !== $color ) ) {

				$output  = $element . '{';
				$output .= ( '' !== $all ) ? 'border-width:' . $all . $unit . $important . ';' : '';
				$output .= ( '' !== $color ) ? 'border-color:' . $color . $important . ';' : '';
				$output .= ( '' !== $style ) ? 'border-style:' . $style . $important . ';' : '';
				$output .= '}';

			} elseif ( '' !== $top || '' !== $right || '' !== $bottom || '' !== $left || '' !== $color ) {

				$output  = $element . '{';
				$output .= ( '' !== $top ) ? 'border-top-width:' . $top . $unit . $important . ';' : '';
				$output .= ( '' !== $right ) ? 'border-right-width:' . $right . $unit . $important . ';' : '';
				$output .= ( '' !== $bottom ) ? 'border-bottom-width:' . $bottom . $unit . $important . ';' : '';
				$output .= ( '' !== $left ) ? 'border-left-width:' . $left . $unit . $important . ';' : '';
				$output .= ( '' !== $color ) ? 'border-color:' . $color . $important . ';' : '';
				$output .= ( '' !== $style ) ? 'border-style:' . $style . $important . ';' : '';
				$output .= '}';

			}

			$this->parent->output_css .= $output;

			return $output;

		}

	}
}
