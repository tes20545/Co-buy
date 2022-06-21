<?php
/**
 * Metabox page configuration.
 *
 * @since      2.2.0
 * @package    Woo_Product_Slider
 * @subpackage Woo_Product_Slider/admin/view
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; }
// Cannot access pages directly.

/**
 * Product slider metabox prefix.
 */
$prefix = 'sp_wps_shortcode_options';

/**
 * Preview metabox.
 *
 * @param string $prefix The metabox main Key.
 * @return void
 */
SPWPS::create_metabox(
	'spwps_live_preview',
	array(
		'title'           => __( 'Live Preview', 'woo-product-slider' ),
		'post_type'       => 'sp_wps_shortcodes',
		'show_restore'    => false,
		'spwps_shortcode' => false,
		'context'         => 'normal',
	)
);
SPWPS::create_section(
	'spwps_live_preview',
	array(
		'fields' => array(
			array(
				'type' => 'preview',
			),
		),
	)
);

/**
 * Create a metabox for product slider.
 */
SPWPS::create_metabox(
	$prefix,
	array(
		'title'     => __( 'Slider Options', 'woo-product-slider' ),
		'post_type' => 'sp_wps_shortcodes',
		'context'   => 'normal',
		'class'     => 'wps-shortcode-options',
	)
);

/**
 * General Settings section.
 */
SPWPS::create_section(
	$prefix,
	array(
		'title'  => __( 'General Settings', 'woo-product-slider' ),
		'icon'   => 'fa fa-cog',
		'fields' => array(

			array(
				'id'       => 'carousel_type',
				'type'     => 'button_set',
				'title'    => __( 'Slider Type', 'woo-product-slider' ),
				'subtitle' => __( 'Select which type of slider you want to show.', 'woo-product-slider' ),
				'options'  => array(
					'product_carousel'  => array(
						'name' => __( 'Product', 'woo-product-slider' ),
					),
					'category_carousel' => array(
						'name'     => __( 'Category', 'woo-product-slider' ),
						'pro_only' => true,
					),
				),
				'default'  => 'product_carousel',
			),
			array(
				'id'         => 'layout_preset',
				'class'      => 'layout_preset',
				'type'       => 'image_select',
				'title'      => __( 'Layout Preset', 'woo-product-slider' ),
				'subtitle'   => __( 'Choose a layout preset.', 'woo-product-slider' ),
				'desc'       => __( 'To unlock Grid(Even, Masonry) layout, <a href="https://shapedplugin.com/plugin/woocommerce-product-slider-pro/?ref=1" target="_blank"><b>Upgrade To Pro!</b></a>', 'woo-product-slider' ),
				'image_name' => true,
				'options'    => array(
					'slider' => array(
						'img' => plugin_dir_url( __FILE__ ) . 'models/assets/images/slider.svg',
					),
					'grid'   => array(
						'img'      => plugin_dir_url( __FILE__ ) . 'models/assets/images/grid.svg',
						'pro_only' => true,
					),
				),
				'default'    => 'slider',
			),
			array(
				'id'       => 'theme_style',
				'type'     => 'select',
				'title'    => __( 'Select Your Theme', 'woo-product-slider' ),
				'subtitle' => __( 'Select which theme style you want to display. Browse <a href="https://demo.shapedplugin.com/woocommerce-product-slider/" target="_blank">Themes Preview</a> in action!', 'woo-product-slider' ),
				'options'  => array(
					'theme_one'   => array(
						'name' => __( 'Theme One', 'woo-product-slider' ),
					),
					'theme_two'   => array(
						'name' => __( 'Theme Two', 'woo-product-slider' ),
					),
					'theme_three' => array(
						'name' => __( 'Theme Three', 'woo-product-slider' ),
					),
					'theme_four'  => array(
						'name'     => __( '30+ Themes (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
				),
				'default'  => 'theme_one',
			),
			array(
				'id'       => 'product_type',
				'type'     => 'select',
				'title'    => __( 'Filter Products', 'woo-product-slider' ),
				'subtitle' => __( 'Select an option to filter the products.', 'woo-product-slider' ),
				'options'  => array(
					'latest_products'                  => array(
						'name' => __( 'Latest', 'woo-product-slider' ),
					),
					'featured_products'                => array(
						'name' => __( 'Featured', 'woo-product-slider' ),
					),
					'products_from_categories'         => array(
						'name'     => __( 'Category (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'products_from_tags'               => array(
						'name'     => __( 'Tag (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'best_selling_products'            => array(
						'name'     => __( 'Best Selling (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'related_products'                 => array(
						'name'     => __( 'Related (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'up_sells'                         => array(
						'name'     => __( 'Upsells (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'cross_sells'                      => array(
						'name'     => __( 'Cross-sells (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'top_rated_products'               => array(
						'name'     => __( 'Top Rated (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'on_sell_products'                 => array(
						'name'     => __( 'On Sale (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'specific_products'                => array(
						'name'     => __( 'Specific (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'most_viewed_products'             => array(
						'name'     => __( 'Most Viewed (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'recently_viewed_products'         => array(
						'name'     => __( 'Recently Viewed (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'products_from_sku'                => array(
						'name'     => __( 'SKU (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'products_from_attribute'          => array(
						'name'     => __( 'Attribute (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'products_from_free'               => array(
						'name'     => __( 'Free (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'products_from_exclude_categories' => array(
						'name'     => __( 'Exclude Category (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),
					'products_from_exclude_tags'       => array(
						'name'     => __( 'Exclude Tag (Pro)', 'woo-product-slider' ),
						'pro_only' => true,
					),

				),
				'default'  => 'latest_products',
			),
			array(
				'id'       => 'hide_out_of_stock_product',
				'type'     => 'checkbox',
				'title'    => __( 'Hide Out of Stock Products', 'woo-product-slider' ),
				'subtitle' => __( 'Check to hide out of stock products.', 'woo-product-slider' ),
				'default'  => false,
			),
			array(
				'id'         => 'hide_on_sale_product',
				'type'       => 'checkbox',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Hide On Sale Products', 'woo-product-slider' ),
				'subtitle'   => __( 'Check to hide on sale products.', 'woo-product-slider' ),
				'default'    => false,
			),
			array(
				'id'       => 'number_of_column',
				'type'     => 'column',
				'title'    => __( 'Column(s)', 'woo-product-slider' ),
				'subtitle' => __( 'Set products column(s) in different devices.', 'woo-product-slider' ),
				'default'  => array(
					'number1' => '4',
					'number2' => '3',
					'number3' => '2',
					'number4' => '1',
				),
			),
			array(
				'id'       => 'number_of_total_products',
				'type'     => 'spinner',
				'title'    => __( 'Limit', 'woo-product-slider' ),
				'subtitle' => __( 'Set number of total products to show.', 'woo-product-slider' ),
				'default'  => 16,
				'max'      => 60000,
				'min'      => -1,
			),
			array(
				'id'       => 'product_order_by',
				'type'     => 'select',
				'title'    => __( 'Order by', 'woo-product-slider' ),
				'subtitle' => __( 'Set a order by option.', 'woo-product-slider' ),
				'options'  => array(
					'ID'       => array(
						'name' => __( 'ID', 'woo-product-slider' ),
					),
					'date'     => array(
						'name' => __( 'Date', 'woo-product-slider' ),
					),
					'rand'     => array(
						'name' => __( 'Random', 'woo-product-slider' ),
					),
					'title'    => array(
						'name' => __( 'Title', 'woo-product-slider' ),
					),
					'modified' => array(
						'name' => __( 'Modified', 'woo-product-slider' ),
					),
				),
				'default'  => 'date',
			),
			array(
				'id'       => 'product_order',
				'type'     => 'select',
				'title'    => __( 'Order', 'woo-product-slider' ),
				'subtitle' => __( 'Set product order.', 'woo-product-slider' ),
				'options'  => array(
					'ASC'  => array(
						'name' => __( 'Ascending', 'woo-product-slider' ),
					),
					'DESC' => array(
						'name' => __( 'Descending', 'woo-product-slider' ),
					),
				),
				'default'  => 'DESC',
			),
			array(
				'id'         => 'preloader',
				'type'       => 'switcher',
				'title'      => __( 'Preloader', 'woo-product-slider' ),
				'subtitle'   => __( 'Slider will be hidden until page load completed.', 'woo-product-slider' ),
				'text_on'    => __( 'Enabled', 'woo-product-slider' ),
				'text_off'   => __( 'Disabled', 'woo-product-slider' ),
				'text_width' => 96,
				'default'    => true,
			),

		),
	)
);

/**
 * Slider Controls section.
 */
SPWPS::create_section(
	$prefix,
	array(
		'title'  => __( 'Slider Controls', 'woo-product-slider' ),
		'icon'   => 'fa fa-sliders',
		'fields' => array(
			array(
				'id'       => 'carousel_ticker_mode',
				'type'     => 'button_set',
				'title'    => __( 'Slider Mode', 'woo-product-slider' ),
				'subtitle' => __( 'Set slider mode.', 'woo-product-slider' ),
				'options'  => array(
					false => array(
						'name' => __( 'Standard', 'woo-product-slider' ),
					),
					true  => array(
						'name'     => __( 'Ticker', 'woo-product-slider' ),
						'pro_only' => true,
					),
				),
				'default'  => false,
			),

			array(
				'id'         => 'carousel_auto_play',
				'type'       => 'switcher',
				'title'      => __( 'AutoPlay', 'woo-product-slider' ),
				'subtitle'   => __( 'Enable/Disable auto play.', 'woo-product-slider' ),
				'text_on'    => __( 'Enabled', 'woo-product-slider' ),
				'text_off'   => __( 'Disabled', 'woo-product-slider' ),
				'text_width' => 96,
				'default'    => true,
			),
			array(
				'id'         => 'carousel_auto_play_speed',
				'type'       => 'spinner',
				'title'      => __( 'AutoPlay Speed', 'woo-product-slider' ),
				'subtitle'   => __( 'Set auto play speed. Default value is 3000 milliseconds.', 'woo-product-slider' ),
				'unit'       => __( 'ms', 'woo-product-slider' ),
				'max'        => 30000,
				'min'        => 1,
				'default'    => 3000,
				'dependency' => array( 'carousel_auto_play', '==', 'true' ),
			),
			array(
				'id'       => 'carousel_scroll_speed',
				'type'     => 'spinner',
				'title'    => __( 'Slider Speed', 'woo-product-slider' ),
				'subtitle' => __( 'Set slider scroll speed. Default value is 600 milliseconds.', 'woo-product-slider' ),
				'unit'     => __( 'ms', 'woo-product-slider' ),
				'default'  => 600,
				'min'      => 1,
				'max'      => 30000,
			),
			array(
				'id'       => 'slides_to_scroll',
				'type'     => 'column',
				'class'    => 'ps_pro_only_field',
				'title'    => __( 'Slide To Scroll', 'woo-product-slider' ),
				'subtitle' => __( 'Number of product(s) to scroll at a time.', 'woo-product-slider' ),
				'default'  => array(
					'number1' => '1',
					'number2' => '1',
					'number3' => '1',
					'number4' => '1',
				),
			),
			array(
				'id'         => 'carousel_pause_on_hover',
				'type'       => 'switcher',
				'title'      => __( 'Pause on Hover', 'woo-product-slider' ),
				'subtitle'   => __( 'Enable/Disable pause on hover.', 'woo-product-slider' ),
				'text_on'    => __( 'Enabled', 'woo-product-slider' ),
				'text_off'   => __( 'Disabled', 'woo-product-slider' ),
				'text_width' => 96,
				'default'    => true,
				'dependency' => array( 'carousel_auto_play', '==', 'true' ),
			),
			array(
				'id'         => 'carousel_infinite',
				'type'       => 'switcher',
				'title'      => __( 'Infinite Loop', 'woo-product-slider' ),
				'subtitle'   => __( 'Enable/Disable infinite loop mode.', 'woo-product-slider' ),
				'text_on'    => __( 'Enabled', 'woo-product-slider' ),
				'text_off'   => __( 'Disabled', 'woo-product-slider' ),
				'text_width' => 96,
				'default'    => true,
			),
			array(
				'id'       => 'rtl_mode',
				'type'     => 'button_set',
				'title'    => __( 'Slider Direction', 'woo-product-slider' ),
				'subtitle' => __( 'Set slider direction as you need.', 'woo-product-slider' ),
				'options'  => array(
					false => array(
						'name' => __( 'Right to Left', 'woo-product-slider' ),
					),
					true  => array(
						'name' => __( 'Left to Right', 'woo-product-slider' ),
					),
				),
				'default'  => false,
			),
			array(
				'id'       => 'slider_row',
				'class'    => 'ps_pro_only_field',
				'type'     => 'column',
				'title'    => __( 'Row', 'woo-product-slider' ),
				'subtitle' => __( 'Number of row(s) to scroll at a time.', 'woo-product-slider' ),
				'default'  => array(
					'number1' => '1',
					'number2' => '1',
					'number3' => '1',
					'number4' => '1',
				),
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Navigation', 'woo-product-slider' ),
			),
			array(
				'id'       => 'navigation_arrow',
				'type'     => 'button_set',
				'title'    => __( 'Navigation', 'woo-product-slider' ),
				'subtitle' => __( 'Show/Hide navigation arrow.', 'woo-product-slider' ),
				'options'  => array(
					'true'           => array(
						'name' => __( 'Show', 'woo-product-slider' ),
					),
					'false'          => array(
						'name' => __( 'Hide', 'woo-product-slider' ),
					),
					'hide_on_mobile' => array(
						'name' => __( 'Hide on Mobile', 'woo-product-slider' ),
					),
				),
				'default'  => 'true',
			),
			array(
				'id'         => 'navigation_arrow_colors',
				'type'       => 'color_group',
				'title'      => __( 'Color', 'woo-product-slider' ),
				'subtitle'   => __( 'Set color for the slider navigation.', 'woo-product-slider' ),
				'options'    => array(
					'color'            => __( 'Color', 'woo-product-slider' ),
					'hover_color'      => __( 'Hover Color', 'woo-product-slider' ),
					'background'       => __( 'Background', 'woo-product-slider' ),
					'hover_background' => __( 'Hover Background', 'woo-product-slider' ),
					'border'           => __( 'Border', 'woo-product-slider' ),
					'hover_border'     => __( 'Hover Border', 'woo-product-slider' ),
				),
				'default'    => array(
					'color'            => '#444444',
					'hover_color'      => '#ffffff',
					'background'       => 'transparent',
					'hover_background' => '#444444',
					'border'           => '#aaaaaa',
					'hover_border'     => '#444444',
				),
				'dependency' => array( 'navigation_arrow', 'any', 'true,hide_on_mobile' ),
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Pagination', 'woo-product-slider' ),
			),
			array(
				'id'       => 'pagination',
				'type'     => 'button_set',
				'title'    => __( 'Pagination', 'woo-product-slider' ),
				'subtitle' => __( 'Show/Hide pagination.', 'woo-product-slider' ),
				'options'  => array(
					'true'           => array(
						'name' => __( 'Show', 'woo-product-slider' ),
					),
					'false'          => array(
						'name' => __( 'Hide', 'woo-product-slider' ),
					),
					'hide_on_mobile' => array(
						'name' => __( 'Hide on Mobile', 'woo-product-slider' ),
					),
				),
				'default'  => 'true',
			),
			array(
				'id'         => 'pagination_dots_color',
				'type'       => 'color_group',
				'title'      => __( 'Color', 'woo-product-slider' ),
				'subtitle'   => __( 'Set color for the slider pagination dots.', 'woo-product-slider' ),
				'options'    => array(
					'color'        => __( 'Color', 'woo-product-slider' ),
					'active_color' => __( 'Active Color', 'woo-product-slider' ),
				),
				'default'    => array(
					'color'        => '#cccccc',
					'active_color' => '#333333',
				),
				'dependency' => array( 'pagination', 'any', 'true,hide_on_mobile' ),
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Miscellaneous', 'woo-product-slider' ),
			),
			array(
				'id'         => 'carousel_swipe',
				'type'       => 'switcher',
				'title'      => __( 'Swipe', 'woo-product-slider' ),
				'subtitle'   => __( 'Enable/Disable swipe mode.', 'woo-product-slider' ),
				'text_on'    => __( 'Enabled', 'woo-product-slider' ),
				'text_off'   => __( 'Disabled', 'woo-product-slider' ),
				'text_width' => 96,
				'default'    => true,
			),
			array(
				'id'         => 'carousel_draggable',
				'type'       => 'switcher',
				'title'      => __( 'Mouse Draggable', 'woo-product-slider' ),
				'subtitle'   => __( 'Enable/Disable mouse draggable mode.', 'woo-product-slider' ),
				'text_on'    => __( 'Enabled', 'woo-product-slider' ),
				'text_off'   => __( 'Disabled', 'woo-product-slider' ),
				'text_width' => 96,
				'default'    => true,
				'dependency' => array( 'carousel_swipe', '==', 'true' ),
			),

		),
	)
);

/**
 * Display Options section.
 */
SPWPS::create_section(
	$prefix,
	array(
		'title'  => __( 'Display Options', 'woo-product-slider' ),
		'icon'   => 'fa fa-th-large',
		'fields' => array(
			array(
				'id'         => 'slider_title',
				'type'       => 'switcher',
				'title'      => __( 'Slider Section Title', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide slider section title.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => false,
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Product Name', 'woo-product-slider' ),
			),
			array(
				'id'         => 'product_name',
				'type'       => 'switcher',
				'title'      => __( 'Name', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide product name.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => true,
			),
			array(
				'id'         => 'product_name_word_limit',
				'class'      => 'pro_only_field',
				'type'       => 'checkbox',
				'disabled'   => 'disabled',
				'title'      => __( 'Limit Word', 'woo-product-slider' ),
				'subtitle'   => __( 'Check to product name word limit.', 'woo-product-slider' ),
				'default'    => false,
				'dependency' => array(
					'product_name',
					'==',
					'true',
				),
			),
			/**
			 * Product Description Settings
			 */
			array(
				'type'    => 'subheading',
				'content' => __( 'Product Description', 'woo-product-slider' ),
			),
			array(
				'type'    => 'notice',
				'content' => __( 'To unlock the following Product Description options, <a href="https://shapedplugin.com/plugin/woocommerce-product-slider-pro/?ref=1" target="_blank"><b>Upgrade To Pro!</b></a>', 'woo-product-slider' ),
			),
			array(
				'id'         => 'product_content',
				'class'      => 'pro_only_field pro_only_field_group',
				'type'       => 'switcher',
				'title'      => __( 'Description', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide product description.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => false,
			),
			array(
				'id'       => 'product_content_type',
				'class'    => 'pro_only_field pro_only_field_group',
				'type'     => 'button_set',
				'title'    => __( 'Description Display Type', 'woo-product-slider' ),
				'subtitle' => __( 'Select a product description display type.', 'woo-product-slider' ),
				'options'  => array(
					'short_description' => array(
						'name' => __( 'Short', 'woo-product-slider' ),
					),
					'full_description'  => array(
						'name'     => __( 'Full', 'woo-product-slider' ),
						'pro_only' => true,
					),
				),
				'default'  => 'short_description',
			),
			array(
				'id'       => 'product_content_word_limit',
				'class'    => 'pro_only_field pro_only_field_group',
				'type'     => 'spinner',
				'title'    => __( 'Word Length', 'woo-product-slider' ),
				'subtitle' => __( 'Set word limit Length for product description.', 'woo-product-slider' ),
				'default'  => 19,
				'min'      => 1,
				'max'      => 1000,
			),
			array(
				'id'         => 'product_content_more_button',
				'type'       => 'switcher',
				'class'      => 'pro_only_field pro_only_field_group',
				'title'      => __( 'Read More Button', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide product description read more button.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => false,
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Product Price', 'woo-product-slider' ),
			),
			array(
				'id'         => 'product_price',
				'type'       => 'switcher',
				'title'      => __( 'Price', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide product price.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => true,
			),
			array(
				'id'         => 'product_del_price_color',
				'type'       => 'color',
				'title'      => __( 'Discount Color', 'woo-product-slider' ),
				'subtitle'   => __( 'Set discount price color.', 'woo-product-slider' ),
				'default'    => '#888888',
				'dependency' => array( 'product_price', '==', 'true' ),
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Product Rating', 'woo-product-slider' ),
			),
			array(
				'id'         => 'product_rating',
				'type'       => 'switcher',
				'title'      => __( 'Rating', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide product rating.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => true,
			),
			array(
				'id'         => 'product_rating_colors',
				'type'       => 'color_group',
				'title'      => __( 'Color', 'woo-product-slider' ),
				'subtitle'   => __( 'Set rating star color.', 'woo-product-slider' ),
				'options'    => array(
					'color'       => __( 'Star Color', 'woo-product-slider' ),
					'empty_color' => __( 'Empty Star Color', 'woo-product-slider' ),
				),
				'default'    => array(
					'color'       => '#F4C100',
					'empty_color' => '#C8C8C8',
				),
				'dependency' => array( 'product_rating', '==', 'true' ),
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Add to Cart Button', 'woo-product-slider' ),
			),
			array(
				'id'         => 'add_to_cart_button',
				'type'       => 'switcher',
				'title'      => __( 'Add to Cart Button', 'woo-product-slider' ),
				'subtitle'   => __( 'Show/Hide product add to cart button.', 'woo-product-slider' ),
				'text_on'    => __( 'Show', 'woo-product-slider' ),
				'text_off'   => __( 'Hide', 'woo-product-slider' ),
				'text_width' => 77,
				'default'    => true,
			),
			array(
				'id'         => 'add_to_cart_button_colors',
				'type'       => 'color_group',
				'title'      => __( 'Color', 'woo-product-slider' ),
				'subtitle'   => __( 'Set product add to cart button color.', 'woo-product-slider' ),
				'options'    => array(
					'color'            => __( 'Text Color', 'woo-product-slider' ),
					'hover_color'      => __( 'Text Hove', 'woo-product-slider' ),
					'background'       => __( 'Background', 'woo-product-slider' ),
					'hover_background' => __( 'Hover BG', 'woo-product-slider' ),
				),
				'default'    => array(
					'color'            => '#444444',
					'hover_color'      => '#ffffff',
					'background'       => 'transparent',
					'hover_background' => '#222222',
				),
				'dependency' => array( 'add_to_cart_button', '==', 'true' ),
			),
			array(
				'id'          => 'add_to_cart_border',
				'type'        => 'border',
				'title'       => __( 'Border', 'woo-product-slider' ),
				'subtitle'    => __( 'Set add to cart button border.', 'woo-product-slider' ),
				'all'         => true,
				'hover_color' => true,
				'default'     => array(
					'all'         => '1',
					'style'       => 'solid',
					'color'       => '#222222',
					'hover_color' => '#222222',
				),
				'dependency'  => array( 'add_to_cart_button', '==', 'true' ),
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Pagination', 'woo-product-slider' ),
			),
			array(
				'type'    => 'notice',
				'content' => __( 'To unlock the following Pagination options for Grid(even, masonry) layout, <a  href="https://shapedplugin.com/plugin/woocommerce-product-slider-pro/?ref=1" target="_blank"><b>Upgrade To Pro!</b></a>', 'woo-product-slider' ),
			),
			array(
				'id'         => 'grid_pagination',
				'class'      => 'pro_only_field pro_only_field_group',
				'type'       => 'switcher',
				'title'      => __( 'Pagination', 'woo-product-slider' ),
				'subtitle'   => __( 'Enable/Disable pagination.', 'woo-product-slider' ),
				'text_on'    => __( 'Enabled', 'woo-product-slider' ),
				'text_off'   => __( 'Disabled', 'woo-product-slider' ),
				'text_width' => 96,
			),
			array(
				'id'       => 'grid_pagination_type',
				'class'    => 'pro_only_field ',
				'type'     => 'radio',
				'title'    => __( 'Pagination Type', 'woo-product-slider' ),
				'subtitle' => __( 'Choose a pagination type.', 'woo-product-slider' ),
				'options'  => array(
					'normal'           => __( 'Normal ', 'woo-product-slider' ),
					'ajax_number'      => __( 'Ajax Number', 'woo-product-slider' ),
					'load_more_btn'    => __( 'Load More Button (Ajax)', 'woo-product-slider' ),
					'load_more_scroll' => __( 'Load More on Scroll (Ajax)', 'woo-product-slider' ),
				),
				'default'  => 'normal',
			),
			array(
				'id'       => 'grid_pagination_alignment',
				'class'    => 'product-rating-alignment pro_only_field pro_only_field_group',
				'type'     => 'button_set',
				'title'    => __( 'Alignment', 'woo-product-slider' ),
				'subtitle' => __( 'Select pagination alignment.', 'woo-product-slider' ),
				'options'  => array(
					'wpspro-align-left'   => array(
						'name'     => '<i title="Left" class="fa fa-align-left"></i>',
						'pro_only' => true,
					),
					'wpspro-align-center' => array(
						'name'     => '<i title="Left" class="fa fa-align-center"></i>',
						'pro_only' => true,
					),
					'wpspro-align-right'  => array(
						'name'     => '<i title="Left" class="fa fa-align-right"></i>',
						'pro_only' => true,
					),
				),
				'default'  => 'wpspro-align-left',
			),
		),
	)
);

	/**
	 * Image Settings section.
	 */
	SPWPS::create_section(
		$prefix,
		array(
			'title'  => __( 'Image Settings', 'woo-product-slider' ),
			'icon'   => 'fa fa-image',
			'fields' => array(
				array(
					'id'         => 'product_image',
					'type'       => 'switcher',
					'title'      => __( 'Image', 'woo-product-slider' ),
					'subtitle'   => __( 'Show/Hide product image.', 'woo-product-slider' ),
					'text_on'    => __( 'Show', 'woo-product-slider' ),
					'text_off'   => __( 'Hide', 'woo-product-slider' ),
					'text_width' => 77,
					'default'    => true,
				),
				array(
					'id'          => 'product_image_border',
					'type'        => 'border',
					'title'       => __( 'Border', 'woo-product-slider' ),
					'subtitle'    => __( 'Set product image border.', 'woo-product-slider' ),
					'all'         => true,
					'hover_color' => true,
					'default'     => array(
						'all'         => '1',
						'style'       => 'solid',
						'color'       => '#dddddd',
						'hover_color' => '#dddddd',
					),
					'dependency'  => array( 'product_image|theme_style', '==|==', 'true|theme_one', true ),
				),
				array(
					'id'         => 'product_image_flip',
					'class'      => 'pro_only_field',
					'type'       => 'checkbox',
					'disabled'   => 'disabled',
					'title'      => __( 'Image Flip', 'woo-product-slider' ),
					'subtitle'   => __( 'Check to enable product image flip.', 'woo-product-slider' ),
					'default'    => false,
					'dependency' => array(
						'theme_style|carousel_type|product_image',
						'!=|==|==',
						'theme_eighteen|product_carousel|true',
					),
				),
				array(
					'id'       => 'image_lightbox',
					'type'     => 'switcher',
					'class'    => 'pro_only_field',
					'title'    => __( 'Lightbox', 'woo-product-slider' ),
					'subtitle' => __( 'On/Off product image lightbox.', 'woo-product-slider' ),
					'default'  => false,
				),
				array(
					'id'         => 'image_sizes',
					'type'       => 'image_sizes',
					'title'      => __( 'Image Size', 'woo-product-slider' ),
					'subtitle'   => __( 'Select a size for product image.', 'woo-product-slider' ),
					'default'    => 'full',
					'dependency' => array(
						'product_image',
						'==',
						'true',
					),
				),
				array(
					'id'             => 'image_custom_size',
					'type'           => 'dimensions',
					'title'          => __( 'Custom Size', 'woo-product-slider' ),
					'subtitle'       => __( 'Set a custom width and height of the product image.', 'woo-product-slider' ),
					'show_crop_list' => true,
					'disabled'       => 'disabled',
					'units'          => array( 'px' ),
					'default'        => array(
						'width'  => '250',
						'height' => '300',
						'crop'   => 'hard-crop',
					),
					'dependency'     => array(
						'product_image|image_sizes',
						'==|==',
						'true|custom',
					),
				),
				array(
					'id'         => 'image_gray_scale',
					'type'       => 'select',
					'title'      => __( 'Image mode', 'woo-product-slider' ),
					'subtitle'   => __( 'Set a mode for image.', 'woo-product-slider' ),
					'options'    => array(
						''                      => array(
							'name' => __( 'Normal', 'woo-product-slider' ),
						),
						'sp-wpsp-gray-with-normal-on-hover' => array(
							'name'     => __( 'Grayscale with normal on hover(Pro)', 'woo-product-slider' ),
							'pro_only' => true,
						),
						'sp-wpsp-gray-on-hover' => array(
							'name'     => __( 'Grayscale on hover(Pro)', 'woo-product-slider' ),
							'pro_only' => true,
						),
						'sp-wpsp-always-gray'   => array(
							'name'     => __( 'Always grayscale(Pro)', 'woo-product-slider' ),
							'pro_only' => true,
						),
					),
					'default'    => '',
					'dependency' => array(
						'product_image',
						'==',
						'true',
					),
				),
			),
		)
	);

	/**
	 * Typography section.
	 */
	SPWPS::create_section(
		$prefix,
		array(
			'title'  => __( 'Typography', 'woo-product-slider' ),
			'icon'   => 'fa fa-font',
			'fields' => array(
				array(
					'type'    => 'notice',
					'style'   => 'warning',
					'content' => __( 'The Following Typography (900+ Google Fonts) options are available in the <a href="https://shapedplugin.com/plugin/woocommerce-product-slider-pro/?ref=1"><b>Pro Version</b></a> only except the <b>Slider Section Title, Product Name, Product Price</b> Font size and color fields.', 'woo-product-slider' ),
				),
				array(
					'id'           => 'slider_title_typography',
					'type'         => 'typography',
					'title'        => __( 'Slider Section Title Font', 'woo-product-slider' ),
					'subtitle'     => __( 'Set slider section title font properties.', 'woo-product-slider' ),
					'default'      => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => '600',
						'type'           => 'google',
						'font-size'      => '22',
						'line-height'    => '23',
						'text-align'     => 'left',
						'text-transform' => 'none',
						'letter-spacing' => '',
						'color'          => '#444444',
					),
					'preview_text' => 'Slider Section Title', // Replace preview text with any text you like.
				),
				array(
					'id'           => 'product_name_typography',
					'type'         => 'typography',
					'title'        => __( 'Product Name Font', 'woo-product-slider' ),
					'subtitle'     => __( 'Set product name font properties.', 'woo-product-slider' ),
					'default'      => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => '600',
						'type'           => 'google',
						'font-size'      => '15',
						'line-height'    => '20',
						'text-align'     => 'center',
						'text-transform' => 'none',
						'letter-spacing' => '',
						'color'          => '#444444',
						'hover_color'    => '#955b89',
					),
					'hover_color'  => true,
					'preview_text' => 'Product Name', // Replace preview text with any text you like.
				),
				array(
					'id'       => 'product_description_typography',
					'type'     => 'typography',
					'title'    => __( 'Product Description Font', 'woo-product-slider' ),
					'subtitle' => __( 'Set product description font properties.', 'woo-product-slider' ),
					'class'    => 'product-description-typography',
					'default'  => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => 'regular',
						'type'           => 'google',
						'font-size'      => '14',
						'line-height'    => '20',
						'text-align'     => 'center',
						'text-transform' => 'none',
						'letter-spacing' => '',
						'color'          => '#333333',
					),
				),
				array(
					'id'       => 'product_price_typography',
					'type'     => 'typography',
					'title'    => __( 'Product Price Font', 'woo-product-slider' ),
					'subtitle' => __( 'Set product price font properties.', 'woo-product-slider' ),
					'class'    => 'product-price-typography',
					'default'  => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => '700',
						'type'           => 'google',
						'font-size'      => '14',
						'line-height'    => '19',
						'text-align'     => 'center',
						'text-transform' => 'none',
						'letter-spacing' => '',
						'color'          => '#222222',
					),
				),
				array(
					'id'       => 'sale_ribbon_typography',
					'type'     => 'typography',
					'title'    => __( 'Sale Ribbon Font', 'woo-product-slider' ),
					'subtitle' => __( 'Set product sale ribbon font properties.', 'woo-product-slider' ),
					'class'    => 'sale-ribbon-typography',
					'default'  => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => 'regular',
						'type'           => 'google',
						'font-size'      => '10',
						'line-height'    => '10',
						'text-align'     => 'center',
						'text-transform' => 'uppercase',
						'letter-spacing' => '1',
						'color'          => '#ffffff',
					),
				),
				array(
					'id'       => 'out_of_stock_ribbon_typography',
					'type'     => 'typography',
					'title'    => __( 'Out of Stock Ribbon Font', 'woo-product-slider' ),
					'subtitle' => __( 'Set product out of stock ribbon font properties.', 'woo-product-slider' ),
					'class'    => 'out-of-stock-ribbon-typography',
					'default'  => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => 'regular',
						'type'           => 'google',
						'font-size'      => '10',
						'line-height'    => '10',
						'text-align'     => 'center',
						'text-transform' => 'uppercase',
						'letter-spacing' => '1',
						'color'          => '#ffffff',
					),
				),
				array(
					'id'          => 'product_category_typography',
					'type'        => 'typography',
					'title'       => __( 'Product Category Font', 'woo-product-slider' ),
					'subtitle'    => __( 'Set product category font properties.', 'woo-product-slider' ),
					'class'       => 'product-category-typography',
					'default'     => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => 'regular',
						'type'           => 'google',
						'font-size'      => '14',
						'line-height'    => '19',
						'text-align'     => 'center',
						'text-transform' => 'none',
						'letter-spacing' => '',
						'color'          => '#444444',
						'hover_color'    => '#955b89',
					),
					'hover_color' => true,
				),
				array(
					'id'       => 'compare_wishlist_typography',
					'type'     => 'typography',
					'title'    => __( 'Compare & Wishlist Font', 'woo-product-slider' ),
					'subtitle' => __( 'Set compare and wishlist font properties.', 'woo-product-slider' ),
					'class'    => 'compare-wishlist-typography',
					'default'  => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => 'regular',
						'type'           => 'google',
						'font-size'      => '14',
						'line-height'    => '19',
						'text-align'     => 'center',
						'text-transform' => 'none',
						'letter-spacing' => '',
					),
					'color'    => false,
				),
				array(
					'id'       => 'add_to_cart_typography',
					'type'     => 'typography',
					'title'    => __( 'Add to Cart & View Details Font', 'woo-product-slider' ),
					'subtitle' => __( 'Set add to cart and view details font properties.', 'woo-product-slider' ),
					'class'    => 'add-to-cart-typography',
					'default'  => array(
						'font-family'    => 'Open Sans',
						'font-weight'    => '600',
						'type'           => 'google',
						'font-size'      => '14',
						'line-height'    => '19',
						'text-align'     => 'center',
						'text-transform' => 'none',
						'letter-spacing' => '',
					),
					'color'    => false,
				),

			),
		)
	);
