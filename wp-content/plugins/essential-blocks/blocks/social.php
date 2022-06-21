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
function social_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__ );

	$index_js = 'social/index.js';
	wp_register_script(
		'social-block-editor',
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
	$index_css = 'social/style.css';
	wp_register_style(
		'social-block-style',
		plugins_url( $index_css, __FILE__ ),
		array(),
		filemtime( $dir . "/" . $index_css)
	);

	register_block_type($dir . "/social", array(
		'editor_script' => 'social-block-editor',
		'editor_style' => 'social-block-style',
		'render_callback' => function( $attributes, $content ) {
			if( !is_admin() ) {
				wp_enqueue_style('social-block-style');
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
	) );
}
add_action( 'init', 'social_block_init' );
