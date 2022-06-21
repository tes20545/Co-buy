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
function instagram_feed_block_init()
{
  // Skip block registration if Gutenberg is not enabled/merged.
  if (!function_exists('register_block_type')) {
    return;
  }
  $dir = dirname(__FILE__);

  $index_js = 'instagram-feed/index.js';
  wp_register_script(
    'instagram-feed-block-editor',
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
    'instagram-feed-block-style',
    ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/instagram-feed/style.css',
    array(),
    filemtime(ESSENTIAL_BLOCKS_DIR_PATH . 'blocks/instagram-feed/style.css')
  );

  // isotope
  wp_register_script(
    'essential-blocks-isotope',
    ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/js/isotope.pkgd.min.js',
    array(),
    filemtime(ESSENTIAL_BLOCKS_DIR_PATH . 'assets/js/isotope.pkgd.min.js'),
    true
  );

  // imageloaded
  wp_register_script(
    'essential-blocks-image-loaded',
    ESSENTIAL_BLOCKS_ADMIN_URL . 'assets/js/images-loaded.min.js',
    array(),
    filemtime(ESSENTIAL_BLOCKS_DIR_PATH . 'assets/js/images-loaded.min.js'),
    true
  );
  // eb-instagram js
  $eb_instagram_js = "instagram-feed/assets/js/eb-instagram.js";
  wp_register_script(
    'essential-blocks-instagram-feed-block-script',
    plugins_url($eb_instagram_js, __FILE__),
    array(
      'essential-blocks-isotope',
      'essential-blocks-image-loaded',
    ),
    filemtime($dir . "/" . $eb_instagram_js)
  );

  register_block_type(
    $dir . "/instagram-feed",
    array(
      'editor_script' => 'instagram-feed-block-editor',
      'editor_style'  => 'instagram-feed-block-style',
      'render_callback' => 'essential_blocks_instagram_render_callback',
      'attributes' => array(
        'blockId' => array(
          'type' => "string",
        ),
        'layout' => array(
          'type' => "string",
          'default' => "overlay",
        ),
        'overlayStyle' => array(
          'type' => "string",
          'default' => "overlay__simple",
        ),
        'cardStyle' => array(
          'type' => "string",
          'default' => "content__outter",
        ),
        'token' => array(
          'type' => 'string',
          'default' => '',
        ),
        'columns' => array(
          'type' => 'number',
          'default' => "4",
        ),
        'numberOfImages' => array(
          'type' => 'number',
          'default' => 6,
        ),
        'thumbs' => array(
          'type' => 'array',
          'default' => [],
        ),
        'hasEqualImages' => array(
          'type' => 'boolean',
          'default' => true,
        ),
        'showCaptions' => array(
          'type' => 'boolean',
          'default' => true,
        ),
        'showProfileName' => array(
          'type' => 'boolean',
          'default' => true,
        ),
        'showProfileImg' => array(
          'type' => 'boolean',
          'default' => true,
        ),
        'profileImg' => array(
          'type' => 'string',
        ),
        'profileName' => array(
          'type' => 'string',
        ),
        'showMeta' => array(
          'type' => 'boolean',
          'default' => true,
        ),
        'enableLink' => array(
          'type' => 'boolean',
          'default' => false,
        ),
        'openInNewTab' => array(
          'type' => 'boolean',
          'default' => false,
        ),
        'sortBy' => array(
          'type' => "string",
          'default' => "most_recent",
        ),
      ),
    )
  );
}
add_action('init', 'instagram_feed_block_init');
