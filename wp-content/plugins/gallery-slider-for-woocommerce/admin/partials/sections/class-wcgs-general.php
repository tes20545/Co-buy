<?php
/**
 * The general tab functionality of this plugin.
 *
 * Defines the sections of general tab.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/admin
 * @author     Shapedplugin <support@shapedplugin.com>
 */

/**
 * WCGS General class
 */
class WCGS_General {
	/**
	 * Specify the Generation tab for the Woo Gallery Slider.
	 *
	 * @since    1.0.0
	 * @param string $prefix Define prefix wcgs_settings.
	 */
	public static function section( $prefix ) {
		WCGS::createSection(
			$prefix,
			array(
				'name'   => 'general',
				'title'  => '<svg height="15px" viewBox="-12 0 512 512" width="15px" xmlns="http://www.w3.org/2000/svg"><path d="m450.144531 279.988281v-47.976562l34.414063-48.15625c4.5625-6.378907 4.972656-14.835938 1.046875-21.628907l-39.519531-68.453124c-3.921876-6.792969-11.449219-10.667969-19.257813-9.90625l-58.910156 5.726562-41.550781-23.988281-24.492188-53.882813c-3.25-7.140625-10.367188-11.722656-18.210938-11.722656h-79.042968c-7.84375 0-14.960938 4.582031-18.207032 11.722656l-24.496093 53.882813-41.550781 23.988281-58.910157-5.726562c-7.800781-.757813-15.332031 3.113281-19.253906 9.90625l-39.523437 68.453124c-3.921876 6.792969-3.511719 15.25 1.050781 21.628907l34.414062 48.15625v47.976562l-34.417969 48.15625c-4.558593 6.378907-4.96875 14.835938-1.046874 21.628907l39.523437 68.453124c3.917969 6.792969 11.453125 10.667969 19.253906 9.90625l58.910157-5.726562 41.550781 23.988281 24.496093 53.882813c3.246094 7.136718 10.363282 11.722656 18.207032 11.722656h79.042968c7.84375 0 14.960938-4.582031 18.207032-11.722656l24.496094-53.882813 41.550781-23.988281 58.910156 5.726562c7.820313.765626 15.335937-3.113281 19.253906-9.90625l39.523438-68.453124c3.921875-6.792969 3.511719-15.25-1.050781-21.628907zm-406.386719 60.9375 17.359376-24.289062 75.007812-43.308594c6.183594-3.566406 9.996094-10.164063 10-17.300781.0625-69.6875 71.054688-117.503906 135.902344-90.414063l-67.550782 39.003907c-9.558593 5.519531-12.84375 17.753906-7.320312 27.320312l39.332031 68.125c5.523438 9.566406 17.753907 12.84375 27.320313 7.320312l67.554687-39c-8.960937 69.679688-85.835937 107.296876-146.25 72.488282-6.1875-3.5625-13.804687-3.558594-19.988281.011718l-75.007812 43.304688-29.710938 2.886719zm370.113282-42.894531 30.65625 42.894531-26.644532 46.148438-52.476562-5.101563c-4.148438-.402344-8.324219.5-11.9375 2.585938l-52.65625 30.402344c-3.609375 2.085937-6.480469 5.246093-8.207031 9.042968l-21.816407 47.996094h-53.292968l-21.816406-47.996094c-1.726563-3.796875-4.597657-6.957031-8.207032-9.042968l-30.328125-17.511719 28.503907-16.457031c102.195312 47.667968 214.574218-40.59375 194.191406-150.222657-2.515625-13.542969-17.703125-20.566406-29.664063-13.664062l-79.046875 45.636719-19.332031-33.484376 79.046875-45.636718c11.929688-6.886719 13.492188-23.546875 2.996094-32.523438-84.78125-72.492187-217.375-19.238281-227.191406 93.066406l-28.503907 16.453126v-35.019532c0-4.167968-1.304687-8.234375-3.730469-11.628906l-30.65625-42.894531 26.648438-46.148438 52.472656 5.101563c4.152344.402344 8.324219-.5 11.933594-2.585938l52.660156-30.402344c3.609375-2.085937 6.480469-5.246093 8.207032-9.042968l21.820312-47.996094h53.289062l21.820313 47.996094c1.726563 3.796875 4.59375 6.957031 8.207031 9.042968l52.65625 30.402344c3.609375 2.082032 7.777344 2.988282 11.933594 2.585938l52.476562-5.101563 26.648438 46.148438-30.65625 42.894531c-2.425781 3.394531-3.730469 7.457031-3.730469 11.628906v60.804688c0 4.167968 1.300781 8.234375 3.726563 11.628906zm0 0"/></svg>' . esc_html__( 'General', 'gallery-slider-for-woocommerce' ),
				'fields' => array(
					array(
						'id'       => 'gallery_layout',
						'type'     => 'image_select',
						'class'    => 'gallery_layout',
						'title'    => esc_html__( 'Gallery Layout', 'gallery-slider-for-woocommerce' ),
						'subtitle' => esc_html__( 'Choose a layout for gallery.', 'gallery-slider-for-woocommerce' ),
						'desc'     => wp_kses_post( 'To unlock more amazing layout based settings, <a href="' . WOO_GALLERY_SLIDER_PRO_LINK . '" target="_blank"><strong>Upgrade To Pro!</strong></a>', 'gallery-slider-for-woocommerce' ),
						'options'  => array(
							'horizontal' => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/Horizontal.png',
								'option_name' => esc_html__( 'Horizontal', 'gallery-slider-for-woocommerce' ),
							),
							'vertical'   => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/Vertical.png',
								'option_name' => esc_html__( 'Vertical', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
							'hide_thumb' => array(
								'image'       => plugin_dir_url( __DIR__ ) . '../img/hide_thumb.png',
								'option_name' => esc_html__( 'Hide Thumbnails', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
						),
						'default'  => 'horizontal',
					),

					array(
						'id'         => 'thumbnails_position_horizontal',
						'type'       => 'button_set',
						'title'      => esc_html__( 'Thumbnails Position', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Select a position for thumbnails.', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'bottom' => array(
								'option_name' => esc_html__( 'Bottom', 'gallery-slider-for-woocommerce' ),
							),
							'top'    => array(
								'option_name' => esc_html__( 'Top', 'gallery-slider-for-woocommerce' ),
								'pro_only'    => true,
							),
						),
						'default'    => 'bottom',
						'dependency' => array( 'gallery_layout', '==', 'horizontal' ),
					),

					array(
						'id'         => 'thumbnails_item_to_show',
						'min'        => 2,
						'max'        => 10,
						'step'       => 1,
						'default'    => 4,
						'type'       => 'slider',
						'title'      => esc_html__( 'Thumbnails Item To Show', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Set a number of thumbnails item to show.', 'gallery-slider-for-woocommerce' ),
						'dependency' => array( 'gallery_layout', '!=', 'hide_thumb' ),
					),

					array(
						'id'         => 'thumbnails_space',
						'type'       => 'spinner',
						'title'      => esc_html__( 'Thumbnails Space', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Set a space between thumbnails.', 'gallery-slider-for-woocommerce' ),
						'default'    => 6,
						'dependency' => array( 'gallery_layout', '!=', 'hide_thumb' ),
					),
					array(
						'id'         => 'border_width_for_active_thumbnail',
						'class'      => 'border_active_thumbnail',
						'type'       => 'border',
						'title'      => esc_html__( 'Border', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Set border for thumbnail.', 'gallery-slider-for-woocommerce' ),
						'color'      => true,
						'style'      => false,
						'all'        => true,
						'default'    => array(
							'color'  => '#dddddd',
							'color2' => '#5EABC1',
							'color3' => '#5EABC1',
							'all'    => 1,
						),
						'dependency' => array( 'gallery_layout', '!=', 'hide_thumb' ),
					),
					array(
						'id'         => 'thumbnails_sizes',
						'type'       => 'image_sizes',
						'title'      => esc_html__( 'Thumbnails Size', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Select size for thumbnails.', 'gallery-slider-for-woocommerce' ),
						'default'    => 'shop_thumbnail',
						'dependency' => array( 'gallery_layout', '!=', 'hide_thumb' ),
					),
					array(
						'id'       => 'gallery_width',
						'type'     => 'slider',
						'title'    => esc_html__( 'Gallery Width', 'gallery-slider-for-woocommerce' ),
						'subtitle' => esc_html__( 'Set gallery width for large devices in %. Default value is 50%.', 'gallery-slider-for-woocommerce' ),
						'default'  => 50,
						'unit'     => '%',
						'min'      => 20,
						'step'     => 1,
					),
					array(
						'id'       => 'gallery_responsive_width',
						'class'    => 'gallery_responsive_width',
						'type'     => 'dimensions_res',
						'title'    => esc_html__( 'Responsive Gallery Width', 'gallery-slider-for-woocommerce' ),
						'subtitle' => esc_html__( 'Set gallery responsive width in px. Default unit is px.', 'gallery-slider-for-woocommerce' ),
						'default'  => array(
							'width'   => '0',
							'height'  => '720',
							'height2' => '480',
							'unit'    => 'px',
						),
						'help'     => '<i class="fa fa-desktop"></i> Medium devices - size is smaller than 992px,<br> <i class="fa fa-tablet"></i> Tablet - Size is smaller than 768px,<br> <i class="fa fa-mobile"></i> Mobile - size is smaller than 480px.',
					),
					array(
						'id'       => 'gallery_bottom_gap',
						'type'     => 'spinner',
						'title'    => esc_html__( 'Gallery Bottom Gap', 'gallery-slider-for-woocommerce' ),
						'subtitle' => esc_html__( 'Set gallery slider width in px. Default value is 30px.', 'gallery-slider-for-woocommerce' ),
						'default'  => 30,
						'unit'     => 'px',
					),

					array(
						'id'       => 'gallery_image_source',
						'type'     => 'radio',
						'title'    => esc_html__( 'Gallery Image Source', 'gallery-slider-for-woocommerce' ),
						'subtitle' => esc_html__( 'Set gallery image source.', 'gallery-slider-for-woocommerce' ),
						'options'  => array(
							'attached' => esc_html__( 'All images attached to this product', 'gallery-slider-for-woocommerce' ),
							'uploaded' => esc_html__( 'Only images uploaded to the product gallery', 'gallery-slider-for-woocommerce' ),
						),
						'default'  => 'uploaded',
					),
					array(
						'id'       => 'include_feature_image_to_gallery',
						'type'     => 'checkbox',
						'title'    => esc_html__( 'Include Feature Image', 'gallery-slider-for-woocommerce' ),
						'subtitle' => esc_html__( 'Check to include feature image in gallery.', 'gallery-slider-for-woocommerce' ),
						'default'  => 'default_gl',
						'options'  => array(
							'default_gl'  => esc_html__( 'To Default Gallery', 'gallery-slider-for-woocommerce' ),
							'variable_gl' => esc_html__( 'To Variation Gallery', 'gallery-slider-for-woocommerce' ),
						),
					),

				),
			)
		);
	}
}
