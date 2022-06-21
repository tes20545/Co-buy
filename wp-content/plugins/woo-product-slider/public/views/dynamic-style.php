<?php
/**
 * Dynamic Style.
 *
 * @package    Woo_Product_Slider
 * @subpackage Woo_Product_Slider/public/views
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

$dynamic_style = '';
if ( $slider_title ) {
	$dynamic_style .= '
    #wps-slider-section.wps-slider-section-' . $post_id . ' .sp-woo-product-slider-section-title{
        color: ' . $slider_title_typography['color'] . ';
        font-size: ' . $slider_title_typography['font-size'] . 'px;
    }';
}
if ( 'true' === $pagination ) {
	$dynamic_style .= '#wps-slider-section #sp-woo-product-slider-' . $post_id . '.wps-product-section ul.slick-dots li button{
        background-color:' . $pagination_dots_bg['color'] . ';
    }
    #wps-slider-section #sp-woo-product-slider-' . $post_id . '.wps-product-section ul.slick-dots li.slick-active button{
        background-color:' . $pagination_dots_bg['active_color'] . ';
    }';
}
if ( 'true' === $navigation ) {
	$dynamic_style .= '#wps-slider-section #sp-woo-product-slider-' . $post_id . '.wps-product-section .slick-arrow {
        color:' . $nav_arrow_colors['color'] . ';
        background-color:' . $nav_arrow_colors['background'] . ';
        border: 1px solid ' . $nav_arrow_colors['border'] . ';
    }
    #wps-slider-section #sp-woo-product-slider-' . $post_id . '.wps-product-section .slick-arrow:hover {
        color:' . $nav_arrow_colors['hover_color'] . ';
        background-color:' . $nav_arrow_colors['hover_background'] . ';
        border-color:' . $nav_arrow_colors['hover_border'] . ';
    }';
}
if ( 'true' === $navigation && ! $slider_title ) {
	$dynamic_style .= '
    #wps-slider-section.wps-slider-section-' . $post_id . '{
        padding-top: 45px;
    }';
}
if ( $product_name ) {
	$dynamic_style .= '#wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wpsf-product-title a{
        color: ' . $product_name_typography['color'] . ';
        font-size: ' . $product_name_typography['font-size'] . 'px;
    }
    #wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wpsf-product-title a:hover{
        color: ' . $product_name_typography['hover_color'] . ';
    }';
}
if ( $product_price ) {
	$dynamic_style .= '#wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wpsf-product-price {
        color: ' . $product_price_typography['color'] . ';
        font-size: ' . $product_price_typography['font-size'] . ';
    }
    #wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wpsf-product-price del span {
        color: ' . $product_del_price_color . ';
    }';
}
if ( $product_rating ) {
	$dynamic_style .= '#wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wps-product-section .star-rating:before {
        color: ' . $product_rating_colors['color'] . ';
    }
    #wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wps-product-section .star-rating span:before{
        color: ' . $product_rating_colors['empty_color'] . ';
    }';
}
if ( $add_to_cart_button ) {
	$dynamic_style .= '#wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wpsf-cart-button a:not(.sp-wqvpro-view-button):not(.sp-wqv-view-button){
        color: ' . $add_to_cart_button_color['color'] . ';
        background-color: ' . $add_to_cart_button_color['background'] . ';
        border: ' . $add_to_cart_border['all'] . 'px ' . $add_to_cart_border['style'] . ' ' . $add_to_cart_border['color'] . ';
    }
    #wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wpsf-cart-button a:not(.sp-wqvpro-view-button):not(.sp-wqv-view-button):hover,
    #wps-slider-section #sp-woo-product-slider-' . $post_id . ' .wpsf-cart-button a.added_to_cart{
        color: ' . $add_to_cart_button_color['hover_color'] . ';
        background-color: ' . $add_to_cart_button_color['hover_background'] . ';
        border-color: ' . $add_to_cart_border['hover_color'] . ';
    }';
}
$dynamic_style .= '#wps-slider-section #sp-woo-product-slider-' . $post_id . '.sp-wps-theme_one .wps-product-image {
    border: ' . $product_image_border['all'] . 'px ' . $product_image_border['style'] . ' ' . $product_image_border['color'] . ';
}
#wps-slider-section #sp-woo-product-slider-' . $post_id . '.sp-wps-theme_one .wpsf-product:hover .wps-product-image {
    border-color: ' . $product_image_border['hover_color'] . ';
}';

$output .= '<style type="text/css">' . $dynamic_style . '</style>';
