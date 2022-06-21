jQuery(document).ready(function ($) {

    $('.wps-product-section').each(function (index) {

        var custom_id = $(this).attr('id');

        if (custom_id != '') {
            jQuery('#' + custom_id).slick({
                prevArrow: "<div class='slick-prev'><i class='fa fa-angle-left'></i></div>",
                nextArrow: "<div class='slick-next'><i class='fa fa-angle-right'></i></div>",
                slidesToScroll: 1,

            }); // Slick end

        }
    });

    /**
     * Preloader.
     */
    $('body').find('.wps-product-section').each(function () {
        var _this = $(this),
            custom_id = $(this).attr('id'),
            preloader = _this.data('preloader');
        if ('1' == preloader) {
            var parents_class = $('#' + custom_id).parent('.wps-slider-section'),
                parents_siblings_id = parents_class.find('.wps-preloader').attr('id');
            // $(window).load(function () {
            $(document).ready(function() {
                $('#' + parents_siblings_id).animate({ opacity: 1 }, 600).hide();
                $('#' + custom_id).animate({ opacity: 1 }, 600)
            })
        }
    })

});
