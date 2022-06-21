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
function infobox_block_init()
{
	// Skip block registration if Gutenberg is not enabled/merged.
	if (!function_exists('register_block_type')) {
		return;
	}
	$dir = dirname(__FILE__);

	$index_js = 'infobox/index.js';
	wp_register_script(
		'infobox-block-editor',
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
	$style_css = 'infobox/style.css';
	wp_register_style(
		'infobox-block-style',
		plugins_url($style_css, __FILE__),
		array(),
		filemtime($dir . "/" . $style_css)
	);

	register_block_type($dir . "/infobox", array(
		'editor_script' => 'infobox-block-editor',
		'editor_style'  => 'infobox-block-style',
		'render_callback' => function ($attributes, $content) {
			if (!is_admin()) {
				wp_enqueue_style('infobox-block-style');
				wp_enqueue_style(
					'eb-fontawesome-frontend',
					plugins_url('assets/css/font-awesome5.css', dirname(__FILE__)),
					array()
				);

				wp_enqueue_style(
					'essential-blocks-hover-css',
					plugins_url('assets/css/hover-min.css', dirname(__FILE__)),
					array()
				);
			}
			return $content;
		}
	));
}
add_action('init', 'infobox_block_init');
