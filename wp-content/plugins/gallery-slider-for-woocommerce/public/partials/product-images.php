<?php
/**
 * The product images.
 *
 * @package    Woo_Gallery_Slider
 * @subpackage Woo_Gallery_Slider/public
 */

global $product;
$settings   = get_option( 'wcgs_settings' );
$gallery    = array();
$product_id = $product->get_id();


$product_type          = $product->get_type();
$include_feature_image = isset( $settings['include_feature_image_to_gallery'] ) ? $settings['include_feature_image_to_gallery'] : array( 'default_gl' );
$slider_dir            = ( isset( $settings['slider_dir'] ) && $settings['slider_dir'] ) ? $settings['slider_dir'] : '';
$slider_dir_rtl        = $slider_dir ? 'dir=rtl' : '';

if ( empty( $include_feature_image ) ) {
	$include_feature_image = array();
}
$slug_attr         = apply_filters( 'sp_woo_gallery_slider_use_slug_attr', true );
$default_variation = $product->get_default_attributes();
if ( 'variable' === $product_type && $slug_attr ) {
	$product_attributes = $product->get_attributes();
	$selected_keys      = array();
	foreach ( $product_attributes as $attribute_name => $options ) {
		$selected_key = 'attribute_' . sanitize_title( $attribute_name );

		if ( isset( $_REQUEST[ $selected_key ] ) ) {
			// phpcs:disable WordPress.Security.NonceVerification.Recommended
			$selected_keys[ $attribute_name ] = wc_clean( wp_unslash( $_REQUEST[ $selected_key ] ) );
			// phpcs:enable WordPress.Security.NonceVerification.Recommended
		}
	}
	if ( ! empty( $selected_keys ) ) {
		$default_variation = $selected_keys;
	}
}
if ( ! empty( $default_variation ) ) {
	$image_id = $product->get_image_id();
	if ( is_array( $include_feature_image ) && in_array( 'variable_gl', $include_feature_image, true ) && $image_id ) {
		array_push( $gallery, wcgs_image_meta( $image_id ) );
	}
	$_temp_variations = array();
	foreach ( $default_variation as $key => $value ) {
		$_temp_variations[ 'attribute_' . $key ] = $value;
	}

	$data_store = WC_Data_Store::load( 'product' );

	$variations = $data_store->find_matching_product_variation( $product, $_temp_variations );
	$image_id   = get_post_thumbnail_id( $variations );
	array_push( $gallery, wcgs_image_meta( $image_id ) );

	$woo_gallery_slider = get_post_meta( $variations, 'woo_gallery_slider', true );
	$gallery_arr        = substr( $woo_gallery_slider, 1, -1 );
	$gallery_multiple   = strpos( $gallery_arr, ',' ) ? true : false;
	if ( $gallery_multiple ) {
		$gallery_array = explode( ',', $gallery_arr );
		foreach ( $gallery_array as $gallery_item ) {
			array_push( $gallery, wcgs_image_meta( $gallery_item ) );
		}
	} else {
		$gallery_array = $gallery_arr;
		if ( $gallery_array ) {
			array_push( $gallery, wcgs_image_meta( $gallery_array ) );
		}
	}
} else {
	$image_id = $product->get_image_id();

	if ( is_array( $include_feature_image ) && in_array( 'default_gl', $include_feature_image, true ) && $image_id ) {
		array_push( $gallery, wcgs_image_meta( $image_id ) );
	}
	$gallery_image_source = isset( $settings['gallery_image_source'] ) ? $settings['gallery_image_source'] : 'uploaded';
	if ( 'attached' === $gallery_image_source ) {
		$wgsc_post           = get_post( $product_id );
		$wcgs_post_content   = $wgsc_post->post_content;
		$wcgs_search_pattern = '~<img [^\>]*\ />~';
		preg_match_all( $wcgs_search_pattern, $wcgs_post_content, $post_images );
		$wcgs_number_of_images = count( $post_images[0] );
		if ( $wcgs_number_of_images > 0 ) {
			foreach ( $post_images[0] as $image ) {
				$class_start     = substr( $image, strpos( $image, 'class="' ) + 7 );
				$class_end       = substr( $class_start, 0, strpos( $class_start, '" ' ) );
				$image_class_pos = strpos( $class_end, 'wp-image-' );
				$image_class_tmp = substr( $class_end, $image_class_pos + 9 );
				array_push(
					$gallery,
					wcgs_image_meta( $image_class_tmp )
				);
			}
		}
	} else {
		$attachment_ids = $product->get_gallery_image_ids();
		foreach ( $attachment_ids as $attachment_id ) {
			array_push(
				$gallery,
				wcgs_image_meta( $attachment_id )
			);
		}
	}
	if ( empty( $gallery ) ) {
		array_push( $gallery, wcgs_image_meta( $image_id ) );
	}
}

?>
<div id="wpgs-gallery" <?php echo esc_attr( $slider_dir_rtl ); ?> class="woocommerce-product-gallery horizontal" style='min-width: <?php echo esc_attr( $settings['gallery_width'] ); ?>%;' data-id="<?php echo esc_attr( $product_id ); ?>">
	<div class="gallery-navigation-carousel horizontal always">
		<?php
		foreach ( $gallery as $slide ) {
			if ( isset( $slide['full_url'] ) && ! empty( $slide['full_url'] ) ) {
				?>
			<div class="wcgs-thumb">
				<img alt="<?php echo esc_html( $slide['cap'] ); ?>" src="<?php echo esc_url( $slide['thumb_url'] ); ?>" data-image="<?php echo esc_url( $slide['full_url'] ); ?>" width="<?php echo esc_attr( $slide['thumbWidth'] ); ?>" height="<?php echo esc_attr( $slide['thumbHeight'] ); ?>" />
			</div>
				<?php
			}
		}
		?>
	</div>
	<div class="wcgs-carousel horizontal">
			<?php
			foreach ( $gallery as $slide ) {
				if ( isset( $slide['full_url'] ) && ! empty( $slide['full_url'] ) ) {
					?>
					<a class="wcgs-slider-image" data-fancybox="view" href="<?php echo esc_url( $slide['full_url'] ); ?>">
						<img alt="<?php echo esc_html( $slide['cap'] ); ?>" src="<?php echo esc_url( $slide['url'] ); ?>" data-image="<?php echo esc_url( $slide['full_url'] ); ?>" width="<?php echo esc_attr( $slide['imageWidth'] ); ?>" height="<?php echo esc_attr( $slide['imageHeight'] ); ?>"  />
					</a>
					<?php
				}
			}
			?>
	</div>
	<?php
	if ( $settings['preloader'] ) {
		?>
	<div class="wcgs-gallery-preloader" style="opacity: 1; z-index: 9999;"></div>
	<?php } ?>
</div>
<?php
