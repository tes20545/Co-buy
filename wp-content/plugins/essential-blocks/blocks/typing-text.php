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
function typing_text_block_init()
{
	// Skip block registration if Gutenberg is not enabled/merged.
	if (!function_exists('register_block_type')) {
		return;
	}
	$dir = dirname(__FILE__);

	$index_js = 'typing-text/index.js';
	wp_register_script(
		'typing-text-block-editor',
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
		'typing-text-block-style',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/typing-text/style.css',
		array(),
		ESSENTIAL_BLOCKS_VERSION
	);

	/* Frontend Script */
	wp_register_script(
		'essential-blocks-typing-text-frontend',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/typing-text/frontend.js',
		array('jquery'),
		ESSENTIAL_BLOCKS_VERSION,
		true
	);

	register_block_type($dir . "/typing-text", array(
		'editor_script' => 'typing-text-block-editor',
		'editor_style'  => 'typing-text-block-style',
		'render_callback' => function ($attributes, $content) {
			if (!is_admin()) {
				wp_enqueue_script('essential-blocks-typing-text-frontend');
				wp_enqueue_style('typing-text-block-style');
				wp_enqueue_script(
					'essential-blocks-typedjs',
					plugins_url("assets/js/typed.min.js", dirname(__FILE__)),
					array("jquery"),
					true
				);
			}
			return $content;
		}
	));
}
add_action('init', 'typing_text_block_init');
