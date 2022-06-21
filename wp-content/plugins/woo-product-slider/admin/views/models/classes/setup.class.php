<?php
/**
 * Framework setup.class file.
 *
 * @link http://shapedplugin.com
 * @since 2.0.0
 * @package Woo_Product_Slider.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPWPS' ) ) {
	/**
	 *
	 * Setup Class
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPWPS {

		/**
		 * Version variable.
		 *
		 * @var $version
		 */
		public static $version = '2.1.4';
		/**
		 * Dir variable.
		 *
		 * @var $dir
		 */
		public static $dir = null;
		/**
		 * Url variable.
		 *
		 * @var $url
		 */
		public static $url = null;
		/**
		 * Inited variable.
		 *
		 * @var $inited
		 */
		public static $inited = array();
		/**
		 * Fields variable.
		 *
		 * @var $fields
		 */
		public static $fields = array();
		/**
		 * Args variable.
		 *
		 * @var $args
		 */
		public static $args = array(
			'options'   => array(),
			'metaboxes' => array(),
		);

		/**
		 * Init function.
		 */
		public static function init() {

			// init action.
			do_action( 'spwps_init' );

			// set constants.
			self::constants();

			// include files.
			self::includes();

			add_action( 'after_setup_theme', array( 'SPWPS', 'setup' ) );
			add_action( 'init', array( 'SPWPS', 'setup' ) );
			add_action( 'switch_theme', array( 'SPWPS', 'setup' ) );
			add_action( 'admin_enqueue_scripts', array( 'SPWPS', 'add_admin_enqueue_scripts' ), 20 );
			add_action( 'admin_head', array( 'SPWPS', 'add_admin_head_css' ), 99 );

		}

		/**
		 * Setup function.
		 */
		public static function setup() {

			// setup options.
			$params = array();
			if ( ! empty( self::$args['options'] ) ) {
				foreach ( self::$args['options'] as $key => $value ) {
					if ( ! empty( self::$args['sections'][ $key ] ) && ! isset( self::$inited[ $key ] ) ) {

						$params['args']       = $value;
						$params['sections']   = self::$args['sections'][ $key ];
						self::$inited[ $key ] = true;

						SPWPS_Options::instance( $key, $params );
					}
				}
			}

			// setup metaboxes.
			$params = array();
			if ( ! empty( self::$args['metaboxes'] ) ) {
				foreach ( self::$args['metaboxes'] as $key => $value ) {
					if ( ! empty( self::$args['sections'][ $key ] ) && ! isset( self::$inited[ $key ] ) ) {

						$params['args']       = $value;
						$params['sections']   = self::$args['sections'][ $key ];
						self::$inited[ $key ] = true;

						SPWPS_Metabox::instance( $key, $params );

					}
				}
			}

			do_action( 'spwps_loaded' );

		}

		/**
		 * Create options function.
		 *
		 * @param int   $id Create options id.
		 * @param array $args Create options args.
		 */
		public static function create_options( $id, $args = array() ) {
			self::$args['options'][ $id ] = $args;
		}

		/**
		 * Create metabox options.
		 *
		 * @param int   $id Create metabox id.
		 * @param array $args Create metabox args.
		 */
		public static function create_metabox( $id, $args = array() ) {
			self::$args['metaboxes'][ $id ] = $args;
		}

		/**
		 * Create section.
		 *
		 * @param int   $id Create section id.
		 * @param array $sections Create section args.
		 */
		public static function create_section( $id, $sections ) {
			self::$args['sections'][ $id ][] = $sections;
			self::set_used_fields( $sections );
		}

		/**
		 * Constants function.
		 */
		public static function constants() {

			// we need this path-finder code for set URL of framework.
			$dirname        = wp_normalize_path( dirname( dirname( __FILE__ ) ) );
			$theme_dir      = wp_normalize_path( get_parent_theme_file_path() );
			$plugin_dir     = wp_normalize_path( WP_PLUGIN_DIR );
			$located_plugin = ( preg_match( '#' . self::sanitize_dirname( $plugin_dir ) . '#', self::sanitize_dirname( $dirname ) ) ) ? true : false;
			$directory      = ( $located_plugin ) ? $plugin_dir : $theme_dir;
			$directory_uri  = ( $located_plugin ) ? WP_PLUGIN_URL : get_parent_theme_file_uri();
			$foldername     = str_replace( $directory, '', $dirname );
			$protocol_uri   = ( is_ssl() ) ? 'https' : 'http';
			$directory_uri  = set_url_scheme( $directory_uri, $protocol_uri );

			self::$dir = $dirname;
			self::$url = $directory_uri . $foldername;

		}

		/**
		 * Include plugin file function.
		 *
		 * @param string  $file include file.
		 * @param boolean $load true/false condition.
		 */
		public static function include_plugin_file( $file, $load = true ) {

			$path     = '';
			$file     = ltrim( $file, '/' );
			$override = apply_filters( 'spwps_override', 'spwps-override' );

			if ( file_exists( get_parent_theme_file_path( $override . '/' . $file ) ) ) {
				$path = get_parent_theme_file_path( $override . '/' . $file );
			} elseif ( file_exists( get_theme_file_path( $override . '/' . $file ) ) ) {
				$path = get_theme_file_path( $override . '/' . $file );
			} elseif ( file_exists( self::$dir . '/' . $override . '/' . $file ) ) {
				$path = self::$dir . '/' . $override . '/' . $file;
			} elseif ( file_exists( self::$dir . '/' . $file ) ) {
				$path = self::$dir . '/' . $file;
			}

			if ( ! empty( $path ) && ! empty( $file ) && $load ) {

				global $wp_query;

				if ( is_object( $wp_query ) && function_exists( 'load_template' ) ) {

					load_template( $path, true );

				} else {

					require_once $path;

				}
			} else {

				return self::$dir . '/' . $file;

			}

		}

		/**
		 * Is_active_plugin function.
		 *
		 * @param string $file Active plugin file.
		 */
		public static function is_active_plugin( $file = '' ) {
			return in_array( $file, (array) get_option( 'active_plugins', array() ), true );
		}

		/**
		 * Sanitize dirname.
		 *
		 * @param string $dirname Sanitize dirname.
		 */
		public static function sanitize_dirname( $dirname ) {
			return preg_replace( '/[^A-Za-z]/', '', $dirname );
		}

		/**
		 * Set plugin url.
		 *
		 * @param string $file Set plugin url.
		 */
		public static function include_plugin_url( $file ) {
			return esc_url( self::$url ) . '/' . ltrim( $file, '/' );
		}

		/**
		 * General includes.
		 */
		public static function includes() {

			// includes helpers.
			self::include_plugin_file( 'functions/actions.php' );
			self::include_plugin_file( 'functions/deprecated.php' );
			self::include_plugin_file( 'functions/helpers.php' );
			self::include_plugin_file( 'functions/sanitize.php' );
			self::include_plugin_file( 'functions/validate.php' );

			// includes classes.
			self::include_plugin_file( 'classes/abstract.class.php' );
			self::include_plugin_file( 'classes/fields.class.php' );
			self::include_plugin_file( 'classes/options.class.php' );
			self::include_plugin_file( 'classes/metabox.class.php' );

		}

		/**
		 * Include field.
		 *
		 * @param string $type Include field type.
		 */
		public static function maybe_include_field( $type = '' ) {
			if ( ! class_exists( 'SPWPS_Field_' . $type ) && class_exists( 'SPWPS_Fields' ) ) {
				self::include_plugin_file( 'fields/' . $type . '/' . $type . '.php' );
			}
		}

		/**
		 * Get all of fields.
		 *
		 * @param string $sections Get all of sections fields.
		 */
		public static function set_used_fields( $sections ) {

			if ( ! empty( $sections['fields'] ) ) {

				foreach ( $sections['fields'] as $field ) {

					if ( ! empty( $field['fields'] ) ) {
						self::set_used_fields( $field );
					}

					if ( ! empty( $field['tabs'] ) ) {
						self::set_used_fields( array( 'fields' => $field['tabs'] ) );
					}

					if ( ! empty( $field['accordions'] ) ) {
						self::set_used_fields( array( 'fields' => $field['accordions'] ) );
					}

					if ( ! empty( $field['type'] ) ) {
						self::$fields[ $field['type'] ] = $field;
					}
				}
			}

		}

		/**
		 * Enqueue admin and fields styles and scripts.
		 */
		public static function add_admin_enqueue_scripts() {

			// check for developer mode.
			$min = ( apply_filters( 'spwps_dev_mode', false ) || WP_DEBUG ) ? '' : '.min';

			// admin utilities.
			wp_enqueue_media();

			// wp color picker.
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );

			// font awesome 4 and 5.
			if ( apply_filters( 'spwps_fa4', false ) ) {
				wp_enqueue_style( 'spwps-fa', 'https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome' . $min . '.css', array(), SP_WPS_VERSION, 'all' );
			} else {
				wp_enqueue_style( 'spwps-fa5', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.0/css/all' . $min . '.css', array(), SP_WPS_VERSION, 'all' );
				wp_enqueue_style( 'spwps-fa5-v4-shims', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.0/css/v4-shims' . $min . '.css', array(), SP_WPS_VERSION, 'all' );
			}

			// framework core styles.
			wp_enqueue_style( 'spwps', self::include_plugin_url( 'assets/css/spwps' . $min . '.css' ), array(), SP_WPS_VERSION, 'all' );

			// rtl styles.
			if ( is_rtl() ) {
				wp_enqueue_style( 'spwps-rtl', self::include_plugin_url( 'assets/css/spwps-rtl' . $min . '.css' ), array(), SP_WPS_VERSION, 'all' );
			}

			// framework core scripts.
			wp_enqueue_script( 'spwps-plugins', self::include_plugin_url( 'assets/js/spwps-plugins' . $min . '.js' ), array(), SP_WPS_VERSION, true );
			wp_enqueue_script( 'spwps', self::include_plugin_url( 'assets/js/spwps' . $min . '.js' ), array( 'spwps-plugins' ), SP_WPS_VERSION, true );

			wp_localize_script(
				'spwps',
				'spwps_vars',
				array(
					'color_palette' => apply_filters( 'spwps_color_palette', array() ),
					'i18n'          => array(
						// global localize.
						'confirm'             => esc_html__( 'Are you sure?', 'woo-product-slider' ),
						'reset_notification'  => esc_html__( 'Restoring options.', 'woo-product-slider' ),
						'import_notification' => esc_html__( 'Importing options.', 'woo-product-slider' ),

						// chosen localize.
						'typing_text'         => esc_html__( 'Please enter s or more characters', 'woo-product-slider' ),
						'searching_text'      => esc_html__( 'Searching...', 'woo-product-slider' ),
						'no_results_text'     => esc_html__( 'No results match', 'woo-product-slider' ),
					),
				)
			);

			// load admin enqueue scripts and styles.
			$enqueued = array();

			if ( ! empty( self::$fields ) ) {
				foreach ( self::$fields as $field ) {
					if ( ! empty( $field['type'] ) ) {
						$classname = 'SPWPS_Field_' . $field['type'];
						self::maybe_include_field( $field['type'] );
						if ( class_exists( $classname ) && method_exists( $classname, 'enqueue' ) ) {
							$instance = new $classname( $field );
							if ( method_exists( $classname, 'enqueue' ) ) {
								$instance->enqueue();
							}
							unset( $instance );
						}
					}
				}
			}

			do_action( 'spwps_enqueue' );

		}

		/**
		 * WP 5.2 fallback
		 * This function has been created as temporary.
		 * It will be remove after stable version of wp 5.3.
		 */
		public static function add_admin_head_css() {

			global $wp_version;

			$current_branch = implode( '.', array_slice( preg_split( '/[.-]/', $wp_version ), 0, 2 ) );

			if ( version_compare( $current_branch, '5.3', '<' ) ) {

				echo '<style type="text/css">
          .spwps-field-slider .spwps--unit,
          .spwps-field-border .spwps--label,
          .spwps-field-spacing .spwps--label,
          .spwps-field-dimensions .spwps--label,
          .spwps-field-spinner .ui-button-text-only{
            border-color: #ddd;
          }
          .spwps-warning-primary{
            box-shadow: 0 1px 0 #bd2130 !important;
          }
          .spwps-warning-primary:focus{
            box-shadow: none !important;
          }
        </style>';

			}

		}

		/**
		 * Add a new framework field.
		 *
		 * @param array  $field field.
		 * @param string $value field value.
		 * @param string $unique field unique.
		 * @param string $where field where.
		 * @param string $parent field parent.
		 */
		public static function field( $field = array(), $value = '', $unique = '', $where = '', $parent = '' ) {

			// Check for unallow fields.
			if ( ! empty( $field['_notice'] ) ) {

				$field_type = $field['type'];

				$field            = array();
				$field['content'] = sprintf( wp_kses_post( 'Ooops! This field type (%s) can not be used here, yet.', 'woo-product-slider' ), '<strong>' . $field_type . '</strong>' );
				$field['type']    = 'notice';
				$field['style']   = 'danger';

			}

			$depend     = '';
			$hidden     = '';
			$unique     = ( ! empty( $unique ) ) ? $unique : '';
			$class      = ( ! empty( $field['class'] ) ) ? ' ' . esc_attr( $field['class'] ) : '';
			$is_pseudo  = ( ! empty( $field['pseudo'] ) ) ? ' spwps-pseudo-field' : '';
			$field_type = ( ! empty( $field['type'] ) ) ? esc_attr( $field['type'] ) : '';

			if ( ! empty( $field['dependency'] ) ) {

				$dependency      = $field['dependency'];
				$hidden          = ' hidden';
				$data_controller = '';
				$data_condition  = '';
				$data_value      = '';
				$data_global     = '';

				if ( is_array( $dependency[0] ) ) {
					$data_controller = implode( '|', array_column( $dependency, 0 ) );
					$data_condition  = implode( '|', array_column( $dependency, 1 ) );
					$data_value      = implode( '|', array_column( $dependency, 2 ) );
					$data_global     = implode( '|', array_column( $dependency, 3 ) );
				} else {
					$data_controller = ( ! empty( $dependency[0] ) ) ? $dependency[0] : '';
					$data_condition  = ( ! empty( $dependency[1] ) ) ? $dependency[1] : '';
					$data_value      = ( ! empty( $dependency[2] ) ) ? $dependency[2] : '';
					$data_global     = ( ! empty( $dependency[3] ) ) ? $dependency[3] : '';
				}

				$depend .= ' data-controller=' . esc_attr( $data_controller ) . '';
				$depend .= ' data-condition=' . esc_attr( $data_condition ) . '';
				$depend .= ' data-value=' . esc_attr( $data_value ) . '';
				$depend .= ( ! empty( $data_global ) ) ? ' data-depend-global="true"' : '';

			}

			if ( ! empty( $field_type ) ) {

				echo '<div class="spwps-field spwps-field-' . esc_attr( $field_type . $is_pseudo . $class . $hidden ) . '"' . esc_attr( $depend ) . '>';

				if ( ! empty( $field['fancy_title'] ) ) {
					echo '<div class="spwps-fancy-title">' . wp_kses_post( $field['fancy_title'] ) . '</div>';
				}

				if ( ! empty( $field['title'] ) ) {
					echo '<div class="spwps-title">';
					echo '<h4>' . wp_kses_post( $field['title'] ) . '</h4>';
					echo ( ! empty( $field['title_help'] ) ) ? '<div class="spwps-help"><span class="spwps-help-text">' . wp_kses_post( $field['title_help'] ) . '</span><i class="fas fa-question-circle"></i></div>' : '';
					echo ( ! empty( $field['subtitle'] ) ) ? '<div class="spwps-text-subtitle">' . wp_kses_post( $field['subtitle'] ) . '</div>' : '';
					echo '</div>';
				}

				echo ( ! empty( $field['title'] ) || ! empty( $field['fancy_title'] ) ) ? '<div class="spwps-fieldset">' : '';

				$value = ( ! isset( $value ) && isset( $field['default'] ) ) ? $field['default'] : $value;
				$value = ( isset( $field['value'] ) ) ? $field['value'] : $value;

				self::maybe_include_field( $field_type );

				$classname = 'SPWPS_Field_' . $field_type;

				if ( class_exists( $classname ) ) {
					$instance = new $classname( $field, $value, $unique, $where, $parent );
					$instance->render();
				} else {
					echo '<p>' . esc_html__( 'This field class is not available!', 'woo-product-slider' ) . '</p>';
				}
			} else {
				echo '<p>' . esc_html__( 'This type is not found!', 'woo-product-slider' ) . '</p>';
			}

			echo ( ! empty( $field['title'] ) || ! empty( $field['fancy_title'] ) ) ? '</div>' : '';
			echo '<div class="clear"></div>';
			echo '</div>';

		}

	}

	SPWPS::init();
}
