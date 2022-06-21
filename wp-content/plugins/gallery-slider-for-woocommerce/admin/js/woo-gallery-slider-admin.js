jQuery(document).ready(function( $ ) {
	'use strict';
	$(document).ready(function() {
		$('.wcgs-settings').removeClass('wcgs-preloader');
	});
	/*
	* Upload image(s) event
	*/
	$(document).on('click', '.wcgs-upload-image', function(e){
		e.preventDefault();
		var wcgsAttachment = $(this).parents('.woocommerce_variable_attributes').find('.wcgs-gallery').val();
		if( wcgsAttachment === '' ) {
			var wcgsAttachmentArr = [];
		} else {
			var wcgsAttachmentArr = JSON.parse(wcgsAttachment);
		}

		var variationID = $(this).parents('.woocommerce_variation').find('h3 strong').text();
		var wcgsGalleryUploader;
		wcgsGalleryUploader = wp.media({
			library: {
				type: 'image'
			},
			frame: 'post',
			state: 'gallery',
			multiple: true
		});
		wcgsGalleryUploader.open();

		wcgsGalleryUploader.on('update', function(selection) {
			selection.models.map(function(attachment) {
				var item  = attachment.toJSON();
				wcgsAttachmentArr.push(attachment.id);
				if( 2 >= wcgsAttachmentArr.length ) {
					$('.wcgs-gallery-items'+variationID).append('<div class="wcgs-image" data-attachmentid="'+ item.id +'"><img src="' + item.sizes.thumbnail.url + '" style="max-width:100%;display:inline-block;" /><div class="wcgs-image-remover"><span class="dashicons dashicons-no"></span></div></div>');
				}
				$('.wcgs-gallery-items'+variationID).parents('.woocommerce_variable_attributes').find('.wcgs-gallery').val(JSON.stringify(wcgsAttachmentArr)).trigger('change');
			});
			if( wcgsAttachmentArr.length > 0 ) {
				$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-upload-image').hide();
				$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-edit').show();
				$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-remove-all-images').show();
				$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-upload-more-image').show();
			}
			if( wcgsAttachmentArr.length > 2 ) {
				$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-pro-notice').show();
			}
		})
	});

	/*
	* Add more image event
	*/
	$(document).on('click', '.wcgs-upload-more-image', function(e) {
		e.preventDefault();
		var variationID = $(this).parents('.woocommerce_variation').find('h3 strong').text();
		var wcgsAttachment = $(this).parents('.woocommerce_variable_attributes').find('.wcgs-gallery').val();
		var wcgsAttachmentArr = JSON.parse(wcgsAttachment);
		window.wp.media.gallery.edit('[gallery ids="'+wcgsAttachmentArr+'"]').on('update', function(selection){
			var wcgsAttachmentArr = [];
			$('.wcgs-gallery-items'+variationID).empty();
			selection.models.map(function(attachment) {
				var item  = attachment.toJSON();
				wcgsAttachmentArr.push(attachment.id);
				if( 2 >= wcgsAttachmentArr.length ) {
					$('.wcgs-gallery-items'+variationID).append('<div class="wcgs-image" data-attachmentid="'+ item.id +'"><img src="' + item.sizes.thumbnail.url + '" style="max-width:100%;display:inline-block;" /><div class="wcgs-image-remover"><span class="dashicons dashicons-no"></span></div></div>');
				}
				$('.wcgs-gallery-items'+variationID).parents('.woocommerce_variable_attributes').find('.wcgs-gallery').val(JSON.stringify(wcgsAttachmentArr)).trigger('change');
			});
			if( wcgsAttachmentArr.length > 0 ) {
				$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-upload-image').hide();
				$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-edit').show();
				$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-remove-all-images').show();
				$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-upload-more-image').show();
			}
			if( wcgsAttachmentArr.length > 2 ) {
				$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-pro-notice').show();
			}
		});
		$(document).find(".media-menu-item:contains('Add to Gallery')").click();
	})

	/*
	 * Remove image event
	 */
	$(document).on('click', '.wcgs-remove-all-images', function(e){
		e.preventDefault();
		var variationID = $(this).parents('.woocommerce_variation').find('h3 strong').text();
		$('.wcgs-gallery-items'+variationID+' .wcgs-image').remove();
		var wcgsAttachmentArr = [];
		$('.wcgs-gallery-items'+variationID).parents('.woocommerce_variable_attributes').find('.wcgs-gallery').val(JSON.stringify(wcgsAttachmentArr)).trigger('change');
		$(this).hide();
		$(this).siblings('.wcgs-upload-more-image').hide();
		$(this).siblings('.wcgs-edit').hide();
		$(this).siblings('.wcgs-upload-image').show();
		$(this).siblings('.wcgs-pro-notice').hide();
	});

	// Single remover
	$(document).on('click', '.wcgs-image-remover', function(e) {
		e.preventDefault();
		var variationID = $(this).parents('.woocommerce_variation').find('h3 strong').text();
		var attachmentID = $(this).parent('.wcgs-image').data("attachmentid");
		var wcgsAttachment = $(this).parents('.woocommerce_variable_attributes').find('.wcgs-gallery').val();
		var wcgsAttachmentArr = JSON.parse(wcgsAttachment);
		var index = wcgsAttachmentArr.indexOf(parseInt(attachmentID));
		if( index > -1 ) {
			wcgsAttachmentArr.splice(index, 1);
			$(this).parent('.wcgs-image').remove();
			$('.wcgs-gallery-items'+variationID).parents('.woocommerce_variable_attributes').find('.wcgs-gallery').val(JSON.stringify(wcgsAttachmentArr)).trigger('change');
		}

		if( wcgsAttachmentArr.length == 0 ) {
			$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-upload-image').show();
			$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-edit').hide();
			$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-remove-all-images').hide();
			$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-upload-more-image').hide();
		}
		if( wcgsAttachmentArr.length > 2 ) {
			$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-pro-notice').show();
		}
	});

	/*
	* Edit gallery event
	*/
	$(document).on('click', '.wcgs-edit', function(e) {
		e.preventDefault();
		var variationID = $(this).parents('.woocommerce_variation').find('h3 strong').text();
		var wcgsAttachment = $(this).parents('.woocommerce_variable_attributes').find('.wcgs-gallery').val();
		var wcgsAttachmentArr = JSON.parse(wcgsAttachment);
		window.wp.media.gallery.edit('[gallery ids="'+wcgsAttachmentArr+'"]').on('update', function(selection) {
			var wcgsAttachmentArr = [];
			$('.wcgs-gallery-items'+variationID).empty();
			selection.models.map(function(attachment) {
				var item  = attachment.toJSON();
				wcgsAttachmentArr.push(attachment.id);
				if( 2 >= wcgsAttachmentArr.length ) {
					$('.wcgs-gallery-items'+variationID).append('<div class="wcgs-image" data-attachmentid="'+ item.id +'"><img src="' + item.sizes.thumbnail.url + '" style="max-width:100%;display:inline-block;" /><div class="wcgs-image-remover"><span class="dashicons dashicons-no"></span></div></div>');
				}
				$('.wcgs-gallery-items'+variationID).parents('.woocommerce_variable_attributes').find('.wcgs-gallery').val(JSON.stringify(wcgsAttachmentArr)).trigger('change');
			});
			if( wcgsAttachmentArr.length > 0 ) {
				$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-upload-image').hide();
				$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-edit').show();
				$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-remove-all-images').show();
				$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-upload-more-image').show();
			}
			if( wcgsAttachmentArr.length > 2 ) {
				$('.wcgs-gallery-items'+variationID).next('p').find('.wcgs-pro-notice').show();
			}
		});
	});

	// Variation gallery show under variation image
	$(document).on('click', '.woocommerce_variation', function() {
		// console.log('clicked');
		var galleryHTML = $(this).find('.wcgs-variation-gallery');
		// console.log(galleryHTML);
		$(this).find('.form-row.form-row-full.options').before($(galleryHTML));
		// $(this).find('.wcgs-variation-gallery').after('<p>Hello</p>');
		// $('.wcgs-variation-gallery')
	});

});