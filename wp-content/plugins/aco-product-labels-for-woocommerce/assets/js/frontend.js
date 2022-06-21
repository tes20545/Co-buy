jQuery(window).on('load',function () {
	var acoDivClass = acoplw_frontend_object.classname ? '.'+acoplw_frontend_object.classname : '.images';

    // Detail Page Badge
    var badge = jQuery('.acoplw-hidden-wrap').not('header .acoplw-hidden-wrap');
	var flag = false;
	if ( badge.length >= 1 ) { // Check for badges
		var badgeCont = badge.find('.acoplw-badge').clone(); 
        if ( acoplw_frontend_object.classname ) {
			jQuery(acoDivClass).each( function (index, cont) {
				if ( !flag ) { 
					var position = jQuery(this);
					jQuery(this).css({'positon':'relative'});
					jQuery(badgeCont).prependTo(jQuery(position).parent());
					// jQuery(position).appendTo(badgeCont);
					flag = true;
				}
			});
			badge.remove();
		} else {
			jQuery('.woocommerce-product-gallery:first, .woocommerce-product-gallery--with-images:first').each( function (index, cont) { 
				var position = jQuery(this);
				jQuery(this).css({'positon':'relative'}); 
				if ( jQuery(position).parent().hasClass('product') ) {
					jQuery(badgeCont).prependTo(jQuery(position));
				} else {
					jQuery(badgeCont).prependTo(jQuery(position).parent());
				}
				flag = true;
			});
			if (!flag) { 
				jQuery(acoDivClass).each( function (index, cont) {
					if ( !flag ) { 
						var position = jQuery(this);
						jQuery(this).css({'positon':'relative'});
						jQuery(badgeCont).prependTo(jQuery(position).parent());
						// jQuery(position).appendTo(badgeCont);
						flag = true;
					}
				});
			} else {
				badge.remove();
			}
		}
	}

	// Listing Page
	// let listingBadge = jQuery('.acoplw-badge').not(acoDivClass+' .acoplw-badge');
	// let listFlag = false; 
	// if ( listingBadge.length >= 1 ) { // Check for badges
	// 	jQuery(listingBadge).each (function() {
	// 		let listingParentDiv 	= jQuery(this).parents('.product');
	// 		let listingImgDiv		= jQuery(listingParentDiv).find('img');
	// 		let listingBadgeClone	= jQuery(this);
	// 		jQuery(listingParentDiv).find('img').wrap('<span class="acoplw-badgeWrap"></span>')
	// 		// jQuery(this).css({'positon':'relative'});
	// 		jQuery(listingBadgeClone).prependTo(jQuery(listingImgDiv).parent());
	// 	});
	// }

});