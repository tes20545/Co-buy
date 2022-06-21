<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/admin
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

/**
 * Woo Gallery Slider Admin class
 */
class Woo_Gallery_Slider_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		// Autoloading system.
		spl_autoload_register( array( $this, 'autoload' ) );
		WCGS_Settings::options( 'wcgs_settings' );
	}

	/**
	 * Autoload class files on demand
	 *
	 * @since 1.0.0
	 * @access private
	 * @param string $class requested class name.
	 */
	private function autoload( $class ) {
		$name = explode( '_', $class );
		if ( isset( $name[1] ) ) {
			$class_name        = strtolower( $name[1] );
			$spto_config_paths = array( 'partials', 'partials/sections' );
			$wcgs_plugin_path  = plugin_dir_path( __FILE__ );

			foreach ( $spto_config_paths as $sptp_path ) {
				$filename = $wcgs_plugin_path . '/' . $sptp_path . '/class-wcgs-' . $class_name . '.php';
				if ( file_exists( $filename ) ) {
					require_once $filename;
				}
			}
		}
	}

	/**
	 * Implementaion of yield for better performance.
	 * https://medium.com/tech-tajawal/use-memory-gently-with-yield-in-php-7e62e2480b8d
	 * wcgs_reduce_processor_use
	 *
	 * @param array $array array.
	 */
	public function wcgs_reduce_processor_use( $array ) {
		$array_length = count( $array );
		for ( $i = 0; $i < $array_length; $i++ ) {
			yield $array[ $i ];
		}
	}

	/**
	 * Add WooCommerce Product Variation Gallery field from WCGS plugin.
	 *
	 * @param string $loop Product Variation id.
	 * @param mixed  $variation_data Product variation data.
	 * @param object $variation Product variation.
	 * @since    1.0.0
	 * @access public
	 */
	public function woocommerce_add_gallery_product_variation( $loop, $variation_data, $variation ) {
		?>
		<div class="wcgs-variation-gallery form-row form-row-full">
		<h4><?php esc_html_e( 'Variation Image Gallery', 'gallery-slider-for-woocommerce' ); ?><h4>
		<div class="wcgs-gallery-items" id="<?php echo esc_attr( $variation->ID ); ?>">
			<?php

			$variation_gallery     = get_post_meta( $variation->ID, 'woo_gallery_slider', true );
			$variation_gallery_arr = substr( $variation_gallery, 1, -1 );
			if ( ! empty( $variation_gallery_arr ) ) {
				$image_ids = explode( ',', $variation_gallery_arr );

				$yield_image_ids = $this->wcgs_reduce_processor_use( $image_ids );
				$count           = 1;
				foreach ( $yield_image_ids as $image_id ) {
					$image_attachment = wp_get_attachment_image_src( $image_id )[0];
					$video_url        = get_post_meta( $image_id, 'wcgs_video', true );
					if ( 2 >= $count ) {
						?>
						<div class="wcgs-image <?php echo $video_url ? 'wcgs-video' : ''; ?>" data-attachmentid="<?php echo esc_attr( $image_id ); ?>">
							<img src="<?php echo esc_attr( $image_attachment ); ?>" style="max-width:100%;display:inline-block;" />
							<div class="wcgs-image-remover"><span class="dashicons dashicons-no"></span></div>
							<?php
							if ( $video_url ) {
								?>
								<div class="wcgs-video-icons"><i class="dashicons dashicons-video-alt3"></i></div>
								<?php
							}
							?>
						</div>
						<?php
					}

					$count++;
				}
			}
			?>
		</div>
		<p>
			<button class="wcgs-remove-all-images button
			<?php
			if ( empty( $variation_gallery_arr ) ) {
				echo 'hidden';
			}
			?>
			"><?php esc_html_e( 'Remove all', 'gallery-slider-for-woocommerce' ); ?></button>
			<button class="wcgs-upload-image button
			<?php
			if ( ! empty( $variation_gallery_arr ) ) {
				echo 'hidden';
			}
			?>
			" id="<?php echo 'wcgs-upload-' . esc_attr( $variation->ID ); ?>"><?php esc_html_e( 'Add Gallery Images', 'gallery-slider-for-woocommerce' ); ?></button>
			<button class="wcgs-upload-more-image button
			<?php
			if ( empty( $variation_gallery_arr ) ) {
				echo 'hidden';
			}
			?>
			"><?php esc_html_e( 'Add more', 'gallery-slider-for-woocommerce' ); ?></button>
			<button class="wcgs-edit button
			<?php
			if ( empty( $variation_gallery_arr ) ) {
				echo 'hidden';
			}
			?>
			">
			<?php esc_html_e( 'Edit Gallery', 'gallery-slider-for-woocommerce' ); ?>
			</button>
			<span class="wcgs-pro-notice 
			<?php
			$image_ids = explode( ',', $variation_gallery_arr );
			if ( 2 >= count( $image_ids ) ) {
				echo 'hidden';
			}
			?>
			" style="color:red;">To add more images & videos, <a href="https://shapedplugin.com/plugin/woocommerce-gallery-slider-pro/?ref=143" target="_blank" style="font-style: italic;">Upgrade To Pro!</a></span>

		</p>
		<script type="text/javascript">
		jQuery(document).ready( function($) {
			$('.wcgs-gallery-items').sortable({
				placeholder: "ui-state-highlight",
				stop: function() {
					var variableID = $(this).parents('.woocommerce_variation').find('h3 strong').text();
					var newWcgsArr = [];
					var _newWcgsArrLength = $('.wcgs-gallery-items'+variableID).find('.wcgs-image').length;
					$('.wcgs-gallery-items'+variableID).find('.wcgs-image').each( function() {
						var imageID = $(this).data('attachmentid');
						newWcgsArr.push(imageID);
					});
					$('.wcgs-gallery-items'+variableID).parents('.woocommerce_variable_attributes').find('.wcgs-gallery').val(JSON.stringify(newWcgsArr)).trigger('change');
				}
			});
		});
		</script>
		<div class="hidden">
		<?php
		woocommerce_wp_text_input(
			array(
				'id'    => 'woo_gallery_slider[' . $loop . ']',
				'class' => 'wcgs-gallery',
				'label' => '',
				'value' => get_post_meta( $variation->ID, 'woo_gallery_slider', true ),
			)
		);
		?>
		</div>
		</div>
		<?php
	}

	/**
	 * Woocommerce save gallery product variation.
	 *
	 * @param string $variation_id save gallery product.
	 * @param string $i save gallery product id.
	 * @return void
	 */
	public function woocommerce_save_gallery_product_variation( $variation_id, $i ) {
		$custom_field = sanitize_text_field( $_POST['woo_gallery_slider'][ $i ] );
		if ( isset( $custom_field ) ) {
			update_post_meta( $variation_id, 'woo_gallery_slider', $custom_field );
		}
	}

	/**
	 * Woocommerce add gallery product variation data
	 *
	 * @param array $variations gallery product variation data.
	 * @return array
	 */
	public function woocommerce_add_gallery_product_variation_data( $variations ) {
		$variations['woo_gallery_slider'] = get_post_meta( $variations['variation_id'], 'woo_gallery_slider', true );
		return $variations;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 * @access public
	 */
	public function enqueue_styles() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Gallery_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Gallery_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$current_screen = get_current_screen();
		if ( 'toplevel_page_wpgs-settings' === $current_screen->base ) {
			wp_enqueue_style( 'wp-jquery-ui' );
			// wp_enqueue_style( 'wcgs_font-awesome5', plugin_dir_url( __FILE__ ) . 'css/font-awesome5.min.css', $this->version, 'all' );

			// Font awesome 4 and 5 loader.
			if ( apply_filters( 'sp_wcgs_fa4', false ) ) {
				wp_enqueue_style( 'sp_wcgs-fa', 'https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all' );
			} else {
				wp_enqueue_style( 'sp_wcgs-fa5', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/all.min.css', array(), '5.15.3', 'all' );
				wp_enqueue_style( 'sp_wcgs-fa5-v4-shims', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/v4-shims.min.css', array(), '5.15.3', 'all' );
			}
		}
		wp_enqueue_style( 'sp-wcgs-notices', WOO_GALLERY_SLIDER_URL . 'admin/css/notices.min.css', array(), WOO_GALLERY_SLIDER_VERSION, 'all' );
		wp_enqueue_style( $this->plugin_name, WOO_GALLERY_SLIDER_URL . 'admin/css/woo-gallery-slider-admin.min.css', array(), WOO_GALLERY_SLIDER_VERSION, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 * @access public
	 */
	public function enqueue_scripts() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Gallery_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Gallery_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if ( ! did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}
		add_thickbox();
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo-gallery-slider-admin.js', array( 'jquery' ), $this->version, true );

		wp_enqueue_script( $this->plugin_name );
	}

}
