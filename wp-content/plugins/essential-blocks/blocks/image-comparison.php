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
function image_comparison_block_init()
{
	// Skip block registration if Gutenberg is not enabled/merged.
	if (!function_exists('register_block_type')) {
		return;
	}
	$dir = dirname(__FILE__);

	$index_js = 'image-comparison/index.js';
	wp_register_script(
		'image-comparison-block-editor',
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

	/*$editor_css = 'image-comparison/editor.css';
	wp_register_style(
		'image-comparison-block-editor',
		plugins_url($editor_css, __FILE__),
		array(),
		filemtime($dir . "/" . $editor_css)
	);*/

	/*$style_css = 'image-comparison/style.css';
	wp_register_style(
		'image-comparison-block',
		plugins_url($style_css, __FILE__),
		array(),
		filemtime($dir . "/" .$style_css)
	);*/

	$frontend_js = 'image-comparison/frontend/index.js';
	wp_register_script(
		'essential-blocks-image-comparison-frontend',
		plugins_url($frontend_js, __FILE__),
		array("wp-element"),
		true
	);

	register_block_type($dir . "/image-comparison", array(
		'editor_script' => 'image-comparison-block-editor',
		'render_callback' => function ($attributes, $content) {
			if (!is_admin()) {
				wp_enqueue_script('essential-blocks-image-comparison-frontend');
			}
			return $content;
		}

	));
}
add_action('init', 'image_comparison_block_init');
