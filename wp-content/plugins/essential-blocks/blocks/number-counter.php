<?php

/**
 * Registers all block assets so that they can be enqueued through the block editor
 * in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */


function counter_block_init()
{
	// Skip block registration if Gutenberg is not enabled/merged.
	if (!function_exists('register_block_type')) {
		return;
	}
	$dir = dirname(__FILE__);

	$index_js = 'number-counter/index.js';
	wp_register_script(
		'number-counter-block-editor',
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

	/* Frontend Script */
	wp_register_script(
		'essential-blocks-number-counter-frontend',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/number-counter/frontend/index.js',
		array(),
		ESSENTIAL_BLOCKS_VERSION,
		true
	);

	register_block_type(
		$dir . "/number-counter",
		array(
			'editor_script' => 'number-counter-block-editor',
			'render_callback' => function ($attributes, $content) {
				if (!is_admin()) {
					wp_enqueue_script('essential-blocks-number-counter-frontend');
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
add_action('init', 'counter_block_init');
