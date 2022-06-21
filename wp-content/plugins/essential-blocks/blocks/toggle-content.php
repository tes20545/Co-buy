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
function toggle_content_block_init()
{
	// Skip block registration if Gutenberg is not enabled/merged.
	if (!function_exists('register_block_type')) {
		return;
	}
	$dir = dirname(__FILE__);

	$index_js = 'toggle-content/index.js';
	wp_register_script(
		'toggle-content-block-editor',
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
	$style_css = 'toggle-content/style.css';
	wp_register_style(
		'toggle-content-block-style',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/toggle-content/style.css',
		array(),
		filemtime($dir . "/" . $style_css)
	);

	/* Frontend Script */
	$frontEnd_js = 'toggle-content/frontend/index.js';
	wp_register_script(
		'essential-blocks-toggle-content-frontend',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/toggle-content/frontend/index.js',
		array(),
		filemtime($dir . "/" . $frontEnd_js),
		true
	);

	register_block_type($dir . "/toggle-content", array(
		'editor_script' => 'toggle-content-block-editor',
		'editor_style'  => 'toggle-content-block-style',
		'render_callback' => function ($attributes, $content) {
			if (!is_admin()) {
				wp_enqueue_script('essential-blocks-toggle-content-frontend');
				wp_enqueue_style('toggle-content-block-style');
			}
			return $content;
		}
	));
}
add_action('init', 'toggle_content_block_init');
