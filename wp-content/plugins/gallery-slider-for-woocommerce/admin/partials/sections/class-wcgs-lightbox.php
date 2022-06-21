<?php
/**
 * The gallery tab functionality of this plugin.
 *
 * Defines the sections of gallery tab.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/admin
 * @author     Shapedplugin <support@shapedplugin.com>
 */

/**
 * WCGS Lightbox class
 */
class WCGS_Lightbox {
	/**
	 * Specify the Gallery tab for the Woo Gallery Slider.
	 *
	 * @since    1.0.0
	 * @param string $prefix Define prefix wcgs_settings.
	 */
	public static function section( $prefix ) {
		WCGS::createSection(
			$prefix,
			array(
				'name'   => 'lightbox',
				'title'  => '<svg height="14px" width="14px" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path fill="#555" d="M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"></path></svg>' . esc_html__( 'Lightbox', 'gallery-slider-for-woocommerce' ),
				'fields' => array(
					array(
						'id'         => 'lightbox',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Enable Lightbox', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Enable/Disable lightbox.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
						'text_width' => 96,
						'default'    => true,
					),
					array(
						'id'         => 'lightbox_sliding_effect',
						'type'       => 'select',
						'title'      => esc_html__( 'Lightbox Sliding Effect', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Select lightbox sliding effect.', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'slide'    => esc_html__( 'Slide', 'gallery-slider-for-woocommerce' ),
							'fade'     => esc_html__( 'Fade (Pro)', 'gallery-slider-for-woocommerce' ),
							'rotate'   => esc_html__( 'Rotate (Pro)', 'gallery-slider-for-woocommerce' ),
							'circular' => esc_html__( 'Circular (Pro)', 'gallery-slider-for-woocommerce' ),
							'tube'     => esc_html__( 'Tube (Pro)', 'gallery-slider-for-woocommerce' ),
						),
						'default'    => 'slide',
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'         => 'lightbox_icon_position',
						'type'       => 'select',
						'title'      => esc_html__( 'Lightbox Icon Display Position', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Select lightbox icon position on the slider.', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'top_right'    => esc_html__( 'Top Right', 'gallery-slider-for-woocommerce' ),
							'top_left'     => esc_html__( 'Top Left (Pro)', 'gallery-slider-for-woocommerce' ),
							'bottom_right' => esc_html__( 'Bottom Right (Pro)', 'gallery-slider-for-woocommerce' ),
							'bottom_left'  => esc_html__( 'Bottom Left (Pro)', 'gallery-slider-for-woocommerce' ),
							'middle'       => esc_html__( 'Middle (Pro)', 'gallery-slider-for-woocommerce' ),
						),
						'default'    => 'top_right',
						'dependency' => array( 'lightbox', '==', true ),
					),

					array(
						'id'         => 'lightbox_icon',
						'type'       => 'button_set',
						'class'      => 'btn_icon',
						'title'      => esc_html__( 'Lightbox Icon Style', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Choose a lightbox icon style.', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'search'      => array(
								'option_name' => '<i class="fa fa-search"></i>',
							),
							'search-plus' => array(
								'option_name' => '<i class="fa fa-search-plus"></i>',
								'pro_only'    => true,
							),
							'eye'         => array(
								'option_name' => '<i class="fa fa-eye"></i>',
								'pro_only'    => true,
							),
							'plus'        => array(
								'option_name' => '<i class="fa fa-plus"></i>',
								'pro_only'    => true,
							),
							'info'        => array(
								'option_name' => '<i class="fa fa-info"></i>',
								'pro_only'    => true,
							),
							'angle-right' => array(
								'option_name' => '<i class="fa fa-angle-right"></i>',
								'pro_only'    => true,
							),
							'expand'      => array(
								'option_name' => '<i class="fa fa-expand"></i>',
								'pro_only'    => true,
							),
							'arrows-alt'  => array(
								'option_name' => '<i class="fa fa-arrows-alt"></i>',
								'pro_only'    => true,
							),
						),
						'default'    => 'search',
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'          => 'lightbox_icon_size',
						'class'       => 'pro_only_field',
						'type'        => 'spinner',
						'title'       => esc_html__( 'Lightbox Icon Size', 'gallery-slider-for-woocommerce' ),
						'subtitle'    => esc_html__( 'Set lightbox icon size.', 'gallery-slider-for-woocommerce' ),
						'dependency'  => array( 'lightbox', '==', true ),
						'placeholder' => 13,
						'default'     => 13,
					),
					array(
						'id'         => 'lightbox_icon_color_group',
						'type'       => 'color_group',
						'title'      => esc_html__( 'Lightbox Icon Color', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Set lightbox icon colors.', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'color'          => esc_html__( 'Color', 'gallery-slider-for-woocommerce' ),
							'hover_color'    => esc_html__( 'Hover Color', 'gallery-slider-for-woocommerce' ),
							'bg_color'       => esc_html__( 'Background', 'gallery-slider-for-woocommerce' ),
							'hover_bg_color' => esc_html__( 'Hover Background', 'gallery-slider-for-woocommerce' ),
						),
						'default'    => array(
							'color'          => '#fff',
							'hover_color'    => '#fff',
							'bg_color'       => 'rgba(0, 0, 0, 0.5)',
							'hover_bg_color' => 'rgba(0, 0, 0, 0.8)',
						),
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'         => 'lightbox_caption',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Lightbox Caption', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Show caption in lightbox.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => true,
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'         => 'caption_color',
						'type'       => 'color',
						'title'      => esc_html__( 'Caption Color', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Change caption color.', 'gallery-slider-for-woocommerce' ),
						'default'    => '#ffffff',
						'dependency' => array( 'lightbox|lightbox_caption', '==|==', 'true|true' ),
					),
					array(
						'id'         => 'l_img_counter',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Image Counter', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Show lightbox image counter.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => true,
						'dependency' => array( 'lightbox', '==', true ),
					),

					array(
						'id'         => 'slide_play_btn',
						'type'       => 'switcher',
						'class'      => 'pro_switcher',
						'title'      => esc_html__( 'Slideshow Play Button', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Show/Hide start slideshow play button.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => false,
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'         => 'side_gallery_btn',
						'class'      => 'pro_switcher',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Thumbnails Side Gallery', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Show/Hide thumbnails side gallery button  .', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => false,
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'         => 'thumb_gallery_show',
						'type'       => 'checkbox',
						'class'      => 'pro_checkbox',
						'title'      => esc_html__( 'Thumbnails Side Gallery Visibility', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Check to show thumbnails right side gallery (Pro).', 'gallery-slider-for-woocommerce' ),
						'default'    => false,
						'dependency' => array( 'lightbox', '==', true ),
					),

					array(
						'id'         => 'gallery_share',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Social Share Button', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Show/Hide social share button.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => false,
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'         => 'gallery_fs_btn',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Full Screen Button', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Show/Hide image full screen button.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => false,
						'dependency' => array( 'lightbox', '==', true ),
					),
					array(
						'id'         => 'gallery_dl_btn',
						'type'       => 'switcher',
						'class'      => 'pro_switcher',
						'title'      => esc_html__( 'Download Button', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Show/Hide product gallery image download button.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => false,
						'dependency' => array( 'lightbox', '==', true ),
					),
				),
			)
		);
	}
}
