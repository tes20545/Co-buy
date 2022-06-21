; (function ($) {
	'use strict';
	jQuery(function () {

		// Fn to allow an event to fire after all images are loaded
		$.fn.wpgspimagesLoaded = function () {

			// get all the images (excluding those with no src attribute)
			var $imgs = this.find('img[src!=""]');
			// if there's no images, just return an already resolved promise
			if (!$imgs.length) { return $.Deferred().resolve().promise(); }

			// for each image, add a deferred object to the array which resolves when the image is loaded (or if loading fails)
			var dfds = [];
			$imgs.each(function () {

				var dfd = $.Deferred();
				dfds.push(dfd);
				var img = new Image();
				img.onload = function () { dfd.resolve(); }
				img.onerror = function () { dfd.resolve(); }
				img.src = this.src;

			});

			// return a master promise object which will resolve when all the deferred objects have resolved
			// IE - when all the images are loaded
			return $.when.apply($, dfds);

		}
		// set all settings
		var settings = wcgs_ajax_object.wcgs_settings;
		function wcgs_slider_func(width) {
			var width_unit = settings.gallery_responsive_width.unit;
			$("#wpgs-gallery").css('minWidth', 'auto').css('maxWidth', width + width_unit);
			var wcgs_img_count = $("#wpgs-gallery").find('.gallery-navigation-carousel .wcgs-thumb').length;
			var thumbnails_item_to_show = parseInt(settings.thumbnails_item_to_show);
			var adaptive_height = (settings.adaptive_height == '1') ? true : false;
			var accessibility = (settings.accessibility == '1') ? true : false;
			var pagination = (settings.pagination == '1') ? true : false;
			var navigation = (settings.navigation == '1') ? true : false;
			var slider_dir = (settings.slider_dir == '1' || $('body').hasClass('rtl')) ? true : false;
			var infinite = (settings.infinite_loop == '1') ? true : false;
			var thumbnail_nav = (settings.thumbnailnavigation == 1) ? true : false;
			var slide_orientation = (settings.slide_orientation == 'vertical') ? true : false;
			// hide nav carousel if item is one!
			if (wcgs_img_count == 1) {
				$("#wpgs-gallery").find('.gallery-navigation-carousel').hide();
			} else {
				$("#wpgs-gallery").find('.gallery-navigation-carousel').show();
			}
			$('.wcgs-carousel').show();
			$('.wcgs-carousel').slick({
				slidesToShow: 1,
				infinite: infinite,
				accessibility: accessibility,
				autoplay: false,
				slidesToScroll: 1,
				speed: 300,
				rtl: (settings.slide_orientation != 'vertical') ? slider_dir : false,
				rows: 0,
				vertical: slide_orientation,
				adaptiveHeight: adaptive_height,
				arrows: navigation,
				fade: false,
				dots: pagination,
				focusOnSelect: true,
				asNavFor: '.gallery-navigation-carousel',
				prevArrow: '<a class="slick-arrow-prev" data-role="none" aria-label="Prev slide"></a>',
				nextArrow: '<a class="slick-arrow-next" data-role="none" aria-label="Next slide"></a>'
			});
			$('.gallery-navigation-carousel').slick({
				infinite: infinite,
				slidesToShow: thumbnails_item_to_show,
				slidesToScroll: 1,
				asNavFor: '.wcgs-carousel',
				vertical: false,
				verticalSwiping: false,
				centerMode: false,
				centerPadding: '0',
				rtl: (settings.slide_orientation != 'vertical') ? slider_dir : false,
				rows: 0,
				arrows: thumbnail_nav,
				focusOnSelect: true,
				prevArrow: '<a class="slick-nav-prev" data-role="none" aria-label="Prev slide"></a>',
				nextArrow: '<a class="slick-nav-next" data-role="none" aria-label="Next slide"></a>'
			});

			// Theme savoy.
			if ($('body').hasClass('theme-savoy')) {
				var slickArrow = ['.slick-nav-prev', '.slick-nav-next', '.slick-arrow-prev', '.slick-arrow-next'];
				$.each(slickArrow, function (i, item) {
					$('#wpgs-gallery ' + item).addClass('slick-arrow');
				})
			}

			if (settings.lightbox == '1') {
				if (!$('#wpgs-gallery .wcgs-carousel .wcgs-lightbox').length) {
					$('#wpgs-gallery .wcgs-carousel .wcgs-slider-image').append('<div class="wcgs-lightbox top_right"><a href="javascript:;"><span class="fa fa-search"></span></a></div>');
				}
			}
			var pagination_visibility = (settings.pagination_visibility == 'hover') ? true : false;
			if (pagination_visibility) {
				$("#wpgs-gallery .slick-dots").hide()
				$("#wpgs-gallery .wcgs-carousel").hover(function () {
					$("#wpgs-gallery .slick-dots").show()
				}, function () {
					$("#wpgs-gallery .slick-dots").hide()
				})
			}
			var isPreloader = (settings.preloader == 1) ? true : false;
			if (isPreloader) {
				if (!$('.wcgs-gallery-preloader').length) {
					$('#wpgs-gallery').append('<div class="wcgs-gallery-preloader"></div>');
				}
			}

		}
		$('#wpgs-gallery').wpgspimagesLoaded().then(function () {
			$(".wcgs-gallery-preloader").css("opacity", 0);
			$(".wcgs-gallery-preloader").css("z-index", -99);
		});
		// Add video icon on thumbnail.
		function videoIcon() {
			$('.wcgs-slider-image, .wcgs-thumb').each(function () {
				var icon = $(this).find('img').data('type');
				if (icon) {
					$(this).append('<div class="video-icon"></div>');
				}
			})
		}

		// Add data-scale and data-image attributes when hover on wrapper.
		function dataZoom() {
			$('.wcgs-slider-image').hover(function () {
				$(this).attr('data-scale', '1.5');
				var img = $(this).find('img').attr('src');
				$(this).attr('data-image', img);
			});
		}

		// Zoom function defines.
		function zoomFunction() {
			$('.wcgs-slider-image')
				.on('mouseover', function () {
					$(this).children('.photo').css({ 'transform': 'scale(' + $(this).attr('data-scale') + ')' });
				})
				.on('mouseout', function () {
					$(this).children('.photo').css({ 'transform': 'scale(1)' });
				})
				.on('mousemove', function (e) {
					$(this).children('.photo').css({ 'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 + '%' });
				})
				.each(function () {
					var photoLength = $(this).find('.photo').length;
					if (photoLength === 0) {
						$(this)
							.append('<div class="photo"></div>')
							.children('.photo').css({ 'background-image': 'url(' + $(this).find('img').attr('src') + ')' });
					}
				});
		}

		// Determine when zoomFunction apply.
		function zoomEffect() {
			if ($(window).width() < 480 && settings.mobile_zoom == 1) {
				return '';
			}
			$(document).on('click', '.wcgs-slider-image', function () {
				zoomFunction();
			});
			$('.wcgs-slider-image').mouseenter(function () {
				zoomFunction();
			});
			$('.wcgs-slider-image').mouseleave(function () {
				zoomFunction();
			});
		}

		// Add lightbox with gallery.
		function wcgsLightbox() {
			var lightbox = (settings.lightbox == 1) ? true : false;
			if (lightbox) {
				var gl_btns = [
					"zoom"
				];
				if (settings.gallery_fs_btn == 1) {
					gl_btns.push("fullScreen");
				}
				if (settings.gallery_share == 1) {
					gl_btns.push("share");
				}
				gl_btns.push("close");
				$.fancybox.defaults.buttons = gl_btns;
				var counter = (settings.l_img_counter == 1) ? true : false;
				$('.wcgs-carousel').fancybox({
					selector: '.wcgs-carousel .wcgs-slider-image:not(.slick-cloned)',
					backFocus: false,
					baseClass: "wcgs-fancybox-custom-wrapper",
					caption: function () {
						var caption = '';
						if (settings.lightbox_caption == 1) {
							caption = $(this).find('img').attr('alt') || '';
						}
						return caption;
					},
					infobar: counter,
					buttons: gl_btns,
					loop: true
				});
			} else {
				$('.wcgs-carousel .wcgs-slider-image').removeAttr("data-fancybox href");
			}
		}

		var gallery_width = settings.gallery_width;
		var woocommerce_single_product_width = $('.single-product .product').width();
		if ($('body').hasClass('theme-flatsome')) {
			var woocommerce_single_product_width = $('.single-product .product .row.content-row').width();
		}

		var gallery_w = ((gallery_width * woocommerce_single_product_width) / 100) - 50;
		var summary_w = ((100 - gallery_width) * woocommerce_single_product_width) / 100;

		if ($(window).width() > 992) {
			$('.summary').css('maxWidth', summary_w);
		}
		if ($(window).width() < 992) {
			if (settings.gallery_responsive_width.width > 0) {
				gallery_w = settings.gallery_responsive_width.width;
			}
		}
		if ($(window).width() < 768) {
			gallery_w = settings.gallery_responsive_width.height;
		}
		if ($(window).width() < 480) {
			gallery_w = settings.gallery_responsive_width.height2;
		}
		if ($('body').hasClass('et_divi_builder') || $('body').hasClass('theme-Divi')) {
			var gallery_divi_width = $('.et-db #et-boc .et-l .et_pb_gutters3 .et_pb_column_1_2').width();
			if ($.isNumeric(gallery_divi_width)) {
				gallery_w = gallery_divi_width;
			}

		}
		if ($('.woocommerce-product-gallery').parents('.hestia-product-image-wrap').length) {
			var gallery_hestia_width = $('.woocommerce-product-gallery').parents('.hestia-product-image-wrap').width();
			if (typeof gallery_hestia_width === "number") {
				gallery_w = gallery_hestia_width;
			}

		}
		if ($('body').hasClass('et_divi_builder') || $('body').hasClass('theme-Divi')) {
			var gallery_divi_width = $('.et-db #et-boc .et-l .et_pb_gutters3 .et_pb_column_1_2').width();
			if (typeof gallery_divi_width === "number") {
				gallery_w = gallery_divi_width;
			}
		}
		wcgs_slider_func(gallery_w);
		$(window).on("load", function () {
			$(".wcgs-gallery-preloader").css("opacity", 0);
			$(".wcgs-gallery-preloader").css("z-index", -99);
		});
		videoIcon();
		if (wcgs_ajax_object.wcgs_settings.zoom == "1") {
			dataZoom();
			zoomEffect();
		}
		wcgsLightbox();

		$(document).on('change', '.variations select', function () {

			// var productID = $(this).parents('.product').attr('id').substr(8);
			// var productID = $(this).parents('.variations_form').data('product_id');
			var productID = $('#wpgs-gallery').data('id');
			var variationsArray = [];
			$('.variations tr').each(function () {
				var attributeName = $(this).find('select').data('attribute_name');
				var attributeValue = $(this).find('select').val();
				if (attributeValue) {
					var variations = {
						attributeName,
						attributeValue
					};
					variationsArray.push(variations);
				}
			});
			var data = {
				'nonce': wcgs_ajax_object.nonce,
				'action': 'wcgs_action',
				'productID': productID,
				'variationsArray': variationsArray
			};
			$.ajax({
				url: wcgs_ajax_object.ajax_url,
				data: data,
				type: "POST",
				success: function (response) {
					if (response.length > 0) {
						$('.wcgs-gallery-preloader').css('z-index', 99);
						$('.wcgs-gallery-preloader').css('opacity', 0.5);
						$('.wcgs-carousel').slick('unslick');
						$('.gallery-navigation-carousel').slick('unslick');
						$('#wpgs-gallery .wcgs-carousel > *, #wpgs-gallery .gallery-navigation-carousel > *').remove();
						var gallery = response;
						gallery.forEach(function (item, index) {
							if (item != null) {
								var caption = (item.cap.length > 0) ? item.cap : '';
								var checkVideo = item.hasOwnProperty('video') ? true : false;
								if (checkVideo) {
									var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
									var video = item.video;
									if (regex.test(video)) {
										var youtubeCheck = (video.indexOf('youtub') > -1) ? true : false;
										var vimeoCheck = (video.indexOf('vimeo') > -1) ? true : false;
										if (youtubeCheck) {
											var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
											var match = video.match(regExp);
											var id = (match && match[7].length == 11) ? match[7] : false;

											$('#wpgs-gallery .wcgs-carousel').append('<a class="wcgs-slider-image" href="' + video + '" data-fancybox="view"><div class="wcgs-iframe-wraper"><img style="visibility: hidden;" alt="' + caption + '" data-videosrc="' + video + '" src="' + item.url + '" data-type="youtube" data-videoid="' + id + '" /><iframe frameborder="0"  src="https://www.youtube.com/embed/' + id + '" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="true"></iframe></div></a>');
											$('#wpgs-gallery .gallery-navigation-carousel').append('<div class="wcgs-thumb"><img alt="' + caption + '" data-videosrc="' + video + '" src="' + item.thumb_url + '" data-type="youtube" data-videoid="' + id + '" /></div>');
										}
										if (vimeoCheck) {
											var regExp = /^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/;
											var match = video.match(regExp);
											var id = match[5];
											$('#wpgs-gallery .wcgs-carousel').append('<a class="wcgs-slider-image" href="' + video + '" data-fancybox="view"><div class="wcgs-iframe-wraper"><img style="visibility: hidden;" alt="' + caption + '" data-videosrc="' + video + '" src="' + item.url + '" data-type="vimeo" data-videoid="' + id + '" /><iframe src="https://player.vimeo.com/video/' + id + '" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe></div></a>');
											$('#wpgs-gallery .gallery-navigation-carousel').append('<div class="wcgs-thumb"><img alt="' + caption + '" data-videosrc="' + video + '" src="' + item.thumb_url + '" data-type="vimeo" data-videoid="' + id + '"   /></div>');
										}
										if (!youtubeCheck && !vimeoCheck) {
											$('#wpgs-gallery .wcgs-carousel').append('<a class="wcgs-slider-image" href="' + video + '" data-fancybox="view"><div class="wcgs-iframe-wraper"><video controls><source src="' + video + '" type="video/mp4"></video><img  style="visibility: hidden;" alt="' + caption + '" data-videosrc="' + video + '" src="' + item.url + '" data-type="html5video" data-videomp4="' + video + '" /></div></a>');
											$('#wpgs-gallery .gallery-navigation-carousel').append('<div class="wcgs-thumb"><img alt="' + caption + '" data-videosrc="' + video + '" src="' + item.thumb_url + '" data-type="html5video" data-videomp4="' + video + '" /></div>');
										}
									} else {
										$('#wpgs-gallery .wcgs-carousel').append('<a class="wcgs-slider-image" href="' + item.url + '" data-fancybox="view"><img alt="' + caption + '" src="' + item.url + '" data-image="' + item.url + '" /></a>');
										$('#wpgs-gallery .gallery-navigation-carousel').append('<div class="wcgs-thumb"><img alt="' + caption + '" src="' + item.thumb_url + '" data-image="' + item.url + '" /></div>');
									}
								} else {
									$('#wpgs-gallery .wcgs-carousel').append('<a class="wcgs-slider-image" href="' + item.full_url + '" data-fancybox="view"><img alt="' + caption + '" src="' + item.url + '" data-image="' + item.full_url + '" /></a>');
									$('#wpgs-gallery .gallery-navigation-carousel').append('<div class="wcgs-thumb"><img alt="' + caption + '" src="' + item.thumb_url + '" data-image="' + item.url + '" /></div>');
								}
							}
						});

						$('#wpgs-gallery').wpgspimagesLoaded().then(function () {
							// do stuff after images are loaded here
							wcgs_slider_func(gallery_w);
							setTimeout(function () {
								wcgsGalleryClickEvents();
								if (wcgs_ajax_object.wcgs_settings.zoom == "1") {
									dataZoom();
									zoomEffect();
								}
								videoIcon();
								wcgsLightbox();
								$('.wcgs-gallery-preloader').css('z-index', -99);
								$('.wcgs-gallery-preloader').css('opacity', 0);
							}, 200);
						});
					}
				}
			})
		});
		$(document).ajaxStart(function () {
			$(".wcgs-gallery-preloader").css("opacity", .8);
		});
		$(document).ajaxComplete(function () {
			setTimeout(300, function () {
				$(".wcgs-gallery-preloader").css("opacity", 0);
				$(".wcgs-gallery-preloader").css("z-index", -99);
			})
		});
		function wcgsGalleryClickEvents() {
			var lightbox = (settings.lightbox == 1) ? true : false;
			var wcgs_img_count = $("#wpgs-gallery").find('.gallery-navigation-carousel .wcgs-slider-image:not(.slick-cloned)').length;
			if (lightbox) {
				if (wcgs_img_count > 1) {
					$('.wcgs-carousel').on('afterChange', function (event, slick, currentSlide, nextSlide) {
						$('.wcgs-lightbox a').attr('data-fancybox-index', currentSlide + 1);
					});
				}
			}
		}
		// Lightbox init.
		$(function () {
			wcgsGalleryClickEvents();
		});
	});
})(jQuery);
