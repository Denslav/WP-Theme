/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {
    // Site title and description.
    wp.customize('blogname', function (value) {
        value.bind(function (to) {
            $('.site-title a').text(to);
        });
    });
    wp.customize('blogdescription', function (value) {
        value.bind(function (to) {
            $('.site-description').text(to);
        });
    });


    // Container settings
    wp.customize('container_width', function (value) {
        value.bind(function (to) {
            $('.container').css('max-width', to + 'px');
        });
    });

    wp.customize('container_padding', function (value) {
        value.bind(function (to) {
            $('.container').css({
                'padding-left': to + 'px',
                'padding-right': to + 'px'
            });
        });
    })

    wp.customize('header_bg_color', function (value) {
        value.bind(function (to) {
            $('.header').css('background-color', to);
        });
    });

    wp.customize('footer_bg_color', function (value) {
        value.bind(function (to) {
            $('.footer').css('background-color', to);
        });
    });

}(jQuery));
