<?php
/**
 * Make sure we don't expose any info if called directly.
 *
 * @package Woo_Product_Slider.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SP_WPS_MCE_Shortcode_List' ) ) {
	/**
	 * SP_WPS_MCE_Shortcode_List of the class.
	 */
	class SP_WPS_MCE_Shortcode_List {

		/**
		 * Single instance of the class.
		 *
		 * @var $instance
		 * @since 2.0
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 2.0
		 */
		public static function init() {
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 2.0
		 */
		public function __construct() {
			add_action( 'wp_ajax_sp_wps_cpt_list', array( $this, 'sp_wps_list_ajax' ) );
			add_action( 'admin_footer', array( $this, 'sp_wps_cpt_list' ) );
			add_action( 'admin_head', array( $this, 'sp_wps_mce_button' ) );
		}

		/**
		 * Hooks your functions into the correct filters.
		 */
		public function sp_wps_mce_button() {
			// check user permissions.
			if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
				return;
			}
			// check if WYSIWYG is enabled.
			if ( 'true' === get_user_option( 'rich_editing' ) ) {
				add_filter( 'mce_external_plugins', array( $this, 'add_mce_plugin' ) );
				add_filter( 'mce_buttons', array( $this, 'register_mce_button' ) );
			}
		}

		/**
		 * Script for our mce button.
		 *
		 * @param array $plugin_array Button script.
		 */
		public function add_mce_plugin( $plugin_array ) {
			$plugin_array['sp_wps_mce_button'] = SP_WPS_URL . 'admin/assets/js/mce-script.js';

			return $plugin_array;
		}

		/**
		 * Register our button in the editor.
		 *
		 * @param array $buttons Register button.
		 */
		public function register_mce_button( $buttons ) {
			array_push( $buttons, 'sp_wps_mce_button' );

			return $buttons;
		}

		/**
		 * Function to fetch cpt posts list
		 *
		 * @param string $post_type Cpt post type.
		 * @since  2.0
		 */
		public function posts( $post_type ) {

			global $wpdb;
			$cpt_type        = $post_type;
			$cpt_post_status = 'publish';
			$cpt             = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT ID, post_title
					FROM $wpdb->posts 
					WHERE $wpdb->posts.post_type = %s
					AND $wpdb->posts.post_status = %s
					ORDER BY ID DESC",
					$cpt_type,
					$cpt_post_status
				)
			);

			$list = array();

			foreach ( $cpt as $post ) {
				$selected  = '';
				$post_id   = $post->ID;
				$post_name = $post->post_title;
				$list[]    = array(
					'text'  => $post_name,
					'value' => $post_id,
				);
			}

			wp_send_json( $list );
		}

		/**
		 * Function to fetch buttons
		 *
		 * @since  2.0
		 * @return string
		 */
		public function sp_wps_list_ajax() {
			// check for nonce.
			check_ajax_referer( 'sp-mce-nonce', 'security' );
			$posts = $this->posts( 'sp_wps_shortcodes' ); // change 'post' if you need posts list.

			return $posts;
		}

		/**
		 * Function to output button list ajax script
		 *
		 * @since  2.0
		 */
		public function sp_wps_cpt_list() {
			// create nonce.
			global $current_screen;
			$current_screen->post_type;
			if ( 'post' === $current_screen || 'page' ) {
				$nonce = wp_create_nonce( 'sp-mce-nonce' );
				?>
				<script type="text/javascript">
					jQuery(document).ready(function ($) {
						var data = {
							'action': 'sp_wps_cpt_list', // wp ajax action.
							'security': '<?php echo esc_html( $nonce ); ?>' // Nonce value created earlier.
						};
						// fire ajax
						jQuery.post(ajaxurl, data, function (response) {
							// if nonce fails then not authorized else settings saved
							if (response === '-1') {
								// do nothing
								console.log('error');
							} else {
								if (typeof(tinyMCE) != 'undefined') {
									if (tinyMCE.activeEditor != null) {
										tinyMCE.activeEditor.settings.spWPSShortcodeList = response;
									}
								}
							}
						});
					});
				</script>
				<?php
			}
		}

	} // Mce Class
}

/**
 *  Kicking this off
 */

$sp_mce_btn = new SP_WPS_MCE_Shortcode_List();
$sp_mce_btn->init();
