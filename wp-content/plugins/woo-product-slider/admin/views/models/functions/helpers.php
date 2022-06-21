<?php
/**
 * Framework helpers file.
 *
 * @link http://shapedplugin.com
 * @since 2.0.0
 * @package Woo_Product_Slider.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! function_exists( 'spwps_array_search' ) ) {
	/**
	 *
	 * Array search key & value
	 *
	 * @param array  $array Search array.
	 * @param string $key Search array key.
	 * @param string $value Search array value.
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function spwps_array_search( $array, $key, $value ) {

		$results = array();

		if ( is_array( $array ) ) {
			if ( isset( $array[ $key ] ) && $array[ $key ] === $value ) {
				$results[] = $array;
			}

			foreach ( $array as $sub_array ) {
				$results = array_merge( $results, spwps_array_search( $sub_array, $key, $value ) );
			}
		}

		return $results;

	}
}

if ( ! function_exists( 'spwps_microtime' ) ) {
	/**
	 *
	 * Between Microtime
	 *
	 * @param int $timenow Between Microtime now.
	 * @param int $starttime Between Microtime start time.
	 * @param int $timeout Between Microtime time out.
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function spwps_timeout( $timenow, $starttime, $timeout = 30 ) {
		return ( ( $timenow - $starttime ) < $timeout ) ? true : false;
	}
}

if ( ! function_exists( 'spwps_wp_editor_api' ) ) {
	/**
	 *
	 * Check for wp editor api
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function spwps_wp_editor_api() {
		global $wp_version;
		return version_compare( $wp_version, '4.8', '>=' );
	}
}
