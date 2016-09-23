(function($) {
    'use strict';

    var woocommerce = {};
    mkdf.modules.woocommerce = woocommerce;

    woocommerce.mkdfInitQuantityButtons = mkdfInitQuantityButtons;
    woocommerce.mkdfInitSelect2 = mkdfInitSelect2;

    woocommerce.mkdfOnDocumentReady = mkdfOnDocumentReady;
    woocommerce.mkdfOnWindowLoad = mkdfOnWindowLoad;
    woocommerce.mkdfOnWindowResize = mkdfOnWindowResize;
    woocommerce.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
        mkdfInitQuantityButtons();
        mkdfInitSelect2();
        mkdfInitTabsFollowLine();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdfOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdfOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdfOnWindowScroll() {

    }
    

    function mkdfInitQuantityButtons() {
        $(document).on('click', '.mkdf-quantity-minus, .mkdf-quantity-plus', function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.siblings('.mkdf-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('mkdf-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(1);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined || isNaN(max) ) {
                    inputField.val(newInputValue);

                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }
            
            inputField.trigger('change');

        });

    }

    function mkdfInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length ||  $('#calc_shipping_country').length ) {

            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });

            $('#calc_shipping_country').select2();

        }

    }

    function mkdfInitTabsFollowLine() {
        var wooTabs = $('.mkdf-tabs.woocommerce-tabs');
        if (wooTabs.length) {
            wooTabs.each(function(){
                var thisTabs = $(this),                
                    tab = thisTabs.find('li');

                thisTabs.find('ul').append('<span class="mkdf-tab-line"></span>');
                var tabLine = thisTabs.find('.mkdf-tab-line');

                tabLine.css({width: tab.first().find('> a').outerWidth()});
                tabLine.css({left: 0});

                if (tab.height() == tab.parent('ul').height()) { //tabs are in the same line, default layout
                    tab.each(function(){
                        var thisTab = $(this);
                        thisTab.mouseenter(function(){
                            tabLine.css({width: thisTab.find('> a').outerWidth()});
                            tabLine.css({left: thisTab.offset().left - thisTab.parent().offset().left});
                        });
                    });

                    thisTabs.find('> ul').mouseleave(function(){
                        tabLine.css({width: tab.filter('.ui-tabs-active').find('> a').outerWidth()});
                        tabLine.css({left: tab.filter('.ui-tabs-active').find('> a').offset().left - tab.filter('.ui-tabs-active').parent().offset().left});
                    });
                } else { //tabs are on top of each other, responsive layout
                    tab.each(function(){
                        tabLine.css({width: '100%'});
                        var thisTab = $(this);
                        thisTab.click(function(){
                            tabLine.css({top: thisTab.offset().top - thisTab.parent().offset().top + thisTab.outerHeight() - 3}); // 3 tabLine height
                        });
                    });
                }
            });
        }
    }


})(jQuery);