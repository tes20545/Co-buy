<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

/**
 * Shortcode converter function
 *
 * @param int $id Slider product id.
 */
function woo_product_slider_id( $id ) {
	echo do_shortcode( '[woo_product_slider id="' . $id . '"]' );
}

/**
 * Functions
 */
class SP_Woo_Product_Slider_Functions {

	/**
	 * SP_Woo_Product_Slider_Functions single instance of the class
	 *
	 * @var null
	 * @since 2.0
	 */
	protected static $_instance = null;

	/**
	 * Main SP_Woo_Product_Slider_Functions Instance
	 *
	 * @since 2.0
	 * @static
	 * @see SP_Woo_Product_Slider_Functions()
	 * @return self Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 100 );
		add_filter( 'admin_footer_text', array( $this, 'admin_footer' ), 1, 2 );
	}

	/**
	 * Admin Menu
	 */
	public function admin_menu() {
		add_submenu_page( 'edit.php?post_type=sp_wps_shortcodes', __( 'Product Slider for WooCommerce Help', 'woo-product-slider' ), __( 'Help', 'woo-product-slider' ), 'manage_options', 'wps_help', array( $this, 'help_page_callback' ) );
	}


	/**
	 * Help Page Callback
	 */
	public function help_page_callback() {
		wp_enqueue_style( 'sp-wps-admin-help', SP_WPS_URL . 'admin/assets/css/help-page.min.css', array(), SP_WPS_VERSION );
		$add_shortcode_link = admin_url( 'post-new.php?post_type=sp_wps_shortcodes' );
		?>

		<div class="sp-woo-product-slider-help-page">
				<!-- Header section start -->
				<section class="sp-wps-help header">
					<div class="header-area">
						<div class="container">
							<div class="header-logo">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/woo-product-slider-logo.svg' ); ?>" alt="">
								<span><?php echo esc_html( SP_WPS_VERSION ); ?></span>
							</div>
							<div class="header-content">
								<p>Thank you for installing Product Slider for WooCommerce plugin! This video will help you get started with the plugin.</p>
							</div>
						</div>
					</div>
					<div class="video-area">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/videoseries?list=PLoUb-7uG-5jM6fpnrjHGUXkA9W6M2rzCG" frameborder="0" allowfullscreen=""></iframe>
					</div>
					<div class="content-area">
						<div class="container">
							<div class="content-button">
								<a href="<?php echo esc_url( $add_shortcode_link ); ?>">Start Creating Slider</a>
								<a href="https://docs.shapedplugin.com/docs/woocommerce-product-slider/overview/" target="_blank">Read Documentation</a>
							</div>
						</div>
					</div>
				</section>
				<!-- Header section end -->

				<!-- Upgrade section start -->
				<section class="sp-wps-help upgrade">
					<div class="upgrade-area">
					<div class="upgrade-img"> 
					<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/wps-icon-color.svg' ); ?>" alt="">
					</div>
						<h2>Upgrade To WooCommerce Product Slider Pro</h2>
						<p>Boost Sales by Interactive Product Sliders in your WooCommerce Store! Get the most out of WooCommerce Product Slider by upgrading to unlock all of its powerful features like:</p>
					</div>
					<div class="upgrade-info">
						<div class="container">
							<div class="row">
								<div class="col-lg-6">
									<ul class="upgrade-list">
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Advanced Shortcode Generator.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										2 Unique Layouts (Slider and Grid).</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">Multiple Product Sliders and Grids on the same page.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">30+ Professionally Pre-designed Themes/Templates.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">Theme/Template Modification from the theme directory.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt=""> Advanced Typography(fonts, colors, styling).</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt=""> Filter the list of products you want to show in the slider or grid: (Categories, Tags, Specific, On Sale!, Best Selling or Popular, Upsells, Cross-sells, Related Products, Top Rated, Most Viewed, Recently Viewed, Free Products, By Product ID or SKU, Products from Attribute, Exclude Categories & Tags, etc.).</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Sorting(drag and drop) option for specific products.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">Filter by different product types:(Simple Product, Grouped, External/Affiliate, Variable product).</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Special product Category Slider or Grid.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">Display sub or child category slider.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">Show Hidden Products.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Hide Out of Stock Products.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Hide Free Products.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Hide On Sale Products.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Duplicate option for Product Slider or Grid.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Product image border, box-shadow, hover effects (zoom, grayscale)</li>
									</ul>
								</div>
								<div class="col-lg-6">
									<ul class="upgrade-list">								
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Show/hide product name, image, description, price, rating, add to cart, etc.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Custom placeholder image that product has no image.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Product name and description word limit.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Multiple rows product sliders.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Multisite, Multilingual, RTL, Accessibility ready.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Ajax pagination types:(Ajax Number,  Load more, Infinite on the scroll, and Normal pagination).</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">Number of the product(s) to show per page. 20+ Slider Control options.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Manage Ribbon and Badge(Sale, Out of Stock, etc.).</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Show the product excerpt & read more button.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Change the Read More button label, color.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Ticker Mode Carousel Slider.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Set number of products slide to scroll at a time.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Lightbox functionality for product images.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Product Image Flip option.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Page builders and countless theme compatibility.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										Product QuickView, Wishlist, and Compare options.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">
										WooCommerce Quick View, Wishlist, Compare plugin supported.</li>
										<li><img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/checkmark.svg' ); ?>" alt="">Fast and Friendly Dedicated Support.</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="upgrade-pro">
							<div class="pro-content">
								<div class="pro-icon">
									<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/256.svg' ); ?>" alt="">
								</div>
								<div class="pro-text">
									<h2>Boost  WooCommerce Store Sales Today!</h2>
									<p>Start creating beautiful product sliders in Seconds.</p>
								</div>
							</div>
							<div class="pro-btn">
								<a href="https://shapedplugin.com/plugin/woocommerce-product-slider-pro/?ref=1" target="_blank">Upgrade To Pro Now</a>
							</div>
						</div>
					</div>
				</section>
				<!-- Upgrade section end -->

				<!-- Testimonial section start -->
				<section class="sp-wps-help testimonial">
					<div class="row">
						<div class="col-lg-6">
							<div class="testimonial-area">
								<div class="testimonial-content">
									<p>Awesome plugin! Does exactly what it meant to do and has a lot of customizations options. Support RTL languages like Hebrew. I’m very happy with my purchase and the support is great and professional. </p>
								</div>
								<div class="testimonial-info">
									<div class="img">
										<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/Asaf-Moraz-min.jpeg' ); ?>" alt="">
									</div>
									<div class="info">
										<h3>Asaf Moraz</h3>
										<div class="star">
										<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="testimonial-area">
								<div class="testimonial-content">
									<p>With all the plugins around, some stand out, and this is one of them. Both design elements and customer support are top notch, making this one of the best plugins for WooCommerce and product sliders out there.</p>
								</div>
								<div class="testimonial-info">
									<div class="img">
										<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/Faruk-Prnjavorac-min.jpeg' ); ?>" alt="">
									</div>
									<div class="info">
										<h3>Faruk Prnjavorac</h3>
										<div class="star">
										<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- Testimonial section end -->

		</div>
		<?php
	}

	/**
	 * Review Text
	 *
	 * @param string $text Footer text.
	 *
	 * @return string
	 */
	public function admin_footer( $text ) {
		$screen = get_current_screen();
		if ( 'sp_wps_shortcodes' === $screen->post_type || 'sp_wps_shortcodes_page_wps_settings' === $screen->id ) {

			$url  = 'https://wordpress.org/support/plugin/woo-product-slider/reviews/?filter=5#new-post';
			$text = sprintf( wp_kses_post( 'If you like <strong>Product Slider for WooCommerce</strong> please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. ', 'woo-product-slider' ), $url );
		}

		return $text;
	}

}

new SP_Woo_Product_Slider_Functions();
