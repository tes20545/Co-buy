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
function row_block_init()
{
	// Skip block registration if Gutenberg is not enabled/merged.
	if (!function_exists('register_block_type')) {
		return;
	}
	$dir = dirname(__FILE__);

	$index_js = 'row/index.js';
	wp_register_script(
		'row-block-editor',
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


	// 
	$style_css = 'row/style.css';
	wp_register_style(
		'row-block-style',
		plugins_url($style_css, __FILE__),
		array(),
		filemtime($dir . "/" . $style_css)
	);


	// 
	register_block_type($dir . "/row", array(
		'editor_script' => 'row-block-editor',
		'render_callback' => function ($attributes, $content) {
			if (!is_admin()) {
				wp_enqueue_style('row-block-style');
			}
			return $content;
		}
	));
}
add_action('init', 'row_block_init');
