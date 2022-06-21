<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.
if ( ! class_exists( 'WCGS_Field_sp_help_free' ) ) {
	/**
	 *
	 * Field: help
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class WCGS_Field_sp_help_free extends WCGS_Fields {

		/**
		 * Help field constructor.
		 *
		 * @param array  $field The field type.
		 * @param string $value The values of the field.
		 * @param string $unique The unique ID for the field.
		 * @param string $where To where show the output CSS.
		 * @param string $parent The parent args.
		 */
		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {

			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		/**
		 * Render
		 *
		 * @return void
		 */
		public function render() {
			echo wp_kses_post( $this->field_before() );
			?>
		<div class="wrap about-wrap sp-wcgs-help">
			<h1><?php esc_html_e( 'Welcome to WooCommerce Gallery Slider!', 'gallery-slider-for-woocommerce' ); ?></h1>
			<p class="about-text">
			<?php
			esc_html_e( 'Get introduced to WooCommerce Gallery Slider plugin by watching our "Getting Started" video tutorial series. This video will help you get started with the plugin.', 'gallery-slider-for-woocommerce' );
			?>
				</p>
			<div class="wp-badge"></div>

			<div class="headline-feature-video">
			<div class="headline-feature feature-video">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/GUUcDfFSoP8?list=PLoUb-7uG-5jP0hHs2c_bD2k8r3ALZMYto" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
				</div>

			<div class="feature-section three-col">
				<div class="col">
					<div class="sp-wcgs-feature ">
						<h3><i class="sp-font fas fa-headset"></i> Need Help?</h3>
						<p>Stuck with any issues? No worries! Our Expert Support Team is always ready to help you out promptly.</p>
						<a href="https://shapedplugin.com/support/" target="_blank" class="wcgs-help-button">Get Support</a>
					</div>
				</div>
				<div class="col">
					<div class="sp-wcgs-feature">
						<h3><i class="sp-font fa fa-file-text" ></i>Documentation</h3>
						<p>Check out our documentation page and more information about what you can do with WooCommerce Gallery Slider.</p>
						<a href="https://docs.shapedplugin.com/docs/gallery-slider-for-woocommerce/overview/" target="_blank" class="wcgs-help-button">Documentation</a>
					</div>
				</div>
				<div class="col">
					<div class="sp-wcgs-feature">
						<h3><i class="sp-font fa fa-heart-o" ></i>Show Your Love</h3>
						<p>We are really thankful to choose our plugin. Take your 1 minute to review the plugin and spread the love to inspire us.</p>
						<a href="https://wordpress.org/support/plugin/gallery-slider-for-woocommerce/reviews/?filter=5" target="_blank" class="wcgs-help-button">Review Now</a>
					</div>
				</div>
			</div>

			<div class="about-wrap sp-wcgs-plugin-section">
				<div class="sp-plugin-section-title text-center">
					<h2>Take your shop beyond the typical with more WooCommerce plugins!</h2>
					<h4>Some more premium plugins are ready to make your online store awesome.</h4>
				</div>
				<div class="feature-section three-col">
					<div class="col">
						<div class="sp-wcgs-plugin">
						<a href="https://shapedplugin.com/plugin/woocommerce-product-slider-pro/?ref=143" target="_blank"><img src="https://shapedplugin.com/wp-content/uploads/edd/2018/11/WooCommerce-Product-Slider-360x210.png" alt="WooCommerce Product Slider Pro"></a>
							<h3><a href="https://shapedplugin.com/plugin/woocommerce-product-slider-pro/" target="_blank">Product Slider Pro for WooCommerce</a></h3>
						</div>
					</div>

					<div class="col">
						<div class="sp-wcgs-plugin">
						<a href="https://shapedplugin.com/plugin/woocommerce-category-slider-pro/?ref=143" target="_blank"><img src="https://shapedplugin.com/wp-content/uploads/edd/2021/03/woocommerce-category-slider-360x210.png" alt="WooCommerce category Slider Pro"></a>
							<h3><a href="https://shapedplugin.com/plugin/woocommerce-category-slider-pro/" target="_blank">Category Slider Pro for WooCommerce </a></h3>
						</div>
					</div>

					<div class="col">
						<div class="sp-wcgs-plugin">
						<a href="https://shapedplugin.com/plugin/woocommerce-quick-view-pro/?ref=143" target="_blank"><img src="https://shapedplugin.com/wp-content/uploads/edd/2021/10/Woo-QuickView-360x210.png" alt="WooCommerce Gallery Slider Pro"></a>
						<h3><a href="https://shapedplugin.com/plugin/woocommerce-quick-view-pro/" target="_blank">Quick View Pro for WooCommerce</a></h3>
						</div>
					</div>
				</div>
			</div>

			</div>
			<?php
			echo wp_kses_post( $this->field_after() );
		}

	}
}
