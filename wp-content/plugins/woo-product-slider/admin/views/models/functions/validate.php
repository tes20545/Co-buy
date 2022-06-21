<?php
/**
 * Framework validate file.
 *
 * @link http://shapedplugin.com
 * @since 2.0.0
 * @package Woo_Product_Slider.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! function_exists( 'spwps_validate_email' ) ) {
	/**
	 *
	 * Email validate
	 *
	 * @param string $value Email validate.
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function spwps_validate_email( $value ) {

		if ( ! filter_var( $value, FILTER_VALIDATE_EMAIL ) ) {
			return esc_html__( 'Please write a valid email address!', 'woo-product-slider' );
		}

	}
}

if ( ! function_exists( 'spwps_validate_numeric' ) ) {
	/**
	 *
	 * Numeric validate
	 *
	 * @param string $value Numeric validate.
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function spwps_validate_numeric( $value ) {

		if ( ! is_numeric( $value ) ) {
			return esc_html__( 'Please write a numeric data!', 'woo-product-slider' );
		}

	}
}

if ( ! function_exists( 'spwps_validate_required' ) ) {
	/**
	 *
	 * Required validate
	 *
	 * @param string $value Required validate.
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function spwps_validate_required( $value ) {

		if ( empty( $value ) ) {
			return esc_html__( 'Error! This field is required!', 'woo-product-slider' );
		}

	}
}

if ( ! function_exists( 'spwps_validate_url' ) ) {
	/**
	 *
	 * URL validate
	 *
	 * @param string $value URL validate.
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function spwps_validate_url( $value ) {

		if ( ! filter_var( $value, FILTER_VALIDATE_URL ) ) {
			return esc_html__( 'Please write a valid url!', 'woo-product-slider' );
		}

	}
}
