<?php
/**
 * Framework abstract.class file.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/public
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'WCGS_Abstract' ) ) {
	/**
	 *
	 * Abstract Class
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	abstract class WCGS_Abstract {

		/**
		 * $abstract variable
		 *
		 * @var string
		 */
		public $abstract = '';
		/**
		 * $output_css variable
		 *
		 * @var string
		 */
		public $output_css = '';
		/**
		 * $typographies variable
		 *
		 * @var array
		 */
		public $typographies = array();

		/**
		 * Constructor of the class.
		 */
		public function __construct() {

			// Check for embed custom css styles.
			if ( ! empty( $this->args['output_css'] ) ) {
				add_action( 'wp_head', array( &$this, 'add_output_css' ), 100 );
			}

		}

		/**
		 * Add output CSS.
		 *
		 * @return void
		 */
		public function add_output_css() {

			$this->output_css = apply_filters( "wcgs_{$this->unique}_output_css", $this->output_css, $this );

			if ( ! empty( $this->output_css ) ) {
				echo '<style type="text/css">' . wp_strip_all_tags( $this->output_css ) . '</style>'; // phpcs:ignore
			}

		}

	}
}
