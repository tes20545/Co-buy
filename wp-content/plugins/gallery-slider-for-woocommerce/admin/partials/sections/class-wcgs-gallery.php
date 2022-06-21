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
 * WCGS Gallery class
 */
class WCGS_Gallery {
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
				'name'   => 'gallery',
				'title'  => '<svg height="17px" width="17px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"><g><path fill="none" d="M21.033,35.681c2.066,0,3.735-1.668,3.735-3.69c0-2.031-1.669-3.702-3.735-3.702   c-2.059,0-3.729,1.67-3.729,3.702C17.303,34.013,18.974,35.681,21.033,35.681z"></path><g><path d="M12,15.667v67.556h76V81.82V15.667H12z M84.124,19.868V79.02H15.875V19.868H84.124z"></path><path d="M19.729,23.625v36.593h60.542V23.625H19.729z M24.323,55.641l-0.27,0.862v-0.862H24.323l8.379-26.582l15.135,18.298    l8.651-4.577l2.16,12.859H24.323V55.641z M69.504,41.917c-3.58,0-6.482-3.07-6.482-6.861s2.902-6.861,6.482-6.861    c3.583,0,6.487,3.071,6.487,6.861S73.087,41.917,69.504,41.917z"></path><polygon points="24.852,49.669 25.111,48.902 24.852,48.902   "></polygon><polygon points="24.852,48.902 24.852,49.669 25.111,48.902   "></polygon><rect x="19.729" y="65.536" width="15.397" height="9.853"></rect><rect x="42.483" y="65.536" width="15.4" height="9.853"></rect><rect x="64.874" y="65.536" width="15.397" height="9.853"></rect></g></g></svg>' . esc_html__( 'Gallery', 'gallery-slider-for-woocommerce' ),
				'fields' => array(
					array(
						'id'         => 'autoplay',
						'class'      => 'pro_switcher',
						'type'       => 'switcher',
						'title'      => esc_html__( 'AutoPlay', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Enable/Disable gallery autoplay.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
						'text_width' => 96,
					),
					array(
						'id'       => 'slide_orientation',
						'type'     => 'select',
						'title'    => esc_html__( 'Slide Orientation', 'gallery-slider-for-woocommerce' ),
						'subtitle' => esc_html__( 'Choose an slide orientation for gallery.', 'gallery-slider-for-woocommerce' ),
						'options'  => array(
							'horizontal' => esc_html__( 'Horizontal', 'gallery-slider-for-woocommerce' ),
							'vertical'   => esc_html__( 'Vertical', 'gallery-slider-for-woocommerce' ),
						),
						'default'  => 'horizontal',
					),
					array(
						'id'          => 'slide_to_scroll',
						'type'        => 'spinner',
						'class'       => 'pro_only_field',
						'title'       => esc_html__( 'Thumbnail Slide(s) To Scroll', 'gallery-slider-for-woocommerce' ),
						'subtitle'    => esc_html__( 'Set number of gallery thumbnails slide to scroll at a time.', 'gallery-slider-for-woocommerce' ),
						'default'     => 1,
						'min'         => 1,
						'placeholder' => 1,
						'dependency'  => array( 'gallery_layout', '!=', 'hide_thumb', true ),
					),

					array(
						'id'         => 'infinite_loop',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Infinite Loop', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Enable/Disable to make the gallery thumbnail infinite loop.', 'gallery-slider-for-woocommerce' ),
						'default'    => true,
						'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
						'text_width' => 96,
						'dependency' => array( 'gallery_layout', '!=', 'hide_thumb', true ),
					),
					array(
						'id'       => 'fade_slide',
						'type'     => 'select',
						'title'    => esc_html__( 'Sliding Effect', 'gallery-slider-for-woocommerce' ),
						'subtitle' => esc_html__( 'Choose a sliding effect for gallery images.', 'gallery-slider-for-woocommerce' ),
						'options'  => array(
							'slide' => esc_html__( 'Slide', 'gallery-slider-for-woocommerce' ),
							'fade'  => esc_html__( 'Fade (Pro)', 'gallery-slider-for-woocommerce' ),
						),
						'default'  => 'slide',
					),
					array(
						'id'         => 'adaptive_height',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Adaptive Height', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Enable/Disable adaptive height.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
						'text_width' => 96,
						'default'    => true,
					),
					array(
						'id'         => 'accessibility',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Accessibility', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Enable/Disable accessibility.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
						'text_width' => 96,
						'default'    => true,
					),
					array(
						'id'         => 'slider_dir',
						'type'       => 'switcher',
						'title'      => esc_html__( 'RTL Mode', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Enable/Disable the mode for RTL languages.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
						'text_width' => 96,
						'default'    => false,
					),
					array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Slider Navigation & Pagination', 'gallery-slider-for-woocommerce' ),
					),
					array(
						'id'         => 'navigation',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Slider Navigation', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Show/Hide slider navigation.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => true,
					),
					array(
						'id'         => 'navigation_icon',
						'type'       => 'button_set',
						'class'      => 'btn_icon',
						'title'      => esc_html__( 'Navigation Icon Style', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Choose a navigation icon for the gallery slider.', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'angle'          => array(
								'option_name' => '<i class="fa fa-angle-left"></i>',
							),
							'chevron'        => array(
								'option_name' => '<i class="fa fa-chevron-left"></i>',
								'pro_only'    => true,
							),
							'angle_double'   => array(
								'option_name' => '<i class="fa fa-angle-double-left"></i>',
								'pro_only'    => true,
							),
							'chevron_circle' => array(
								'option_name' => '<i class="fa fa-chevron-circle-left"></i>',
								'pro_only'    => true,
							),
							'arrow'          => array(
								'option_name' => '<i class="fa fa-arrow-left"></i>',
								'pro_only'    => true,
							),
							'long_arrow'     => array(
								'option_name' => '<i class="fa fa-long-arrow-left"></i>',
								'pro_only'    => true,
							),
							'arrow_circle'   => array(
								'option_name' => '<i class="fa fa-arrow-circle-left"></i>',
								'pro_only'    => true,
							),
							'arrow_circle_o' => array(
								'option_name' => '<i class="fa fa-arrow-circle-o-left"></i>',
								'pro_only'    => true,
							),
						),
						'default'    => 'angle',
						'dependency' => array( 'navigation', '==', true ),
					),
					array(
						'id'         => 'navigation_icon_size',
						'type'       => 'spinner',
						'title'      => esc_html__( 'Navigation Icon Size', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Set navigation icon size.', 'gallery-slider-for-woocommerce' ),
						'dependency' => array( 'navigation', '==', true ),
						'default'    => 16,
					),
					array(
						'id'         => 'navigation_icon_color_group',
						'type'       => 'color_group',
						'title'      => esc_html__( 'Navigation Color', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Set navigation icon and background colors.', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'color'          => esc_html__( 'Color', 'gallery-slider-for-woocommerce' ),
							'hover_color'    => esc_html__( 'Hover Color', 'gallery-slider-for-woocommerce' ),
							'bg_color'       => esc_html__( 'Background', 'gallery-slider-for-woocommerce' ),
							'hover_bg_color' => esc_html__( 'Hover Background', 'gallery-slider-for-woocommerce' ),
						),
						'dependency' => array( 'navigation', '==', true ),
						'default'    => array(
							'color'          => '#fff',
							'hover_color'    => '#fff',
							'bg_color'       => 'rgba(0, 0, 0, .5)',
							'hover_bg_color' => 'rgba(0, 0, 0, .85)',
						),
					),
					array(
						'id'         => 'navigation_visibility',
						'type'       => 'select',
						'title'      => esc_html__( 'Navigation Visibility', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Set slider navigation visibility.', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'always' => esc_html__( 'Always', 'gallery-slider-for-woocommerce' ),
							'hover'  => esc_html__( 'On hover', 'gallery-slider-for-woocommerce' ),
						),
						'default'    => 'always',
						'dependency' => array( 'navigation', '==', true ),
					),
					array(
						'id'         => 'pagination',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Slider Pagination', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Show/Hide slider pagination bullet.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => false,
					),
					array(
						'id'         => 'pagination_icon_color_group',
						'type'       => 'color_group',
						'title'      => esc_html__( 'Pagination Color', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Set slider pagination bullet color.', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'color'        => esc_html__( 'Color', 'gallery-slider-for-woocommerce' ),
							'active_color' => esc_html__( 'Active Color', 'gallery-slider-for-woocommerce' ),
						),
						'dependency' => array( 'pagination', '==', true ),
						'default'    => array(
							'color'        => 'rgba(115, 119, 121, 0.5)',
							'active_color' => 'rgba(115, 119, 121, 0.8)',
						),
					),
					array(
						'id'         => 'pagination_visibility',
						'type'       => 'select',
						'title'      => esc_html__( 'Pagination Visibility', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Set slider pagination visibility.', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'always' => esc_html__( 'Always', 'gallery-slider-for-woocommerce' ),
							'hover'  => esc_html__( 'On hover', 'gallery-slider-for-woocommerce' ),
						),
						'default'    => 'always',
						'dependency' => array( 'pagination', '==', true ),
					),
					array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Thumbnails Navigation', 'gallery-slider-for-woocommerce' ),
					),
					array(
						'id'         => 'thumbnailnavigation',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Thumbnails Navigation', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Check to show gallery thumbnails navigation arrow.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => esc_html__( 'Show', 'gallery-slider-for-woocommerce' ),
						'text_off'   => esc_html__( 'Hide', 'gallery-slider-for-woocommerce' ),
						'text_width' => 80,
						'default'    => false,
					),

					array(
						'id'         => 'thumbnailnavigation_icon',
						'class'      => 'btn_icon',
						'type'       => 'button_set',
						'title'      => esc_html__( 'Thumbnail Navigation Icon', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Set thumbnail navigation icon.', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'angle'          => array(
								'option_name' => '<i class="fa fa-angle-left"></i>',
							),
							'chevron'        => array(
								'option_name' => '<i class="fa fa-chevron-left"></i>',
								'pro_only'    => true,
							),
							'angle_double'   => array(
								'option_name' => '<i class="fa fa-angle-double-left"></i>',
								'pro_only'    => true,
							),
							'chevron_circle' => array(
								'option_name' => '<i class="fa fa-chevron-circle-left"></i>',
								'pro_only'    => true,
							),
							'arrow'          => array(
								'option_name' => '<i class="fa fa-arrow-left"></i>',
								'pro_only'    => true,
							),
							'long_arrow'     => array(
								'option_name' => '<i class="fa fa-long-arrow-left"></i>',
								'pro_only'    => true,
							),
							'arrow_circle'   => array(
								'option_name' => '<i class="fa fa-arrow-circle-left"></i>',
								'pro_only'    => true,
							),
							'arrow_circle_o' => array(
								'option_name' => '<i class="fa fa-arrow-circle-o-left"></i>',
								'pro_only'    => true,
							),
						),
						'default'    => 'angle',
						'dependency' => array( 'thumbnailnavigation|gallery_layout', '==|!=', 'true|hide_thumb', true ),
					),

					array(
						'id'         => 'thumbnailnavigation_icon_size',
						'type'       => 'spinner',
						'title'      => esc_html__( 'Thumbnail Navigation Icon Size', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Set thumbnail navigation icon size.', 'gallery-slider-for-woocommerce' ),
						'dependency' => array( 'thumbnailnavigation|gallery_layout', '==|!=', 'true|hide_thumb', true ),
						'default'    => 12,
					),
					array(
						'id'         => 'thumbnailnavigation_icon_color_group',
						'type'       => 'color_group',
						'title'      => esc_html__( 'Thumbnail Navigation Color', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Set thumbnail navigation colors.', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'color'          => esc_html__( 'Color', 'gallery-slider-for-woocommerce' ),
							'hover_color'    => esc_html__( 'Hover Color', 'gallery-slider-for-woocommerce' ),
							'bg_color'       => esc_html__( 'Background', 'gallery-slider-for-woocommerce' ),
							'hover_bg_color' => esc_html__( 'Hover Background', 'gallery-slider-for-woocommerce' ),
						),
						'dependency' => array( 'thumbnailnavigation|gallery_layout', '==|!=', 'true|hide_thumb', true ),
						'default'    => array(
							'color'          => '#fff',
							'hover_color'    => '#fff',
							'bg_color'       => 'rgba(0, 0, 0, 0.5)',
							'hover_bg_color' => 'rgba(0, 0, 0, 0.8)',
						),
					),
					array(
						'id'         => 'thumb_nav_visibility',
						'type'       => 'select',
						'title'      => esc_html__( 'Thumbnails Navigation Visibility', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Set thumbnails navigation visibility.', 'gallery-slider-for-woocommerce' ),
						'options'    => array(
							'always' => esc_html__( 'Always', 'gallery-slider-for-woocommerce' ),
							'hover'  => esc_html__( 'On hover', 'gallery-slider-for-woocommerce' ),
						),
						'default'    => 'always',
						'dependency' => array( 'thumbnailnavigation|gallery_layout', '==|!=', 'true|hide_thumb', true ),
					),

					array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Product Image', 'gallery-slider-for-woocommerce' ),
					),
					array(
						'id'         => 'zoom',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Enable Image Zoom', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Enable/Disable product image zoom.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
						'text_width' => 96,
						'default'    => true,
					),
					array(
						'id'          => 'zoom_slider',
						'class'       => 'pro_only_slider',
						'type'        => 'slider',
						'title'       => esc_html__( 'Zoom Effect', 'gallery-slider-for-woocommerce' ),
						'subtitle'    => esc_html__( 'Set image zoom effect.', 'gallery-slider-for-woocommerce' ),
						'desc'        => __( 'Available in <a href="https://shapedplugin.com/plugin/woocommerce-gallery-slider-pro/?ref=143" target="_blank"><strong>Pro!</strong></a>', 'gallery-slider-for-woocommerce' ),
						'min'         => 1,
						'max'         => 5,
						'step'        => 0.1,
						'default'     => 1.5,
						'placeholder' => 1.5,
						'unit'        => '',
						'dependency'  => array( 'zoom', '==', true ),
					),
					array(
						'id'         => 'mobile_zoom',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Enable Zoom for Mobile Devices', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Enable/Disable image zoom for mobile devices.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
						'text_width' => 96,
						'default'    => false,
						'dependency' => array( 'zoom', '==', true ),
					),
					array(
						'id'       => 'grayscale',
						'type'     => 'select',
						'title'    => esc_html__( 'Image Mode', 'gallery-slider-for-woocommerce' ),
						'subtitle' => esc_html__( 'Select a mode for product image.', 'gallery-slider-for-woocommerce' ),
						'options'  => array(
							'gray_off'           => esc_html__( 'Normal', 'gallery-slider-for-woocommerce' ),
							'gray_always'        => esc_html__( 'Grayscale(Pro)', 'gallery-slider-for-woocommerce' ),
							'gray_onhover'       => esc_html__( 'Grayscale on hover(Pro)', 'gallery-slider-for-woocommerce' ),
							'gray_active_normal' => esc_html__( 'Grayscale with active normal(Pro)', 'gallery-slider-for-woocommerce' ),
							'active_gray_normal' => esc_html__( 'Active grayscale with normal(Pro)', 'gallery-slider-for-woocommerce' ),
						),
						'default'  => 'gray_off',
					),
					array(
						'id'       => 'image_sizes',
						'type'     => 'image_sizes',
						'title'    => esc_html__( 'Image Size', 'gallery-slider-for-woocommerce' ),
						'subtitle' => esc_html__( 'Set a size for product image.', 'gallery-slider-for-woocommerce' ),
						'default'  => 'full',
					),
					array(
						'id'         => 'preloader',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Preloader', 'gallery-slider-for-woocommerce' ),
						'subtitle'   => esc_html__( 'Preloader will show when variation changes.', 'gallery-slider-for-woocommerce' ),
						'text_on'    => __( 'Enabled', 'gallery-slider-for-woocommerce' ),
						'text_off'   => __( 'Disabled', 'gallery-slider-for-woocommerce' ),
						'text_width' => 96,
						'default'    => true,
					),
				),
			)
		);
	}
}
