<?php
/**
 * Plugin Name:     Product Slider for WooCommerce
 * Plugin URI:      https://shapedplugin.com/plugin/woocommerce-product-slider-pro/?ref=1
 * Description:     Slide your WooCommerce Products in a tidy and professional slider or carousel with an easy-to-use and intuitive Shortcode Generator. Highly customizable and No coding required!
 * Version:         2.4.3
 * Author:          ShapedPlugin
 * Author URI:      https://shapedplugin.com/
 * License:         GPLv3
 * License URI:     https://www.gnu.org/licenses/gpl-3.0.html
 * Requires at least: 5.0
 * Requires PHP: 5.6
 * WC requires at least: 4.5
 * WC tested up to: 6.1.1
 * Text Domain:     woo-product-slider
 * Domain Path:     /languages
 *
 * @package         Woo_Product_Slider
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Pro version check.
 *
 * @return boolean
 */
function is_woo_product_slider_pro() {
	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	if ( ! ( is_plugin_active( 'woo-product-slider-pro/woo-product-slider-pro.php' ) || is_plugin_active_for_network( 'woo-product-slider-pro/woo-product-slider-pro.php' ) ) ) {
		return true;
	}
}

if ( is_woo_product_slider_pro() ) {
	require_once plugin_dir_path( __FILE__ ) . 'admin/views/models/classes/setup.class.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/views/settings.config.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/views/tools.config.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/views/metabox.config.php';
}

if ( ! class_exists( 'SP_WooCommerce_Product_Slider' ) ) {
	/**
	 * Plugin main class name.
	 *
	 * @since 2.0
	 * @package    Woo_Product_Slider
	 * @author     ShapedPlugin <support@shapedplugin.com>
	 */
	class SP_WooCommerce_Product_Slider {
		/**
		 * Plugin version
		 *
		 * @var string
		 */
		public $version = '2.4.3';

		/**
		 * Plugin short code.
		 *
		 * @var SP_WPS_ShortCodes $shortcode
		 */
		public $shortcode;

		/**
		 * Plugin router.
		 *
		 * @var SP_WPS_Router $router
		 */
		public $router;

		/**
		 * Instance var.
		 *
		 * @var null
		 * @since 2.0
		 */
		protected static $_instance = null;

		/**
		 * Plugin instance function.
		 *
		 * @return SP_WooCommerce_Product_Slider
		 * @since 2.0
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new SP_WooCommerce_Product_Slider();
			}

			return self::$_instance;
		}

		/**
		 * SP_WooCommerce_Product_Slider constructor.
		 */
		public function __construct() {
			// Define constants.
			$this->define_constants();

			// The code that runs during plugin updates.
			require_once SP_WPS_PATH . 'includes/class-woo-product-slider-updates.php';

			// The class responsible for premium menu.
			require_once SP_WPS_PATH . 'includes/class-woo-product-slider-premium.php';
			new Woo_Product_Slider_Premium();

			// Required class file include.
			spl_autoload_register( array( $this, 'autoload' ) );

			// Include required files.
			$this->includes();

			// instantiate classes.
			$this->instantiate();

			// Initialize the filter hooks.
			$this->init_filters();

			// Initialize the action hooks.
			$this->init_actions();
		}

		/**
		 * Initialize WordPress filter hooks
		 *
		 * @return void
		 */
		public function init_filters() {
			add_filter( 'plugin_action_links', array( $this, 'add_plugin_action_links' ), 10, 2 );
			add_filter( 'manage_sp_wps_shortcodes_posts_columns', array( $this, 'add_shortcode_column' ) );
			add_filter( 'plugin_row_meta', array( $this, 'after_woo_product_slider_row_meta' ), 10, 4 );
			add_filter( 'post_updated_messages', array( $this, 'sp_wps_update' ), 10, 1 );
		}

		/**
		 * Initialize WordPress action hooks
		 *
		 * @return void
		 */
		public function init_actions() {
			add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );
			add_action( 'manage_sp_wps_shortcodes_posts_custom_column', array( $this, 'add_shortcode_form' ), 10, 2 );
			add_action( 'activated_plugin', array( $this, 'redirect_help_page' ) );
			if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {
				add_action( 'admin_notices', array( $this, 'error_admin_notice' ) );
			}
			add_action( 'admin_action_sp_wps_duplicate_shortcode', array( $this, 'sp_wps_duplicate_shortcode' ) );
			add_filter( 'post_row_actions', array( $this, 'sp_wps_duplicate_shortcode_link' ), 10, 2 );
			// wqv plugin is not installed notice.
			// if ( empty( get_option( 'sp-wqv-notice-dismissed' ) ) ) {
			// add_action( 'admin_notices', array( $this, 'admin_notice' ) );
			// }.
			add_action( 'admin_notices', array( $this, 'woo_gallery_slider_admin_notice' ) );
			add_action( 'wp_ajax_dismiss_wqv_notice', array( $this, 'dismiss_wqv_notice' ) );
			add_action( 'wp_ajax_dismiss_woo_gallery_slider_notice', array( $this, 'dismiss_woo_gallery_slider_notice' ) );

			// Export Import Ajax call.
			$import_export = new Woo_Product_Slider_Import_Export( SP_WPS_NAME, SP_WPS_VERSION );

			add_action( 'wp_ajax_wpsp_export_shortcodes', array( $import_export, 'export_shortcodes' ) );
			add_action( 'wp_ajax_wpsp_import_shortcodes', array( $import_export, 'import_shortcodes' ) );
		}

		/**
		 * Define constants
		 *
		 * @since 2.0
		 */
		public function define_constants() {
			$this->define( 'SP_WPS_NAME', 'woo-product-slider' );
			$this->define( 'SP_WPS_VERSION', $this->version );
			$this->define( 'SP_WPS_PATH', plugin_dir_path( __FILE__ ) );
			$this->define( 'SP_WPS_URL', plugin_dir_url( __FILE__ ) );
			$this->define( 'SP_WPS_BASENAME', plugin_basename( __FILE__ ) );
		}

		/**
		 * Define constant if not already set
		 *
		 * @since 2.0
		 *
		 * @param string      $name define name.
		 * @param string|bool $value define value.
		 */
		public function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Load TextDomain for plugin.
		 *
		 * @since 2.0
		 */
		public function load_text_domain() {
			load_textdomain( 'woo-product-slider', WP_LANG_DIR . '/woo-product-slider/languages/woo-product-slider-' . apply_filters( 'plugin_locale', get_locale(), 'woo-product-slider' ) . '.mo' );
			load_plugin_textdomain( 'woo-product-slider', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Add plugin action menu
		 *
		 * @param array  $links menu action links.
		 * @param string $file file basename.
		 *
		 * @return array
		 */
		public function add_plugin_action_links( $links, $file ) {

			if ( SP_WPS_BASENAME === $file ) {
				$new_links = sprintf( '<a href="%s">%s</a>', admin_url( 'post-new.php?post_type=sp_wps_shortcodes' ), __( 'Create Slider', 'woo-product-slider' ) );

				array_unshift( $links, $new_links );

				$links['go_pro'] = sprintf( '<a target="_blank" href="%1$s" style="color: #35b747; font-weight: 700;">Go Premium!</a>', 'https://shapedplugin.com/plugin/woocommerce-product-slider-pro/?ref=1' );
			}

			return $links;
		}

		/**
		 * Add plugin row meta link.
		 *
		 * @since 2.0
		 *
		 * @param array  $plugin_meta .
		 * @param string $file .
		 *
		 * @return array
		 */
		public function after_woo_product_slider_row_meta( $plugin_meta, $file ) {
			if ( SP_WPS_BASENAME === $file ) {
				$plugin_meta[] = '<a href="https://demo.shapedplugin.com/woocommerce-product-slider/" target="_blank">' . __( 'Live Demo', 'woo-product-slider' ) . '</a>';
			}

			return $plugin_meta;
		}

		/**
		 *  Sp_wps_shortcodes post type Save and update alert in Admin Dashboard created by Woo Product Slider.
		 *
		 * @param array $messages alert messages.
		 */
		public function sp_wps_update( $messages ) {
			global $post, $post_ID;
			$messages['sp_wps_shortcodes'][1] = __( 'Shortcode Updated', 'woo-product-slider' );
			$messages['sp_wps_shortcodes'][6] = __( 'Shortcode Published', 'woo-product-slider' );
			return $messages;
		}

		/**
		 * Autoload class files on demand
		 *
		 * @param string $class requested class name.
		 */
		public function autoload( $class ) {
			$name = explode( '_', $class );
			if ( isset( $name[2] ) ) {
				$class_name = strtolower( $name[2] );
				$filename   = SP_WPS_PATH . '/class/' . $class_name . '.php';

				if ( file_exists( $filename ) ) {
					require_once $filename;
				}
			}
		}

		/**
		 * Instantiate all the required classes
		 *
		 * @since 2.0
		 */
		public function instantiate() {

			$this->shortcode = SP_WPS_ShortCodes::getInstance();

			do_action( 'sp_wps_instantiate', $this );
		}

		/**
		 * Page router instantiate.
		 *
		 * @since 2.0
		 */
		public function page() {
			$this->router = SP_WPS_Router::instance();

			return $this->router;
		}

		/**
		 * Include the required files
		 *
		 * @return void
		 */
		public function includes() {
			$this->page()->sp_wps_function();
			$this->router->includes();
		}

		/**
		 * ShortCode Column.
		 *
		 * @return array $new_columns.
		 */
		public function add_shortcode_column() {
			$new_columns['cb']        = '<input type="checkbox" />';
			$new_columns['title']     = __( 'Slider Title', 'woo-product-slider' );
			$new_columns['shortcode'] = __( 'Shortcode', 'woo-product-slider' );
			$new_columns['']          = '';
			$new_columns['date']      = __( 'Date', 'woo-product-slider' );

			return $new_columns;
		}

		/**
		 * Add shortcode form.
		 *
		 * @param string $column shortcode form column.
		 * @param int    $post_id post_id.
		 */
		public function add_shortcode_form( $column, $post_id ) {

			switch ( $column ) {
				case 'shortcode':
					$input_tag          = wp_kses_allowed_html( 'post' );
					$input_tag['input'] = array(
						'style'    => array(),
						'type'     => array(),
						'readonly' => array(),
						'value'    => array(),
					);
					$column_field       = '<div class="wpspro-after-copy-text"><i class="fa fa-check-circle"></i>  Shortcode  Copied to Clipboard! </div><input style="width: 270px;padding: 6px;cursor:pointer;" type="text" readonly="readonly" value="[woo_product_slider id=&quot;' . $post_id . '&quot;]"/>';
					echo wp_kses( $column_field, $input_tag );
					break;
				default:
					break;

			} // end switch

		}

		/**
		 * Function creates product slider duplicate as a draft.
		 */
		public function sp_wps_duplicate_shortcode() {
			global $wpdb;
			if ( ! ( isset( $_GET['post'] ) || isset( $_POST['post'] ) || ( isset( $_REQUEST['action'] ) && 'sp_wps_duplicate_shortcode' === $_REQUEST['action'] ) ) ) {
				wp_die( esc_html__( 'No shortcode to duplicate has been supplied!', 'woo-product-slider' ) );
			}

			/*
			 * Nonce verification
			 */
			if ( ! isset( $_GET['sp_wps_duplicate_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['sp_wps_duplicate_nonce'] ) ), basename( __FILE__ ) ) ) {
				return;
			}

			/*
			 * Get the original shortcode id
			 */
			$post_id = ( isset( $_GET['post'] ) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );

			/*
			 * and all the original shortcode data then
			 */
			$post = get_post( $post_id );

			$current_user    = wp_get_current_user();
			$new_post_author = $current_user->ID;

			/*
			 * if shortcode data exists, create the shortcode duplicate
			 */
			if ( isset( $post ) && null !== $post ) {
				/*
				 * new shortcode data array
				 */
				$args = array(
					'comment_status' => $post->comment_status,
					'ping_status'    => $post->ping_status,
					'post_author'    => $new_post_author,
					'post_content'   => $post->post_content,
					'post_excerpt'   => $post->post_excerpt,
					'post_name'      => $post->post_name,
					'post_parent'    => $post->post_parent,
					'post_password'  => $post->post_password,
					'post_status'    => 'draft',
					'post_title'     => $post->post_title,
					'post_type'      => $post->post_type,
					'to_ping'        => $post->to_ping,
					'menu_order'     => $post->menu_order,
				);

				/*
				 * insert the shortcode by wp_insert_post() function
				 */
				$new_post_id = wp_insert_post( $args );

				/*
				 * get all current post terms ad set them to the new post draft
				 */
				$taxonomies = get_object_taxonomies( $post->post_type ); // returns array of taxonomy names for post type, ex array("category", "post_tag").
				foreach ( $taxonomies as $taxonomy ) {
					$post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
					wp_set_object_terms( $new_post_id, $post_terms, $taxonomy, false );
				}

				/*
				 * duplicate all post meta just in two SQL queries
				 */

				$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=%d", $post_id ) );
				if ( count( $post_meta_infos ) !== 0 ) {
					$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
					foreach ( $post_meta_infos as $meta_info ) {
						$meta_key = $meta_info->meta_key;
						if ( '_wp_old_slug' === $meta_key ) {
							continue;
						}
						$meta_value      = addslashes( $meta_info->meta_value );
						$sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
					}
					$sql_query .= implode( ' UNION ALL ', $sql_query_sel );
					// @codingStandardsIgnoreLine
					$wpdb->query( $sql_query );
				}

				/*
				 * finally, redirect to the edit post screen for the new draft
				 */
				wp_safe_redirect( admin_url( 'edit.php?post_type=' . $post->post_type ) );

				exit;
			} else {
				wp_die( esc_html__( 'Shortcode creation failed, could not find original post: ', 'woo-product-slider' ) . esc_html( $post_id ) );
			}
		}

		/**
		 * Add the duplicate link to action list for post_row_actions.
		 *
		 * @param array  $actions duplicate link action.
		 * @param object $post post.
		 * @return array $actions
		 */
		public function sp_wps_duplicate_shortcode_link( $actions, $post ) {
			if ( current_user_can( 'edit_posts' ) && 'sp_wps_shortcodes' === $post->post_type ) {
				$actions['duplicate'] = '<a href="' . wp_nonce_url( 'admin.php?action=sp_wps_duplicate_shortcode&post=' . $post->ID, basename( __FILE__ ), 'sp_wps_duplicate_nonce' ) . '" rel="permalink">' . __( 'Duplicate', 'woo-product-slider' ) . '</a>';
			}
			return $actions;
		}

		/**
		 * Redirect after active
		 *
		 * @param string $plugin Plugin basename.
		 */
		public function redirect_help_page( $plugin ) {
			if ( SP_WPS_BASENAME === $plugin ) {
				wp_safe_redirect( admin_url( 'edit.php?post_type=sp_wps_shortcodes&page=wps_help' ) );
				exit;
			}
		}

		/**
		 * WooCommerce not installed error message
		 */
		public function error_admin_notice() {
			$link    = esc_url(
				add_query_arg(
					array(
						'tab'       => 'plugin-information',
						'plugin'    => 'woocommerce',
						'TB_iframe' => 'true',
						'width'     => '640',
						'height'    => '500',
					),
					admin_url( 'plugin-install.php' )
				)
			);
			$outline = '<div class="error"><p>' . wp_kses_post( 'You must install and activate <a class="thickbox open-plugin-details-modal" href="' . $link . '"><strong>WooCommerce</strong></a> plugin to make the <strong>Product Slider for WooCommerce</strong> work.', 'woo-product-slider' ) . '</p></div>';
			echo wp_kses_post( $outline );
		}

		/**
		 * Gallery Slider for WooCommerce admin notice.
		 *
		 * @since 2.2.11
		 */
		public function woo_gallery_slider_admin_notice() {

			if ( is_plugin_active( 'gallery-slider-for-woocommerce/woo-gallery-slider.php' ) ) {
				return;
			}
			if ( get_option( 'sp-woogs-notice-dismissed' ) ) {
				return;
			}

			$current_screen        = get_current_screen();
			$the_current_post_type = $current_screen->post_type;

			if ( current_user_can( 'install_plugins' ) && 'sp_wps_shortcodes' === $the_current_post_type ) {

				$plugins     = array_keys( get_plugins() );
				$slug        = 'gallery-slider-for-woocommerce';
				$icon        = SP_WPS_URL . 'admin/assets/images/woogs-logo.svg';
				$button_text = esc_html__( 'Install', 'woo-product-slider' );
				$install_url = esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $slug ), 'install-plugin_' . $slug ) );

				if ( in_array( 'gallery-slider-for-woocommerce/woo-gallery-slider.php', $plugins, true ) ) {
					$button_text = esc_html__( 'Activate', 'woo-product-slider' );
					$install_url = esc_url( self_admin_url( 'plugins.php?action=activate&plugin=' . urlencode( 'gallery-slider-for-woocommerce/woo-gallery-slider.php' ) . '&plugin_status=all&paged=1&s&_wpnonce=' . urlencode( wp_create_nonce( 'activate-plugin_gallery-slider-for-woocommerce/woo-gallery-slider.php' ) ) ) );
				}

				$popup_url = esc_url(
					add_query_arg(
						array(
							'tab'       => 'plugin-information',
							'plugin'    => $slug,
							'TB_iframe' => 'true',
							'width'     => '640',
							'height'    => '500',
						),
						admin_url( 'plugin-install.php' )
					)
				);

				echo sprintf( '<div class="woogs-notice notice is-dismissible"><img src="%1$s"/><div class="woogs-notice-text">To enable single <strong>Product Image Gallery Slider</strong>, %4$s the <a href="%2$s" class="thickbox open-plugin-details-modal"><strong>Gallery Slider for WooCommerce</strong></a> plugin <a href="%3$s" rel="noopener" class="woogs-activate-btn">%4$s</a></div></div>', esc_url( $icon ), esc_url( $popup_url ), esc_url( $install_url ), esc_html( $button_text ) );
			}

		}

		/**
		 * Dismiss WQV notice message
		 *
		 * @since 2.1.11
		 *
		 * @return void
		 */
		public function dismiss_wqv_notice() {
			update_option( 'sp-wqv-notice-dismissed', 1 );
		}

		/**
		 * Dismiss Gallery Slider notice message
		 *
		 * @since 2.2.11
		 *
		 * @return void
		 */
		public function dismiss_woo_gallery_slider_notice() {
			update_option( 'sp-woogs-notice-dismissed', 1 );
		}

	}
}

/**
 * Returns the main instance.
 *
 * @since 2.0
 * @return SP_WooCommerce_Product_Slider
 */
function sp_woo_product_slider() {
	return SP_WooCommerce_Product_Slider::instance();
}

if ( is_woo_product_slider_pro() ) {
	// sp_post_carousel instance.
	sp_woo_product_slider();
}
