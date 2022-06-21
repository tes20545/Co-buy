<?php
/**
 * The product images.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/public
 */

/**
 * WCGS Public Style class
 */
class WCGS_Public_Style extends WCGS_Public_Settings {

	/**
	 * Dynamic css
	 *
	 * @var string
	 */
	private static $dynamic_css;
	/**
	 * Additional css
	 *
	 * @var string
	 */
	private static $additional_css;

	/**
	 * The constructor of the class.
	 *
	 * @param array $settings settings option.
	 */
	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->wcgs_css();
		$this->wcgs_custom_css();
	}

	/**
	 * Wcgs css.
	 *
	 * @return void
	 */
	public function wcgs_css() {
		$settings = get_option( 'wcgs_settings' );

		$gallery_bottom_gap      = isset( $settings['gallery_bottom_gap'] ) ? $settings['gallery_bottom_gap'] : 30;
		$caption_color           = isset( $settings['caption_color'] ) ? $settings['caption_color'] : '#ffffff';
		$thumbnails_space        = isset( $settings['thumbnails_space'] ) ? $settings['thumbnails_space'] / 2 : 3;
		$thumbnails_top          = isset( $settings['thumbnails_space'] ) ? $settings['thumbnails_space'] : 6;
		$thumbnail_border        = isset( $settings['border_width_for_active_thumbnail'] ) ? $settings['border_width_for_active_thumbnail'] : '';
		$thumbnail_border_color  = isset( $thumbnail_border['color'] ) ? $thumbnail_border['color'] : '#dddddd';
		$thumbnail_border_color2 = isset( $thumbnail_border['color2'] ) ? $thumbnail_border['color2'] : '#5EABC1';
		$thumbnail_border_color3 = isset( $thumbnail_border['color3'] ) ? $thumbnail_border['color3'] : '#5EABC1';
		$thumbnail_border_size   = isset( $thumbnail_border['all'] ) ? $thumbnail_border['all'] : '0';

		$thumb_position      = '2';
		$thumb_slider_margin = "margin-top: {$thumbnails_top}px;";
		$vr_slide_padding    = 0;
		if ( $thumbnail_border_size > 0 ) {
			$vr_slide_padding = $thumbnail_border_size + 2;
		}

		$dynamic_css  = '';
		$dynamic_css .= '#wpgs-gallery.woocommerce-product-gallery .gallery-navigation-carousel {
			-ms-flex-order: 2 !important;
			order: 2 !important;
		}
		#wpgs-gallery .slick-arrow-next.slick-arrow, #wpgs-gallery .slick-arrow-prev.slick-arrow {
			font-size: ' . $this->navigation_icon_size . 'px;
			color: ' . $this->navigation_icon_color . ';
			background-color: ' . $this->navigation_icon_bg_color . ';
		}
		#wpgs-gallery .slick-arrow-next.slick-arrow:hover, #wpgs-gallery .slick-arrow-prev.slick-arrow:hover {
			color: ' . $this->navigation_icon_hover_color . ';
			background-color: ' . $this->navigation_icon_hover_bg_color . ';
		}
		#wpgs-gallery .slick-arrow-prev.slick-arrow::before {
			content: "' . $this->navigation_left_icon . '";
		}
		#wpgs-gallery .slick-arrow-next.slick-arrow::before {
			content: "' . $this->navigation_right_icon . '";
		}
		#wpgs-gallery .slick-dots li button {
			background-color: ' . $this->pagination_icon_color . ';
		}
		#wpgs-gallery .slick-dots li.slick-active button {
			background-color: ' . $this->pagination_icon_active_color . ';
		}
		#wpgs-gallery .wcgs-lightbox a {
			color: ' . $this->lightbox_icon_color . ';
			background-color: ' . $this->lightbox_icon_bg_color . ';
			font-size: ' . $this->lightbox_icon_size . 'px;
		}
		#wpgs-gallery .wcgs-lightbox a:hover {
			color: ' . $this->lightbox_icon_hover_color . ';
			background-color: ' . $this->lightbox_icon_hover_bg_color . ';
		}
		#wpgs-gallery .slick-nav-next.slick-arrow,
		#wpgs-gallery .slick-nav-prev.slick-arrow {
			font-size: ' . $this->thumbnailnavigation_icon_size . 'px;
			color: ' . $this->thumbnailnavigation_icon_color . ';
			background-color: ' . $this->thumbnailnavigation_icon_bg_color . ';
		}
		#wpgs-gallery .slick-nav-next.slick-arrow:hover,#wpgs-gallery .slick-nav-prev.slick-arrow:hover {
			color: ' . $this->thumbnailnavigation_icon_hover_color . ';
			background-color: ' . $this->thumbnailnavigation_icon_hover_bg_color . ';
		}
		#wpgs-gallery .slick-nav-prev.slick-arrow::before {
			content: "' . $this->thumbnailnavigation_left_icon . '";
		}
		#wpgs-gallery .slick-nav-next.slick-arrow::before {
			content: "' . $this->thumbnailnavigation_right_icon . '";
		}
		#wpgs-gallery .gallery-navigation-carousel {
			' . $thumb_slider_margin . '
		}
		#wpgs-gallery .gallery-navigation-carousel .slick-slide {
			margin: 0 ' . $thumbnails_space . 'px;
		}
		#wpgs-gallery .gallery-navigation-carousel .slick-list {
			margin-left: -' . $thumbnails_space . 'px;
		}
		#wpgs-gallery .gallery-navigation-carousel.vertical .slick-slide {
			margin: ' . $thumbnails_space . 'px 0;
		}
		#wpgs-gallery .gallery-navigation-carousel.vertical .slick-list {
			margin: 0 0 -' . $thumbnails_space . 'px;
		}
		#wpgs-gallery .slick-slide.wcgs-thumb.slick-current.wcgs-thumb img {
			border-color: ' . $thumbnail_border_color2 . ';
		}
		#wpgs-gallery .slick-slide.wcgs-thumb.slick-current.wcgs-thumb:hover img {
			border-color: ' . $thumbnail_border_color3 . ';
		}
		#wpgs-gallery .slick-slide.wcgs-thumb:hover img {
			border-color: ' . $thumbnail_border_color3 . ';
		}
		#wpgs-gallery .slick-slide.wcgs-thumb img {
			border: ' . $thumbnail_border_size . 'px solid ' . $thumbnail_border_color . ';
		}
		#wpgs-gallery {
			margin-bottom: ' . $gallery_bottom_gap . 'px;
		}
		#wpgs-gallery .gallery-navigation-carousel.vertical .wcgs-thumb {
			padding: 0 ' . $vr_slide_padding . 'px;
		}
		.fancybox-caption__body {
			color: ' . $caption_color . ';
		}
		.fancybox-bg {
			background: #1e1e1e !important;
		}';

		self::$dynamic_css = $dynamic_css;
	}

	/**
	 * Wcgs custom css
	 *
	 * @return void
	 */
	public function wcgs_custom_css() {
		self::$additional_css = trim( html_entity_decode( $this->wcgs_additional_css ) );
	}

	/**
	 * Wcgs stylesheet include
	 *
	 * @return void
	 */
	public static function wcgs_stylesheet_include() {
		if ( is_singular( 'product' ) ) {
			wp_enqueue_style( 'wcgs_custom-style', plugin_dir_url( dirname( __DIR__ ) ) . 'css/dynamic.css', '1.0.0', 'all' );
			wp_add_inline_style( 'wcgs_custom-style', self::$dynamic_css );
			wp_add_inline_style( 'wcgs_custom-style', self::$additional_css );
		}
	}
}
