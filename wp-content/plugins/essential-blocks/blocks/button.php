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
function button_block_init()
{
	// Skip block registration if Gutenberg is not enabled/merged.
	if (!function_exists('register_block_type')) {
		return;
	}
	$dir = dirname(__FILE__);

	$index_js = 'button/index.js';
	wp_register_script(
		'button-block-editor',
		plugins_url($index_js, __FILE__),
		array(
			// 'wp-blocks',
			// 'wp-i18n',
			// 'wp-element',
			// 'wp-editor',
			// 'wp-block-editor',
			'essential-blocks-controls-util'
		),
		filemtime($dir. "/" . $index_js)
	);

	/* Common Styles */
	wp_register_style(
		'button-block-style',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/button/style.css',
		array(),
		ESSENTIAL_BLOCKS_VERSION
	);

	wp_register_style(
		'essential-blocks-hover',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/css/hover-min.css',
		array(),
		ESSENTIAL_BLOCKS_VERSION
	);

	register_block_type($dir . "/button", array(
		'editor_script' => 'button-block-editor',
		'editor_style'  => 'button-block-style',
		'render_callback' => function ($attributes, $content) {
			if (!is_admin()) {
				wp_enqueue_style('button-block-style');
				wp_enqueue_style('essential-blocks-hover');
				wp_enqueue_style(
					'eb-fontawesome-frontend',
					plugins_url('assets/css/font-awesome5.css', dirname(__FILE__)),
					array()
				);
			}
			return $content;
		}
	));
}
add_action('init', 'button_block_init');
