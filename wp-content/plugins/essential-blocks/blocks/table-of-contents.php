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
function table_of_contents_block_init()
{
	// Skip block registration if Gutenberg is not enabled/merged.
	if (!function_exists('register_block_type')) {
		return;
	}
	$dir = dirname(__FILE__);

	$index_js = 'table-of-contents/index.js';
	wp_register_script(
		'table-of-contents-block-editor',
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

	/* style.css */
	$style_css = 'table-of-contents/style.css';
	wp_register_style(
		'essential-blocks-table-of-contents-block-style',
		plugins_url($style_css, __FILE__),
		array(),
		filemtime($dir . "/" . $style_css)
	);

	/* Frontend Script */
	$frontEnd_js = 'table-of-contents/frontend/index.js';
	wp_register_script(
		'essential-blocks-table-of-contents-block-frontend',
		plugins_url($frontEnd_js, __FILE__),
		array(),
		filemtime($dir . "/" . $frontEnd_js),
		true
	);

	register_block_type($dir . "/table-of-contents", array(
		'editor_script' => 'table-of-contents-block-editor',
		// 'style' 		=> 'essential-blocks-table-of-contents-block-style',
		'editor_style' 	=> 'essential-blocks-table-of-contents-block-style',

		// 
		// for some reason render_callback is not working :( 
		// this same thing happened in the 'toggle-content' in separate block
		// 

		'render_callback' => function ($attributes, $content) {
			if (!is_admin()) {
				// die("died here inside render callback");
				wp_enqueue_script('essential-blocks-table-of-contents-block-frontend');
				wp_enqueue_style('essential-blocks-table-of-contents-block-style');
			}
			return $content;
		}
	));
}
add_action('init', 'table_of_contents_block_init');
