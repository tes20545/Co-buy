<?php
/**
 * Shortcode render file.
 *
 * @package    Woo_Product_Slider
 * @subpackage Woo_Product_Slider/public/views
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

/**
 * Shortcode class.
 */
class SP_WPS_ShortCode {
	/**
	 * SP_WPS_ShortCode instance.
	 *
	 * @var SP_WPS_ShortCode single instance of the class
	 * @since 2.0
	 */
	protected static $_instance = null;

	/**
	 * Main SP Instance
	 *
	 * @since 2.0
	 * @static
	 * @return self Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * SP_WPS_ShortCode constructor.
	 */
	public function __construct() {
		add_shortcode( 'woo_product_slider', array( $this, 'wps_shortcode' ) );
	}

	/**
	 * Full html show.
	 *
	 * @param array $post_id Shortcode ID.
	 * @param array $shortcode_data get all meta options.
	 * @param array $main_section_title shows section title.
	 */
	public static function spwps_html_show( $post_id, $shortcode_data, $main_section_title ) {
		// General Settings.
		$theme_style               = ( isset( $shortcode_data['theme_style'] ) ? $shortcode_data['theme_style'] : 'theme_one' );
		$product_type              = ( isset( $shortcode_data['product_type'] ) ? $shortcode_data['product_type'] : 'latest_products' );
		$number_of_total_products  = ( isset( $shortcode_data['number_of_total_products'] ) ? $shortcode_data['number_of_total_products'] : 16 );
		$hide_out_of_stock_product = ( isset( $shortcode_data['hide_out_of_stock_product'] ) ? $shortcode_data['hide_out_of_stock_product'] : false );
		$number_of_column          = ( isset( $shortcode_data['number_of_column'] ) ? $shortcode_data['number_of_column'] : array(
			'number1' => '4',
			'number2' => '3',
			'number3' => '2',
			'number4' => '1',
		) );
		$product_order_by          = ( isset( $shortcode_data['product_order_by'] ) ? $shortcode_data['product_order_by'] : 'date' );
		$product_order             = ( isset( $shortcode_data['product_order'] ) ? $shortcode_data['product_order'] : 'DESC' );
		$preloader                 = ( isset( $shortcode_data['preloader'] ) ? $shortcode_data['preloader'] : false );

		// Slider Controls.
		$auto_play         = ( isset( $shortcode_data['carousel_auto_play'] ) && $shortcode_data['carousel_auto_play'] ? 'true' : 'false' );
		$auto_play_speed   = ( isset( $shortcode_data['carousel_auto_play_speed'] ) ? $shortcode_data['carousel_auto_play_speed'] : 3000 );
		$scroll_speed      = ( isset( $shortcode_data['carousel_scroll_speed'] ) ? $shortcode_data['carousel_scroll_speed'] : 600 );
		$pause_on_hover    = ( isset( $shortcode_data['carousel_pause_on_hover'] ) && $shortcode_data['carousel_pause_on_hover'] ? 'true' : 'false' );
		$carousel_infinite = ( isset( $shortcode_data['carousel_infinite'] ) && $shortcode_data['carousel_infinite'] ? 'true' : 'false' );
		$rtl_mode          = ( isset( $shortcode_data['rtl_mode'] ) && $shortcode_data['rtl_mode'] ? 'true' : 'false' );
		$the_rtl           = ( 'true' === $rtl_mode ) ? ' dir="rtl"' : ' dir="ltr"';
		$navigation_data   = ( isset( $shortcode_data['navigation_arrow'] ) ? $shortcode_data['navigation_arrow'] : '' );
		switch ( $navigation_data ) {
			case 'true':
				$navigation        = 'true';
				$navigation_mobile = 'true';
				break;
			case 'hide_on_mobile':
				$navigation        = 'true';
				$navigation_mobile = 'false';
				break;
			default:
				$navigation        = 'false';
				$navigation_mobile = 'false';
		}
		$nav_arrow_colors = ( isset( $shortcode_data['navigation_arrow_colors'] ) ? $shortcode_data['navigation_arrow_colors'] : array(
			'color'            => '#444444',
			'hover_color'      => '#ffffff',
			'background'       => 'transparent',
			'hover_background' => '#444444',
			'border'           => '#aaaaaa',
			'hover_border'     => '#444444',
		) );
		$pagination_data  = ( isset( $shortcode_data['pagination'] ) ? $shortcode_data['pagination'] : '' );
		switch ( $pagination_data ) {
			case 'true':
				$pagination        = 'true';
				$pagination_mobile = 'true';
				break;
			case 'hide_on_mobile':
				$pagination        = 'true';
				$pagination_mobile = 'false';
				break;
			default:
				$pagination        = 'false';
				$pagination_mobile = 'false';
		}
		$pagination_dots_bg = ( isset( $shortcode_data['pagination_dots_color'] ) ? $shortcode_data['pagination_dots_color'] : array(
			'color'        => '#cccccc',
			'active_color' => '#333333',
		) );
		$carousel_swipe     = ( isset( $shortcode_data['carousel_swipe'] ) && $shortcode_data['carousel_swipe'] ? 'true' : 'false' );
		$carousel_draggable = ( isset( $shortcode_data['carousel_draggable'] ) && $shortcode_data['carousel_draggable'] ? 'true' : 'false' );

		// Display Options.
		$slider_title             = ( isset( $shortcode_data['slider_title'] ) ? $shortcode_data['slider_title'] : false );
		$product_name             = ( isset( $shortcode_data['product_name'] ) ? $shortcode_data['product_name'] : true );
		$product_price            = ( isset( $shortcode_data['product_price'] ) ? $shortcode_data['product_price'] : true );
		$product_del_price_color  = ( isset( $shortcode_data['product_del_price_color'] ) ? $shortcode_data['product_del_price_color'] : '#888888' );
		$product_rating           = ( isset( $shortcode_data['product_rating'] ) ? $shortcode_data['product_rating'] : true );
		$product_rating_colors    = ( isset( $shortcode_data['product_rating_colors'] ) ? $shortcode_data['product_rating_colors'] : array(
			'color'       => '#F4C100',
			'empty_color' => '#c8c8c8',
		) );
		$add_to_cart_button       = ( isset( $shortcode_data['add_to_cart_button'] ) ? $shortcode_data['add_to_cart_button'] : true );
		$add_to_cart_button_color = ( isset( $shortcode_data['add_to_cart_button_colors'] ) ? $shortcode_data['add_to_cart_button_colors'] : array(
			'color'            => '#444444',
			'hover_color'      => '#ffffff',
			'background'       => 'transparent',
			'hover_background' => '#222222',
		) );
		$add_to_cart_border       = ( isset( $shortcode_data['add_to_cart_border'] ) ? $shortcode_data['add_to_cart_border'] : array(
			'all'         => '1',
			'style'       => 'solid',
			'color'       => '#222222',
			'hover_color' => '#222222',
		) );
		// Image Settings.
		$product_image        = ( isset( $shortcode_data['product_image'] ) ? $shortcode_data['product_image'] : '' );
		$product_image_border = ( isset( $shortcode_data['product_image_border'] ) ? $shortcode_data['product_image_border'] : array(
			'all'         => '1',
			'style'       => 'solid',
			'color'       => '#dddddd',
			'hover_color' => '#dddddd',
		) );
		$image_sizes          = ( isset( $shortcode_data['image_sizes'] ) ? $shortcode_data['image_sizes'] : 'full' );

		// Typography.
		$slider_title_typography  = ( isset( $shortcode_data['slider_title_typography'] ) ? $shortcode_data['slider_title_typography'] : array(
			'font-family'    => 'Open Sans',
			'font-weight'    => '600',
			'font-style'     => '',
			'subset'         => '',
			'text-align'     => 'left',
			'text-transform' => 'none',
			'font-size'      => '22',
			'line-height'    => '23',
			'letter-spacing' => '',
			'color'          => '#444444',
			'type'           => 'google',
			'unit'           => 'px',
		) );
		$product_name_typography  = ( isset( $shortcode_data['product_name_typography'] ) ? $shortcode_data['product_name_typography'] : array(
			'font-family'    => 'Open Sans',
			'font-weight'    => '600',
			'font-style'     => '',
			'subset'         => '',
			'text-align'     => 'center',
			'text-transform' => 'none',
			'font-size'      => '15',
			'line-height'    => '20',
			'letter-spacing' => '',
			'color'          => '#444444',
			'hover_color'    => '#955b89',
			'type'           => 'google',
			'unit'           => 'px',
		) );
		$product_price_typography = ( isset( $shortcode_data['product_price_typography'] ) ? $shortcode_data['product_price_typography'] : array(
			'font-family'    => 'Open Sans',
			'font-weight'    => '700',
			'font-style'     => '',
			'subset'         => '',
			'text-align'     => 'center',
			'text-transform' => 'none',
			'font-size'      => '14',
			'line-height'    => '19',
			'letter-spacing' => '',
			'color'          => '#222222',
			'type'           => 'google',
			'unit'           => 'px',
		) );

		$arg = array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'orderby'        => $product_order_by,
			'order'          => 'DESC',
			'fields'         => 'ids',
			'posts_per_page' => $number_of_total_products,
		);
		if ( 'featured_products' === $product_type ) {
			$product_visibility_term_ids = wc_get_product_visibility_term_ids();
			$arg['tax_query'][]          = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => $product_visibility_term_ids['featured'],
			);
		}
		if ( $hide_out_of_stock_product ) {
			$product_visibility_term_ids = wc_get_product_visibility_term_ids();
			$arg['tax_query'][]          = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => $product_visibility_term_ids['outofstock'],
				'operator' => 'NOT IN',
			);
		}

		$viewed_products = get_posts(
			$arg
		);

		$args = array();
		if ( $viewed_products ) {
			$args = array(
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'orderby'        => $product_order_by,
				'order'          => $product_order,
				'post__in'       => $viewed_products,
				'posts_per_page' => $number_of_total_products,
			);
		}

		$shortcode_query = new WP_Query( $args );
		$setting_options = get_option( 'sp_woo_product_slider_options' );
		/**
		 * Enqueue style and scripts.
		 */
		if ( $setting_options['enqueue_font_awesome'] ) {
			wp_enqueue_style( 'sp-wps-font-awesome' );
		}
		if ( $setting_options['enqueue_slick_css'] ) {
			wp_enqueue_style( 'sp-wps-slick' );
		}
		wp_enqueue_style( 'sp-wps-style' );
		if ( $setting_options['enqueue_slick_js'] ) {
			wp_enqueue_script( 'sp-wps-slick-min-js' );
		}
		wp_enqueue_script( 'sp-wps-slick-config-js' );

		$output = '';
		/**
		 * Dynamic style.
		 */
		ob_start();
		require SP_WPS_PATH . 'public/views/dynamic-style.php';

		$slider_data  = 'data-slick=\'{"dots": ' . $pagination . ', "pauseOnHover": ' . $pause_on_hover . ', "infinite": ' . $carousel_infinite . ', "slidesToShow": ' . $number_of_column['number1'] . ', "speed": ' . $scroll_speed . ', "arrows": ' . $navigation . ', "autoplay": ' . $auto_play . ', "autoplaySpeed": ' . $auto_play_speed . ', "swipe": ' . $carousel_swipe . ', "draggable": ' . $carousel_draggable . ', "rtl": ' . $rtl_mode . ',  "responsive": [ {"breakpoint": 1100, "settings": { "slidesToShow": ' . $number_of_column['number2'] . ' } }, {"breakpoint": 990, "settings": { "slidesToShow": ' . $number_of_column['number3'] . ' } }, {"breakpoint": 650, "settings": { "slidesToShow": ' . $number_of_column['number4'] . ', "dots": ' . $pagination_mobile . ', "arrows": ' . $navigation_mobile . ' } } ] }\'';
		$slider_data .= ' data-preloader="' . $preloader . '"';

		$output .= '<div id="wps-slider-section" class="wps-slider-section wps-slider-section-' . esc_attr( $post_id ) . '">';
		if ( $slider_title ) {
			$output .= '<h2 class="sp-woo-product-slider-section-title">' . wp_kses_post( $main_section_title ) . '</h2>';
		}
		if ( $preloader ) {
			$preloader_style = ( $preloader ) ? '' : 'display: none;';
			$preloader_image = SP_WPS_URL . 'admin/assets/images/preloader.gif';
			if ( ! empty( $preloader_image ) ) {
				$output .= '<div class="wps-preloader" id="wps-preloader-' . $post_id . '" style="' . $preloader_style . '"><img src=" ' . $preloader_image . ' "/></div>';
			}
		}
			$output .= '<div id="sp-woo-product-slider-' . esc_attr( $post_id ) . '" class="wps-product-section sp-wps-' . esc_attr( $theme_style ) . '" ' . $slider_data . ' ' . $the_rtl . '>';

		if ( $shortcode_query->have_posts() ) {
			while ( $shortcode_query->have_posts() ) :
				$shortcode_query->the_post();
				global $product;

				$output .= '<div class="wpsf-product">';
				$output .= '<div class="sp-wps-product-image-area">';
				$output .= '<a href="' . esc_url( get_the_permalink() ) . '" class="wps-product-image">';
				if ( $product_image ) {
					if ( has_post_thumbnail( $shortcode_query->post->ID ) ) {
						$product_thumb          = $image_sizes;
						$wps_product_image_size = apply_filters( 'sp_wps_product_image_size', $product_thumb );
						$output                .= get_the_post_thumbnail( $shortcode_query->post->ID, $wps_product_image_size, array( 'class' => 'wpsf-product-img' ) );
					} else {
						$output .= '<img id="place_holder_thm" src="' . wc_placeholder_img_src() . '" alt="Placeholder" />';
					}
				}

				$output .= '</a>';
				$output .= '<div class="sp-wps-product-details">';
				$output .= '<div class="sp-wps-product-details-inner">';
				if ( $product_name ) {
					$output .= '<div class="wpsf-product-title"><a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></div>';
				}
				$price_html = $product->get_price_html();
				if ( $product_price && class_exists( 'WooCommerce' ) && $price_html ) {
					$output .= '<div class="wpsf-product-price">' . $price_html . '</div>';
				}
				if ( class_exists( 'WooCommerce' ) && $product_rating ) {
					$average = $product->get_average_rating();
					if ( $average > 0 ) {
						$output .= '<div class="star-rating" title="' . esc_html__( 'Rated', 'woo-product-slider' ) . ' ' . $average . '' . esc_html__( ' out of 5', 'woo-product-slider' ) . '"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . esc_html__( 'out of 5', 'woo-product-slider' ) . '</span></div>';
					}
				}
				if ( $add_to_cart_button ) {
					$output .= '<div class="wpsf-cart-button">' . do_shortcode( '[add_to_cart id="' . get_the_ID() . '" show_price="false"]' ) . '</div>';
				}

				$output .= '</div>';// sp-wps-product-details-inner.
				$output .= '</div>';// sp-wps-product-details.
				$output .= '</div>';// sp-wps-product-image-area.
				$output .= '</div>';// wpsf-product.

					endwhile;
		} else {
			$output .= '<h2 class="sp-not-found-any-product-f">' . esc_html__( 'No products found', 'woo-product-slider' ) . '</h2>';
		}

		$output .= '</div>';
		$output .= '</div>';

		wp_reset_postdata();

		echo $output;
	}

	/**
	 * Shortcode
	 *
	 * @param array $attributes shortcode attributes.
	 *
	 * @return string
	 */
	public function wps_shortcode( $attributes ) {

		shortcode_atts(
			array(
				'id' => '',
			),
			$attributes,
			'woo_product_slider'
		);

		$post_id            = $attributes['id'];
		$shortcode_data     = get_post_meta( $post_id, 'sp_wps_shortcode_options', true );
		$main_section_title = get_the_title( $post_id );

		self::spwps_html_show( $post_id, $shortcode_data, $main_section_title );
		return ob_get_clean();
	}

}

new SP_WPS_ShortCode();
