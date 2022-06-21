<?php
/**
 * The premium page.
 *
 * @since      2.2.0
 * @package    Woo_Product_Slider
 * @subpackage Woo_Product_Slider/admin/assets/view
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access.

/**
 * The premium page class.
 */
class Woo_Product_Slider_Premium {

	/**
	 * Single instance of the class
	 *
	 * @var null
	 * @since 2.2.0
	 */
	protected static $_instance = null;

	/**
	 * Main Instance
	 *
	 * @since 2.2.0
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
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'premium_admin_menu' ), 100 );
	}

	/**
	 * Add admin menu.
	 *
	 * @since 2.2.0
	 * @return void
	 */
	public function premium_admin_menu() {
		add_submenu_page(
			'edit.php?post_type=sp_wps_shortcodes',
			__( 'Premium', 'woo-product-slider' ),
			__( 'Premium', 'woo-product-slider' ),
			'manage_options',
			'wps_premium',
			array(
				$this,
				'premium_page_callback',
			)
		);
	}

	/**
	 * Happy users.
	 *
	 * @param boolean $username Happy user name.
	 * @param array   $args Happy user args.
	 * @return $data
	 */
	public function happy_users( $username = 'shapedplugin', $args = array() ) {
		if ( $username ) {
			$params = array(
				'timeout'   => 10,
				'sslverify' => false,
			);

			$raw = wp_remote_retrieve_body( wp_remote_get( 'http://wptally.com/api/' . $username, $params ) );
			$raw = json_decode( $raw, true );

			if ( array_key_exists( 'error', $raw ) ) {
				$data = array(
					'error' => $raw['error'],
				);
			} else {
				$data = $raw;
			}
		} else {
			$data = array(
				'error' => __( 'No data found!', 'woo-product-slider' ),
			);
		}

		return $data;
	}

	/**
	 * Premium Page Callback
	 */
	public function premium_page_callback() {
		wp_enqueue_style( 'sp-product-slider-admin-premium', SP_WPS_URL . 'admin/assets/css/premium-page.min.css', array(), SP_WPS_VERSION );
		wp_enqueue_style( 'sp-product-slider-admin-premium-modal', SP_WPS_URL . 'admin/assets/css/modal-video.min.css', array(), SP_WPS_VERSION );
		wp_enqueue_script( 'sp-product-slider-admin-premium', SP_WPS_URL . 'admin/assets/js/jquery-modal-video.min.js', array( 'jquery' ), SP_WPS_VERSION, true );
		?>
	<div class="sp-product-slider-premium-page">
		<!-- Banner section start -->
		<section class="sp-wps-banner">
			<div class="sp-wps-container">
				<div class="row">
					<div class="sp-wps-col-xl-6">
						<div class="sp-wps-banner-content">
							<h2 class="sp-wps-font-30 main-color sp-wps-font-weight-500"><?php esc_html_e( 'Upgrade To WooCommerce Product Slider Pro', 'woo-product-slider' ); ?></h2>
							<h4 class="sp-wps-mt-10 sp-wps-font-18 sp-wps-font-weight-500"><?php echo wp_kses_post( 'Boost Sales by Beautiful <strong>Interactive Product Sliders!</strong>', 'woo-product-slider' ); ?></h4>
							<p class="sp-wps-mt-25 text-color-2 line-height-20 sp-wps-font-weight-400"><?php esc_html_e( 'Show your amazing products to your prospective people in a nice slider or grid to grow your store conversions and sales.', 'woo-product-slider' ); ?></p>
							<p class="sp-wps-mt-20 text-color-2 sp-wps-line-height-20 sp-wps-font-weight-400"><?php esc_html_e( 'The perfect way to highlight specific products and, if put in strategic positions, it will help you to increase conversions and purchases in your shop.', 'woo-product-slider' ); ?></p>
						</div>
						<div class="sp-wps-banner-button sp-wps-mt-40">
							<a class="sp-wps-btn sp-wps-btn-sky" href="https://shapedplugin.com/plugin/woocommerce-product-slider-pro/?ref=1" target="_blank">Upgrade To Pro Now</a>
							<a class="sp-wps-btn sp-wps-btn-border ml-16 sp-wps-mt-15" href="https://demo.shapedplugin.com/woocommerce-product-slider/" target="_blank">Live Demo</a>
						</div>
					</div>
					<div class="sp-wps-col-xl-6">
						<div class="sp-wps-banner-img">
							<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/woo-product-sldier-vector.svg' ); ?>" alt="">
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Banner section End -->

		<!-- Count section Start -->
		<section class="sp-wps-count">
			<div class="sp-wps-container">
				<div class="sp-wps-count-area">
					<div class="count-item">
						<h3 class="sp-wps-font-24">
						<?php
						$plugin_data  = $this->happy_users();
						$plugin_names = array_values( $plugin_data['plugins'] );

						$active_installations = array_column( $plugin_names, 'installs', 'url' );
						echo esc_attr( $active_installations['http://wordpress.org/plugins/woo-product-slider'] ) . '+';
						?>
						</h3>
						<span class="sp-wps-font-weight-400">Active Installations</span>
					</div>
					<div class="count-item">
						<h3 class="sp-wps-font-24">
						<?php
						$active_installations = array_column( $plugin_names, 'downloads', 'url' );
						echo esc_attr( $active_installations['http://wordpress.org/plugins/woo-product-slider'] );
						?>
						</h3>
						<span class="sp-wps-font-weight-400">all time downloads</span>
					</div>
					<div class="count-item">
						<h3 class="sp-wps-font-24">
						<?php
						$active_installations = array_column( $plugin_names, 'rating', 'url' );
						echo esc_attr( $active_installations['http://wordpress.org/plugins/woo-product-slider'] ) . '/5';
						?>
						</h3>
						<span class="sp-wps-font-weight-400">user reviews</span>
					</div>
				</div>
			</div>
		</section>
		<!-- Count section End -->

		<!-- Video Section Start -->
		<section class="sp-wps-video">
			<div class="sp-wps-container">
				<div class="section-title text-center">
					<h2 class="sp-wps-font-28">Boost Your WooCommerce Store or Shop Sales Today!</h2>
					<h4 class="sp-wps-font-16 sp-wps-mt-10 sp-wps-font-weight-400">Learn why WooCommerce Product Slider Pro is the best Product Slider and Grid plugin.</h4>
				</div>
				<div class="video-area text-center">
					<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/boost-sales-concept.svg' ); ?>" alt="">
					<div class="video-button">
						<a class="js-video-button" href="#" data-channel="youtube" data-video-url="//www.youtube.com/embed/R9R84fpLuYg">
							<span><i class="fa fa-play"></i></span>
						</a>
					</div>
				</div>
			</div>
		</section>
		<!-- Video Section End -->

		<!-- Features Section Start -->
		<section class="sp-wps-feature">
			<div class="sp-wps-container">
				<div class="section-title text-center">
					<h2 class="sp-wps-font-28">Amazing Pro Key Features</h2>
					<h4 class="sp-wps-font-16 sp-wps-mt-10 sp-wps-font-weight-400">Upgrading to Pro will get you the following amazing benefits.</h4>
				</div>
				<div class="feature-wrapper">
					<div class="feature-area">
						<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/layouts.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">2 Unique Layouts (Slider and Grid)</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">WooCommerce Product Slider Pro comes with 2 unique layouts presets like Carousel Slider and Grid to display your products. The layout presets are fully customizable.</p>
							</div>
						</div>

						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="
								<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/slider-grid.svg' ); ?>
								" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">Unlimited Product Sliders and Grids</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">Why only display Create unlimited product sliders, grids as you like across your WooCommerce store or site in a few clicks with beautifully designed themes and multiple options.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
					<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="
								<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/color-styling.svg' ); ?>
								" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">30+ Professionally Pre-designed Themes</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">The premium plugin comes with 30+ ready themes that are fully customizable directly from the generator settings. Choose your desired theme and stylize to fit your requirements.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/Customize-Everything-Easily.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">Easily Customize Everything</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">You will be able to make it look exactly how you want with layout and colors & typography settings! You have full control over styling to design your way. No coding skills required!</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
					<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/filter.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">Filter and Display the List of Products</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">Filter the list of products you want to show in the slider or grid: featured, categories, tags, on sale, best selling, top-rated, most viewed, SKU, attribute, free, out of stock, etc.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/specific.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">Display Specific Products</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">A product slider is one of the best ways to highlight your specific products and, if you put this slider in strategic positions, it will boost your WooCommerce store sales.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
					<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/cross-sells.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">Upsells and Cross-sells</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">Display Upsells & Cross-sells product slider and boost sales instantly. Upsells products are recommended instead of the currently viewed product and Cross-sells are promoted in the cart.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/related.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">Related Products Slider</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">Quickly increase your customers’ engagement with your products by adding Related Products Slider at the bottom of your single product page. Boost your internal traffic by up to 10%!</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
					<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/filter-types.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">Filter by Product Types</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">You can filter by different product types with the Product Slider Pro for WooCommerce: Simple Product, Grouped Product, External/Affiliate Product, Variable product.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/typo.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">Advanced Typography (fonts, color & styling)</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">You have ability to set fonts, size, weight, text-transform, & colors to match your brand. The Pro version supports 950+ Google fonts and typography options. You can enable or disable fonts loading.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
						<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/badge.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">Manage Ribbon and Badge(Sale, Out of Stock)</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">
								You can show different ribbon and badge for products in the slider or grid layout. The badges e.g. On Sale! and Out of Stock are fully customizable. Boost conversions of up to 50%!</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/carousel-control.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">20+ Slider Controls</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">You can set how many products to scroll at a time in the slider, speed, autoplay, swipe, pause on hover, infinite loop, mouse draggable, ticker mode, and many other settings.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
						<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/row.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">Multiple Row Product Slider</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">You can slide the unlimited number of rows at a time in product slider. We normally set a single row by default. Set the number of product row(s) in the slider as you desire.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/ajax-p-control.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">4 Ajax Pagination Types</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">The Grid layout has 4 types of pagination control: Ajax number, Load more (ajax), Infinite scroll (ajax), Normal pagination(no ajax). Set how many products want to show per page and per click.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
						<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/lightbox.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">Lightbox for Product Image</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">Lightbox functionality for your product image can help you to zoom in or larger view images when it is clicked on. Customize product image border, box-shadow, flip, zoom, grayscale, etc.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/advanced-settings.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">Advanced Plugin Settings</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">The plugin is fully customizable and has a custom CSS field to override styles if necessary. You can enqueue or dequeue different JS/CSS to avoid conflicts and loading issue.</p>
							</div>
						</div>
					</div>
					<div class="feature-area">
						<div class="feature-item mr-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/Translation-RTL-Ready.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">Multisite, Multilingual, RTL, Accessibility Ready</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">The plugin is multisite, multilingual, RTL, and accessibility ready. For Arabic, Hebrew, Persian, etc. languages, you can select the right-to-left option for slider direction, without writing any CSS.</p>
							</div>
						</div>
						<div class="feature-item ml-30">
							<div class="feature-icon">
								<img src="<?php echo esc_url( SP_WPS_URL . 'admin/assets/css/images/premium/frequent.svg' ); ?>" alt="">
							</div>
							<div class="feature-content">
								<h3 class="sp-wps-font-18 sp-wps-font-weight-600">Top-notch Support and Frequently Updates</h3>
								<p class="sp-wps-font-15 sp-wps-mt-15 sp-wps-line-height-24">Our dedicated top-notch support team is always ready to offer you world-class support and help when needed. Our engineering team is continuously working to improve the plugin and release new versions!</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Features Section End -->

		<!-- Buy Section Start -->
		<section class="sp-wps-buy">
			<div class="sp-wps-container">
				<div class="row">
					<div class="sp-wps-col-xl-12">
						<div class="buy-content text-center">
							<h2 class="sp-wps-font-28">
							Join 
							<?php
							$install = 0;
							foreach ( $plugin_names as &$plugin_name ) {
								$install += $plugin_name['installs'];
							}
							echo esc_attr( $install + '15000' ) . '+';
							?>
							Happys Users in 160+ Countries
							</h2>
							<p class="sp-wps-font-16 sp-wps-mt-25 sp-wps-line-height-22">98% of customers are happy with <b>ShapedPlugin's</b> products and support. <br>
								So it’s a great time to join them.</p>
							<a class="sp-wps-btn sp-wps-btn-buy sp-wps-mt-40" href="https://shapedplugin.com/plugin/woocommerce-product-slider-pro/?ref=1" target="_blank">Get Started for $39 Today!</a>
							<span>14 Days Money-back Guarantee! No Question Asked.</span>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Buy Section End -->

		<!-- Testimonial section start -->
		<div class="testimonial-wrapper">
		<section class="sp-wps-premium testimonial">
		<div class="row">
				<div class="col-lg-6">
					<div class="testimonial-area">
						<div class="testimonial-content">
							<p>Awesome plugin! Does exactly what it meant to do and has a lot of customizations options. Support RTL languages like Hebrew. I’m very happy with my purchase and the support is great and professional.</p>
						</div>
						<div class="testimonial-info">
							<div class="img">
								<img src="<?php echo esc_attr( SP_WPS_URL . 'admin/assets/css/images/Asaf-Moraz-min.jpeg' ); ?>" alt="">
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
								<img src="<?php echo esc_attr( SP_WPS_URL . 'admin/assets/css/images/Faruk-Prnjavorac-min.jpeg' ); ?>" alt="">
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
		</div>
		<!-- Testimonial section end -->
	</div>
	<!-- End premium page -->
		<?php
	}

}
