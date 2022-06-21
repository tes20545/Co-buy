<?php

/**
 * Promotion class
 *
 * For displaying limited time promotion in admin panel
 *
 * @since 2.2.5
 *
 * @package Woo_Product_Slider
 */
class Woo_Product_Slider_Promotion {

	/**
	 * Option key for limited time promo
	 *
	 * @var string
	 */
	public $promo_option_key = '_woo_product_slider_limited_time_promo';

	/**
	 * Woo_Product_Slider_Promotion constructor
	 */
	public function __construct() {
		add_action( 'admin_notices', array( $this, 'show_promotions' ) );
		add_action( 'wp_ajax_sp_wps_dismiss_promotional_notice', array( $this, 'dismiss_limited_time_promo' ) );
	}

	/**
	 * Shows promotions
	 */
	public function show_promotions() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$notices = array(
			array(
				'key'        => 'black-friday-2020',
				'start_date' => '2020-11-24 14:00:00 EST',
				'end_date'   => '2020-11-30 23:59:00 EST',
				'title'      => 'Black Friday Deals - 30% OFF the <strong>Product Slider Pro for WooCommerce</strong> until November 30th!',
				'content'    => 'Use this discount code on checkout page: <strong>BF2020</strong>',
				'link'       => 'https://shapedplugin.com/plugin/woocommerce-product-slider-pro/?utm_source=wordpress-wps&utm_medium=get-it-now&utm_campaign=BlackFriday2020',
			),
		);

		if ( empty( $notices ) ) {
			return;
		}

		$current_time_est = $this->get_current_time_est();
		$notice           = array();

		$already_displayed_promo = get_option( $this->promo_option_key, array() );

		foreach ( $notices as $ntc ) {
			if ( in_array( $ntc['key'], $already_displayed_promo, true ) ) {
				continue;
			}

			if ( strtotime( $ntc['start_date'] ) < strtotime( $current_time_est ) && strtotime( $current_time_est ) < strtotime( $ntc['end_date'] ) ) {
				$notice = $ntc;
			}
		}

		if ( empty( $notice ) ) {
			return;
		}

		?>
		<div class="notice sp-wps-promotional-notice">
			<div class="content">
				<h2><?php echo esc_html( $notice['title'] ); ?></h2>
				<p><?php echo esc_html( $notice['content'] ); ?></p>
				<a href="<?php echo esc_url( $notice['link'] ); ?>" class="button button-primary" target="_blank"><?php echo esc_html__( 'Get it now!', 'woo-product-slider' ); ?></a>
			</div>
			<span class="promotional-close-icon notice-dismiss" data-key="<?php echo esc_attr( $notice['key'] ); ?>"></span>
			<div class="clear"></div>
		</div>

		<style>
			.sp-wps-promotional-notice { 
				padding: 14px 18px;
				box-sizing: border-box;
				position: relative;
			}
			.sp-wps-promotional-notice .content {
				float: left;
				width: 75%;
			}
			.sp-wps-promotional-notice .content h2 {
				margin: 3px 0px 5px;
				font-size: 20px;
				font-weight: 400;
				color: #444;
				line-height: 25px;
			}
			.sp-wps-promotional-notice .content p {
				font-size: 14px;
				text-align: justify;
				padding: 0;
			}
			.sp-wps-promotional-notice .content a {
				border: none;
				box-shadow: none;
				height: 31px;
				line-height: 30px;
				border-radius: 3px;
				background: #a46497;
				text-shadow: none;
				width: 95px;
				text-align: center;
			}
		</style>

		<script type='text/javascript'>
			jQuery( document ).ready( function ( $ ) {
				$( 'body' ).on( 'click', '.sp-wps-promotional-notice span.promotional-close-icon', function ( e ) {
					e.preventDefault();

					var self = $( this ),
						key = self.data( 'key' );

					wp.ajax.send( 'sp_wps_dismiss_promotional_notice', {
						data: {
							sp_wps_promotion_dismissed: true,
							key: key,
							nonce: '<?php echo esc_attr( wp_create_nonce( 'woo_product_slider_admin' ) ); ?>'
						},
						complete: function ( resp ) {
							self.closest( '.sp-wps-promotional-notice' ).fadeOut( 200 );
						}
					} );
				} );
			} );
		</script>

		<?php
	}

	/**
	 * Dismisses limited time promo notice
	 */
	public function dismiss_limited_time_promo() {
		$post_data = wp_unslash( $_POST );

		if ( ! current_user_can( 'manage_woocommerce' ) ) {
			wp_send_json_error( __( 'You have no permission to do that', 'woo-product-slider' ) );
		}

		if ( ! wp_verify_nonce( $post_data['nonce'], 'woo_product_slider_admin' ) ) {
			wp_send_json_error( __( 'Invalid nonce', 'woo-product-slider' ) );
		}

		if ( isset( $post_data['sp_wps_promotion_dismissed'] ) && $post_data['sp_wps_promotion_dismissed'] ) {
			$already_displayed_promo   = get_option( $this->promo_option_key, array() );
			$already_displayed_promo[] = $post_data['key'];

			update_option( $this->promo_option_key, $already_displayed_promo );
			wp_send_json_success();
		}
	}


	/**
	 * Gets current time and converts to EST timezone.
	 *
	 * @return string
	 */
	private function get_current_time_est() {
		$dt = new \DateTime( 'now', new \DateTimeZone( 'UTC' ) );
		$dt->setTimezone( new \DateTimeZone( 'EST' ) );

		return $dt->format( 'Y-m-d H:i:s T' );
	}

}
new Woo_Product_Slider_Promotion();
