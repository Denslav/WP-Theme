jQuery(document).ready(function($){
    //Header burger menu
    $('.js-nav-toggle').on('click', function() {
        setHeaderMenuHeight();
        let $currentElement = $(this)

        $currentElement.toggleClass('active');
        $currentElement.siblings('ul').slideToggle();
        $('body, html').toggleClass('lock-scroll');
    })

    //Set header menu height on resize
    $(window).on('resize', function() {
        setHeaderMenuHeight();

        let $navToggle =  $('.js-nav-toggle'),
            $dropDownToggle = $('.menu-chevron');

        $navToggle.removeClass('active');
        $dropDownToggle.removeClass('active');
        $dropDownToggle.parents('li').find('.sub-menu').attr('style', '');
        $navToggle.siblings('ul').attr('style', '');
    })

    //Dropdown Menu {
    $('.menu-chevron').on('click', function(e) {
        e.preventDefault();

        let $currentElement = $(this),
            $subMenu = $currentElement.parents('li').find('.sub-menu');

        if ( $(window).width() < 992 ) {
            $currentElement.toggleClass('active');
            $subMenu.slideToggle();
        }
    })

    //Calculate menu height
    function setHeaderMenuHeight() {
        let $menu = $('#menu-header')

        if ( $(window).width() >= 992 ) {
            $menu.css( { 'height': 'auto', 'top': '0' } );
        } else {
            let headerSize = $('#header').innerHeight(),
                menuSize = $(window).innerHeight() - headerSize;

            $menu.css( { 'height': menuSize + 'px', 'top': headerSize + 'px' } );
        }
    }
});