<?php
/**
 * Framework sanitize file.
 *
 * @link http://shapedplugin.com
 * @since 2.0.0
 * @package Woo_Product_Slider.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! function_exists( 'spwps_sanitize_replace_a_to_b' ) ) {
	/**
	 *
	 * Sanitize
	 * Replace letter a to letter b
	 *
	 * @param string $value Replace letter.
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function spwps_sanitize_replace_a_to_b( $value ) {
		return str_replace( 'a', 'b', $value );
	}
}

if ( ! function_exists( 'spwps_sanitize_title' ) ) {
	/**
	 *
	 * Sanitize title
	 *
	 * @param string $value Sanitize title.
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function spwps_sanitize_title( $value ) {
		return sanitize_title( $value );
	}
}
