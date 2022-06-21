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
function accordion_block_init()
{
	// Skip block registration if Gutenberg is not enabled/merged.
	if (!function_exists('register_block_type')) {
		return;
	}
	$dir = dirname(__FILE__);

	//  Common Styles
	$styleCss = 'accordion/style.css';
	wp_register_style(
		'accordion-block-style',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/accordion/style.css',
		array(),
		filemtime($dir . "/" . $styleCss)
	);

	//  Frontend Script
	$frontEnd_js = 'accordion/frontend/index.js';
	wp_register_script(
		'essential-blocks-accordion-frontend',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/accordion/frontend/index.js',
		array(),
		filemtime($dir . "/" . $frontEnd_js),
		true
	);

	$index_js = 'accordion/index.js';
	wp_register_script(
		'accordion-block-editor',
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

	register_block_type(
		$dir . "/accordion",
		array(
			'editor_script' 	=> 'accordion-block-editor',
			'editor_style'    	=> 'accordion-block-style',
			'render_callback' => function ($attributes, $content) {
				if (!is_admin()) {
					wp_enqueue_script('essential-blocks-accordion-frontend');
					wp_enqueue_style('accordion-block-style');
					wp_enqueue_style(
						'eb-fontawesome-frontend',
						plugins_url('assets/css/font-awesome5.css', dirname(__FILE__)),
						array()
					);
				}
				return $content;
			}
		)
	);
}
add_action('init', 'accordion_block_init');
