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
function image_gallery_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__ );

	$index_js = 'image-gallery/index.js';
	wp_register_script(
		'image-gallery-block-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			// 'wp-blocks',
			// 'wp-i18n',
			// 'wp-element',
			// 'wp-editor',
			// 'wp-block-editor',
			'essential-blocks-controls-util'
		),
		filemtime( $dir . "/" . $index_js )
	);

	/* Common Styles */
	wp_register_style(
		'image-gallery-block-style',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/image-gallery/style.css',
		array(),
		ESSENTIAL_BLOCKS_VERSION
	);

	register_block_type($dir . "/image-gallery", array(
		'editor_script' => 'image-gallery-block-editor',
		'editor_style'  => 'image-gallery-block-style',
		'render_callback' => function( $attributes, $content ) {
			if( !is_admin() ) {
				$disableLightBox = false;
				if (isset($attributes["disableLightBox"]) && $attributes["disableLightBox"] == true) {
					$disableLightBox = true;
				}

				wp_enqueue_style('image-gallery-block-style');
				//Load Lighbox Resource if Lightbox isn't disbaled
				if (!$disableLightBox) {
					wp_enqueue_style(
						'fslightbox-style',
						plugins_url('assets/css/fslightbox.min.css', dirname(__FILE__)),
						array()
					);
	
					wp_enqueue_script(
						'fslightbox-js',
						plugins_url("assets/js/fslightbox.min.js", dirname(__FILE__)),
						array('jquery'),
						true,
						true
					);
				}
				
			}
		  	return $content;
	  	}
	) );
}
add_action( 'init', 'image_gallery_block_init' );
