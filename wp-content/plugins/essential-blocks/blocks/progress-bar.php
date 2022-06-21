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
function progress_bar_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__ );

	$index_js = 'progress-bar/index.js';
	wp_register_script(
		'progress-bar-block-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			// 'wp-blocks',
			// 'wp-i18n',
			// 'wp-element',
			// 'wp-editor',
			// 'wp-block-editor',
			'essential-blocks-controls-util'
		),
		filemtime( $dir . "/" . $index_js)
	);

	/* Common Styles */
	wp_register_style(
		'progress-bar-block-style',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/progress-bar/style.css',
		array(),
		ESSENTIAL_BLOCKS_VERSION
	);

	/* Frontend Script */
	wp_register_script(
		'essential-blocks-progress-bar-js',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/progress-bar/assets/js/progress-bars.js',
		array( ),
		ESSENTIAL_BLOCKS_VERSION,
		true
	);

	register_block_type($dir . "/progress-bar", array(
		'editor_script' => 'progress-bar-block-editor',
		'editor_style'  => 'progress-bar-block-style',
		'render_callback' => function( $attribs, $content ) {
			if( !is_admin() ) {
			  wp_enqueue_script( 'essential-blocks-progress-bar-js' );
			  wp_enqueue_style( 'progress-bar-block-style' );
			}
			return $content;
	  	}
	) );
}
add_action( 'init', 'progress_bar_block_init' );
