<?php

/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package essential-blocks
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function slider_block_init()
{
	// Skip block registration if Gutenberg is not enabled/merged.
	if (!function_exists('register_block_type')) {
		return;
	}
	$dir = dirname(__FILE__);

	$index_js = 'slider/index.js';
	wp_register_script(
		'slider-block-editor',
		plugins_url($index_js, __FILE__),
		array(
			// 'wp-blocks',
			// 'wp-i18n',
			// 'wp-element',
			// 'wp-editor',
			// 'wp-block-editor',
			'essential-blocks-controls-util'
		),
		filemtime($dir . "/" . $index_js)
	);

	/* Common Styles */
	wp_register_style(
		'slider-block-style',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/slider/style.css',
		array(),
		ESSENTIAL_BLOCKS_VERSION
	);

	/* Frontend Script */
	wp_register_script(
		'essential-blocks-slider-frontend',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/slider/frontend/index.js',
		array("wp-element"),
		ESSENTIAL_BLOCKS_VERSION,
		true
	);

	register_block_type($dir . "/slider", array(
		'editor_script' => 'slider-block-editor',
		'editor_style'  => 'slider-block-style',
		'render_callback' => function ($attributes, $content) {
			if (!is_admin()) {
				wp_enqueue_script('essential-blocks-slider-frontend');
				wp_enqueue_style('slider-block-style');
				wp_enqueue_style(
					'slick-style',
					plugins_url('assets/css/slick.css', dirname(__FILE__)),
					array(),
					ESSENTIAL_BLOCKS_VERSION
				);

				wp_enqueue_script(
					'essential-blocks-slickjs',
					plugins_url("assets/js/slick.min.js", dirname(__FILE__)),
					array("jquery"),
					ESSENTIAL_BLOCKS_VERSION,
					true
				);
			}
			return $content;
		}
	));
}
add_action('init', 'slider_block_init');
