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
function pricing_table_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__ );

	$index_js = 'pricing-table/index.js';
	wp_register_script(
		'pricing-table-block-editor',
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
		'pricing-table-block-style',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/pricing-table/style.css',
		array(),
		ESSENTIAL_BLOCKS_VERSION
	);

	register_block_type( $dir . "/pricing-table", array(
		'editor_script' => 'pricing-table-block-editor',
		'editor_style'  => 'pricing-table-block-style',
		'render_callback' => function( $attributes, $content ) {
			if( !is_admin() ) {
				wp_enqueue_style('pricing-table-block-style');
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
add_action( 'init', 'pricing_table_block_init' );
