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
function advanced_heading_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__ );

	$index_js = 'advanced-heading/index.js';
	wp_register_script(
		'advanced-heading-block-editor',
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
		'advanced-heading-block-css',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/advanced-heading/style.css',
		array(),
		ESSENTIAL_BLOCKS_VERSION
	);

	register_block_type( $dir . "/advanced-heading", array(
		'editor_script' => 'advanced-heading-block-editor',
		'editor_style'  => 'advanced-heading-block-css',
		'render_callback' => function( $attributes, $content ) {
			if( !is_admin() ) {
				wp_enqueue_style('advanced-heading-block-css');
				wp_enqueue_style(
					'eb-fontawesome-frontend',
					plugins_url('assets/css/font-awesome5.css', dirname(__FILE__)),
					array()
				);
			}
		  	return $content;
	  	}
	) );
}
add_action( 'init', 'advanced_heading_block_init' );
