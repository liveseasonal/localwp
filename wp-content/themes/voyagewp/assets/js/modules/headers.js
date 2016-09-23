(function($) {
    "use strict";

    var header = {};
    mkdf.modules.header = header;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour;
    header.mkdfSideArea = mkdfSideArea;
    header.mkdfSideAreaScroll = mkdfSideAreaScroll;
    header.mkdfInitMobileNavigation = mkdfInitMobileNavigation;
    header.mkdfMobileHeaderBehavior = mkdfMobileHeaderBehavior;
    header.mkdfSetDropDownMenuPosition = mkdfSetDropDownMenuPosition;
    header.mkdfDropDownMenu = mkdfDropDownMenu;
    header.mkdfSearch = mkdfSearch;

    header.mkdfOnDocumentReady = mkdfOnDocumentReady;
    header.mkdfOnWindowLoad = mkdfOnWindowLoad;
    header.mkdfOnWindowResize = mkdfOnWindowResize;
    header.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
        mkdfHeaderBehaviour();
        mkdfSideArea();
        mkdfSideAreaScroll();
        mkdfInitMobileNavigation();
        mkdfMobileHeaderBehavior();
        mkdfSetDropDownMenuPosition();
        mkdfDropDownMenu();
        mkdfSearch();
        mkdfVerticalMenu().init();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdfOnWindowLoad() {
        mkdfSetDropDownMenuPosition();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdfOnWindowResize() {
        mkdfDropDownMenu();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdfOnWindowScroll() {
        
    }



    /*
     **	Show/Hide sticky header on window scroll
     */
    function mkdfHeaderBehaviour() {

        var header = $('.mkdf-page-header');
        var stickyHeader = $('.mkdf-sticky-header');
        var fixedHeaderWrapper = $('.mkdf-fixed-wrapper');

        var headerMenuAreaOffset = $('.mkdf-page-header').find('.mkdf-fixed-wrapper').length ? $('.mkdf-page-header').find('.mkdf-fixed-wrapper').offset().top : null;

        var stickyAppearAmount;


        switch(true) {
            // sticky header that will be shown when user scrolls up
            case mkdf.body.hasClass('mkdf-sticky-header-on-scroll-up'):
                mkdf.modules.header.behaviour = 'mkdf-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = mkdfGlobalVars.vars.mkdfTopBarHeight + mkdfGlobalVars.vars.mkdfLogoAreaHeight + mkdfGlobalVars.vars.mkdfMenuAreaHeight + mkdfGlobalVars.vars.mkdfStickyHeaderHeight;

                var headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();

                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        mkdf.modules.header.isStickyVisible= false;
                        stickyHeader.removeClass('header-appear').find('.mkdf-main-menu .second').removeClass('mkdf-drop-down-start');
                    }else {
                        mkdf.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case mkdf.body.hasClass('mkdf-sticky-header-on-scroll-down-up'):
                var setStickyScrollAmount = function() {
                    var amount;

                    if(isStickyAmountFullScreen()) {
                        amount = mkdf.window.height();
                    } else {
                        if(mkdfPerPageVars.vars.mkdfStickyScrollAmount !== 0) {
                            amount = mkdfPerPageVars.vars.mkdfStickyScrollAmount;
                        } else {
                            amount = mkdfGlobalVars.vars.mkdfTopBarHeight + mkdfGlobalVars.vars.mkdfLogoAreaHeight + mkdfGlobalVars.vars.mkdfMenuAreaHeight;
                        }
                    }

                    stickyAppearAmount = amount;
                };

                var isStickyAmountFullScreen = function() {
                    var fullScreenStickyAmount = mkdfPerPageVars.vars.mkdfStickyScrollAmountFullScreen;

                    return typeof fullScreenStickyAmount !== 'undefined' && fullScreenStickyAmount === true;
                };
                
                mkdf.modules.header.behaviour = 'mkdf-sticky-header-on-scroll-down-up';
                setStickyScrollAmount();
                mkdf.modules.header.stickyAppearAmount = stickyAppearAmount; //used in anchor logic
                
                var headerAppear = function(){
                    if(mkdf.scroll < stickyAppearAmount) {
                        mkdf.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.mkdf-main-menu .second').removeClass('mkdf-drop-down-start');
                    }else{
                        mkdf.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case mkdf.body.hasClass('mkdf-fixed-on-scroll'):
                mkdf.modules.header.behaviour = 'mkdf-fixed-on-scroll';
                var headerFixed = function(){
                    if(mkdf.scroll < headerMenuAreaOffset){
                        fixedHeaderWrapper.removeClass('fixed');
                        header.css('margin-bottom',0);}
                    else{
                        fixedHeaderWrapper.addClass('fixed');
                        header.css('margin-bottom',fixedHeaderWrapper.height());
                    }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

    /**
     * Show/hide side area
     */
    function mkdfSideArea() {

        var wrapper = $('.mkdf-wrapper'),
            sideMenu = $('.mkdf-side-menu'),
            sideMenuButtonOpen = $('a.mkdf-side-menu-button-opener'),
            cssClass,
        //Flags
            slideFromRight = false,
            slideWithContent = false,
            slideUncovered = false;

        if (mkdf.body.hasClass('mkdf-side-menu-slide-from-right')) {

            cssClass = 'mkdf-right-side-menu-opened';
            wrapper.prepend('<div class="mkdf-cover"/>');
            slideFromRight = true;

        } else if (mkdf.body.hasClass('mkdf-side-menu-slide-with-content')) {

            cssClass = 'mkdf-side-menu-open';
            slideWithContent = true;

        } else if (mkdf.body.hasClass('mkdf-side-area-uncovered-from-content')) {

            cssClass = 'mkdf-right-side-menu-opened';
            slideUncovered = true;

        }

        $('a.mkdf-side-menu-button-opener, a.mkdf-close-side-menu').click( function(e) {
            e.preventDefault();

            if(!sideMenuButtonOpen.hasClass('opened')) {

                sideMenuButtonOpen.addClass('opened');
                mkdf.body.addClass(cssClass);

                if (slideFromRight) {
                    $('.mkdf-wrapper .mkdf-cover').click(function() {
                        mkdf.body.removeClass('mkdf-right-side-menu-opened');
                        sideMenuButtonOpen.removeClass('opened');
                    });
                }

                if (slideUncovered) {
                    sideMenu.css({
                        'visibility' : 'visible'
                    });
                }

                var currentScroll = $(window).scrollTop();
                $(window).scroll(function() {
                    if(Math.abs(mkdf.scroll - currentScroll) > 400){
                        mkdf.body.removeClass(cssClass);
                        sideMenuButtonOpen.removeClass('opened');
                        if (slideUncovered) {
                            var hideSideMenu = setTimeout(function(){
                                sideMenu.css({'visibility':'hidden'});
                                clearTimeout(hideSideMenu);
                            },400);
                        }
                    }
                });

            } else {

                sideMenuButtonOpen.removeClass('opened');
                mkdf.body.removeClass(cssClass);
                if (slideUncovered) {
                    var hideSideMenu = setTimeout(function(){
                        sideMenu.css({'visibility':'hidden'});
                        clearTimeout(hideSideMenu);
                    },400);
                }

            }

            if (slideWithContent) {

                e.stopPropagation();
                wrapper.click(function() {
                    e.preventDefault();
                    sideMenuButtonOpen.removeClass('opened');
                    mkdf.body.removeClass('mkdf-side-menu-open');
                });

            }

        });

    }

    /*
    **  Smooth scroll functionality for Side Area
    */
    function mkdfSideAreaScroll(){

        var sideMenu = $('.mkdf-side-menu');

        if(sideMenu.length){    
            sideMenu.niceScroll({ 
                scrollspeed: 60,
                mousescrollstep: 40,
                cursorwidth: 0, 
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false, 
                horizrailenabled: false 
            });
        }
    }


    function mkdfInitMobileNavigation() {
        var navigationOpener = $('.mkdf-mobile-header .mkdf-mobile-menu-opener');
        var navigationHolder = $('.mkdf-mobile-header .mkdf-mobile-nav');
        var dropdownOpener = $('.mkdf-mobile-nav .mobile_arrow, .mkdf-mobile-nav h4, .mkdf-mobile-nav a[href*="#"]');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if(navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                if(navigationHolder.is(':visible')) {
                    navigationHolder.slideUp(animationSpeed);
                } else {
                    navigationHolder.slideDown(animationSpeed);
                }
            });
        }

        //dropdown opening / closing
        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                $(this).on('tap click', function(e) {
                    var dropdownToOpen = $(this).nextAll('ul').first();

                    if(dropdownToOpen.length) {
                        e.preventDefault();
                        e.stopPropagation();

                        var openerParent = $(this).parent('li');
                        if(dropdownToOpen.is(':visible')) {
                            dropdownToOpen.slideUp(animationSpeed);
                            openerParent.removeClass('mkdf-opened');
                        } else {
                            dropdownToOpen.slideDown(animationSpeed);
                            openerParent.addClass('mkdf-opened');
                        }
                    }

                });
            });
        }

        $('.mkdf-mobile-nav a, .mkdf-mobile-logo-wrapper a').on('click tap', function(e) {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function mkdfMobileHeaderBehavior() {
        if(mkdf.body.hasClass('mkdf-sticky-up-mobile-header')) {
            var stickyAppearAmount;
            var mobileHeader = $('.mkdf-mobile-header');
            var adminBar     = $('#wpadminbar');
            var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
            var adminBarHeight = adminBar.length ? adminBar.height() : 0;

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + adminBarHeight;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('mkdf-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('mkdf-animate-mobile-header');
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if(adminBar.length) {
                        mobileHeader.find('.mkdf-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', stickyAppearAmount);

                    //if(adminBar.length) {
                    //    mobileHeader.find('.mkdf-mobile-header-inner').css('top', adminBarHeight);
                    //}
                }

                docYScroll1 = $(document).scrollTop();
            });
        }

    }


    /**
     * Set dropdown position
     */
    function mkdfSetDropDownMenuPosition(){

        var menuItems = $(".mkdf-drop-down > ul > li.narrow");
        menuItems.each( function(i) {

            var browserWidth = mkdf.windowWidth-16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.second .inner ul').width();

            var menuItemFromLeft = 0;
            if(mkdf.body.hasClass('boxed')){
                menuItemFromLeft = mkdf.boxedLayoutWidth  - (menuItemPosition - (browserWidth - mkdf.boxedLayoutWidth )/2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if($(this).find('li.sub').length > 0){
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if(menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth){
                $(this).find('.second').addClass('right');
                $(this).find('.second .inner ul').addClass('right');
            }
        });

    }


    function mkdfDropDownMenu() {

        var menu_items = $('.mkdf-drop-down > ul > li');

        menu_items.each(function(i) {
            if($(menu_items[i]).find('.second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.second');

                if($(menu_items[i]).hasClass('wide')) {

                    var dropdown = $(this).find('.inner > ul');
                    var dropdownPadding = parseInt(dropdown.css('padding-left').slice(0, -2)) + parseInt(dropdown.css('padding-right').slice(0, -2));
                    var dropdownWidth = dropdown.outerWidth();

                    if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                        dropDownSecondDiv.css('left', 0);
                    }

                    //set columns to be same height - start
                    var tallest = 0;
                    $(this).find('.second > .inner > ul > li').each(function() {
                        var thisHeight = $(this).height();
                        if(thisHeight > tallest) {
                            tallest = thisHeight;
                        }
                    });
                    $(this).find('.second > .inner > ul > li').css("height", ""); // delete old inline css - via resize
                    $(this).find('.second > .inner > ul > li').height(tallest);
                    //set columns to be same height - end

                    if(!mkdf.body.hasClass('mkdf-full-width-wide-menu')) {
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            var left_position = (mkdf.windowWidth - 2 * (mkdf.windowWidth - dropdown.offset().left)) / 2 + (dropdownWidth + dropdownPadding) / 2;
                            dropDownSecondDiv.css('left', -left_position);
                        }
                    } else {
                        if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                            var left_position = dropdown.offset().left;

                            dropDownSecondDiv.css('left', -left_position);
                            dropDownSecondDiv.css('width', mkdf.windowWidth);

                        }
                    }
                }

                if(!mkdf.menuDropdownHeightSet) {
                    $(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    $(menu_items[i]).on("touchstart mouseenter", function() {
                        dropDownSecondDiv.css({
                            'height': $(menu_items[i]).data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function() {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });

                } else {
                    if(mkdf.body.hasClass('mkdf-dropdown-animate-height')) {
                        $(menu_items[i]).mouseenter(function() {
                            dropDownSecondDiv.css({
                                'visibility': 'visible',
                                'height': '0px',
                                'opacity': '0'
                            });
                            dropDownSecondDiv.stop().animate({
                                'height': $(menu_items[i]).data('original_height'),
                                opacity: 1
                            }, 200, function() {
                                dropDownSecondDiv.css('overflow', 'visible');
                            });
                        }).mouseleave(function() {
                            dropDownSecondDiv.stop().animate({
                                'height': '0px'
                            }, 0, function() {
                                dropDownSecondDiv.css({
                                    'overflow': 'hidden',
                                    'visibility': 'hidden'
                                });
                            });
                        });
                    } else {
                        var config = {
                            interval: 0,
                            over: function() {
                                setTimeout(function() {
                                    dropDownSecondDiv.addClass('mkdf-drop-down-start');
                                    dropDownSecondDiv.stop().css({'height': $(menu_items[i]).data('original_height')});
                                }, 150);
                            },
                            timeout: 150,
                            out: function() {
                                dropDownSecondDiv.stop().css({'height': '0px'});
                                dropDownSecondDiv.removeClass('mkdf-drop-down-start');
                            }
                        };
                        $(menu_items[i]).hoverIntent(config);
                    }
                }
            }
        });
         $('.mkdf-drop-down ul li.wide ul li a').on('click', function(e) {
            if (e.which == 1){
                var $this = $(this);
                setTimeout(function() {
                    $this.mouseleave();
                }, 500);
            }
        });

        mkdf.menuDropdownHeightSet = true;
    }

    /**
     * Init Search Types
     */
    function mkdfSearch() {

        var searchOpener = $('a.mkdf-search-opener'),
            searchForm,
            touch = false;

        if ( $('html').hasClass( 'touch' ) ) {
            touch = true;
        }

        if ( searchOpener.length > 0 ) {

            mkdfFullscreenSearch();

            //Check for hover color of search
            if(typeof searchOpener.data('hover-color') !== 'undefined') {
                var changeSearchColor = function(event) {
                    event.data.searchOpener.css('color', event.data.color);
                };

                var originalColor = searchOpener.css('color');
                var hoverColor = searchOpener.data('hover-color');

                searchOpener.on('mouseenter', { searchOpener: searchOpener, color: hoverColor }, changeSearchColor);
                searchOpener.on('mouseleave', { searchOpener: searchOpener, color: originalColor }, changeSearchColor);
            }

        }

        /**
         * Fullscreen search (two types: fade and from circle)
         */
        function mkdfFullscreenSearch() {

            var searchHolder = $( '.mkdf-fullscreen-search-holder'),
                searchOverlay = $( '.mkdf-fullscreen-search-overlay' ),
                fieldHolder = searchHolder.find('.mkdf-field-holder');

            searchOpener.click( function(e) {
                e.preventDefault();
                //Fullscreen search fade
                if ( searchHolder.hasClass( 'mkdf-animate' ) ) {
                    searchClose();
                } else {
                    searchOpen();
                }
                //Close on click away
                $(document).mouseup(function (e) {
                    if (!fieldHolder.is(e.target) && fieldHolder.has(e.target).length === 0)  {
                        e.preventDefault();
                        searchClose();
                    }
                });
                //Close on escape
                $(document).keyup(function(e){
                    if (e.keyCode == 27 ) { //KeyCode for ESC button is 27
                        searchClose();
                    }
                });

                function searchClose() {
                    mkdf.body.removeClass('mkdf-fullscreen-search-opened');
                    mkdf.body.addClass( 'mkdf-search-fade-out' );
                    mkdf.body.removeClass( 'mkdf-search-fade-in' );
                    searchHolder.removeClass( 'mkdf-animate' );
                    fieldHolder.find('.mkdf-search-field').blur().val('');
                }
                function searchOpen() {
                    mkdf.body.addClass('mkdf-fullscreen-search-opened');
                    mkdf.body.removeClass('mkdf-search-fade-out');
                    mkdf.body.addClass('mkdf-search-fade-in');
                    searchHolder.addClass('mkdf-animate');
                    setTimeout(function(){
                        fieldHolder.find('.mkdf-search-field').focus();
                    },400);
                }
            });

            //Text input focus change
            $('.mkdf-fullscreen-search-holder .mkdf-search-field').focus(function(){
                $('.mkdf-fullscreen-search-holder .mkdf-field-holder .mkdf-line').css("width","100%");
            });

            $('.mkdf-fullscreen-search-holder .mkdf-search-field').blur(function(){
                $('.mkdf-fullscreen-search-holder .mkdf-field-holder .mkdf-line').css("width","0");
            });

        }

    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var mkdfVerticalMenu = function() {
        /**
         * Main vertical area object that used through out function
         * @type {jQuery object}
         */
        var verticalMenuObject = $('.mkdf-vertical-menu-area');

        /**
         * Resizes vertical area. Called whenever height of navigation area changes
         * It first check if vertical area is scrollable, and if it is resizes scrollable area
         */
        //var resizeVerticalArea = function() {
        //    if(verticalAreaScrollable()) {
        //        verticalMenuObject.getNiceScroll().resize();
        //    }
        //};

        /**
         * Checks if vertical area is scrollable (if it has mkdf-with-scroll class)
         *
         * @returns {bool}
         */
        //var verticalAreaScrollable = function() {
        //    return verticalMenuObject.hasClass('.mkdf-with-scroll');
        //};

        /**
         * Initialzes navigation functionality. It checks navigation type data attribute and calls proper functions
         */
        var initNavigation = function() {
            var verticalNavObject = verticalMenuObject.find('.mkdf-vertical-menu');
            var navigationType = typeof verticalNavObject.data('navigation-type') !== 'undefined' ? verticalNavObject.data('navigation-type') : '';

            switch(navigationType) {
                //case 'dropdown-toggle':
                //    dropdownHoverToggle();
                //    break;
                //case 'dropdown-toggle-click':
                //    dropdownClickToggle();
                //    break;
                //case 'float':
                //    dropdownFloat();
                //    break;
                //case 'slide-in':
                //    dropdownSlideIn();
                //    break;
                default:
                    dropdownFloat();
                    break;
            }

            /**
             * Initializes hover toggle navigation type. It has separate functionalities for touch and no-touch devices
             */
            //function dropdownHoverToggle() {
            //    var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
            //
            //    menuItems.each(function() {
            //        var elementToExpand = $(this).find(' > .second, > ul');
            //        var numberOfChildItems = elementToExpand.find(' > .inner > ul > li, > li').length;
            //
            //        var animSpeed = numberOfChildItems * 40;
            //        var animFunc = 'easeInOutSine';
            //        var that = this;
            //
            //        //touch devices functionality
            //        if(Modernizr.touch) {
            //            var dropdownOpener = $(this).find('> a');
            //
            //            dropdownOpener.on('click tap', function(e) {
            //                e.preventDefault();
            //                e.stopPropagation();
            //
            //                if(elementToExpand.is(':visible')) {
            //                    $(that).removeClass('open');
            //                    elementToExpand.slideUp(animSpeed, animFunc, function() {
            //                        resizeVerticalArea();
            //                    });
            //                } else {
            //                    $(that).addClass('open');
            //                    elementToExpand.slideDown(animSpeed, animFunc, function() {
            //                        resizeVerticalArea();
            //                    });
            //                }
            //            });
            //        } else {
            //            $(this).hover(function() {
            //                $(that).addClass('open');
            //                elementToExpand.slideDown(animSpeed, animFunc, function() {
            //                    resizeVerticalArea();
            //                });
            //            }, function() {
            //                setTimeout(function() {
            //                    $(that).removeClass('open');
            //                    elementToExpand.slideUp(animSpeed, animFunc, function() {
            //                        resizeVerticalArea();
            //                    });
            //                }, 1000);
            //            });
            //        }
            //    });
            //}

            /**
             * Initializes click toggle navigation type. Works the same for touch and no-touch devices
             */
            //function dropdownClickToggle() {
            //    var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
            //
            //    menuItems.each(function() {
            //        var elementToExpand = $(this).find(' > .second, > ul');
            //        var menuItem = this;
            //        var dropdownOpener = $(this).find('> a');
            //        var slideUpSpeed = 'fast';
            //        var slideDownSpeed = 'slow';
            //
            //        dropdownOpener.on('click tap', function(e) {
            //            e.preventDefault();
            //            e.stopPropagation();
            //
            //            if(elementToExpand.is(':visible')) {
            //                $(menuItem).removeClass('open');
            //                elementToExpand.slideUp(slideUpSpeed, function() {
            //                    resizeVerticalArea();
            //                });
            //            } else {
            //                if(!$(this).parents('li').hasClass('open')) {
            //                    menuItems.removeClass('open');
            //                    menuItems.find(' > .second, > ul').slideUp(slideUpSpeed);
            //                }
            //
            //                $(menuItem).addClass('open');
            //                elementToExpand.slideDown(slideDownSpeed, function() {
            //                    resizeVerticalArea();
            //                });
            //            }
            //        });
            //    });
            //}

            /**
             * Initializes floating navigation type (it comes from the side as a dropdown)
             */
            function dropdownFloat() {
                var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
                var allDropdowns = menuItems.find(' > .second, > ul');

                menuItems.each(function() {
                    var elementToExpand = $(this).find(' > .second, > ul');
                    var menuItem = this;

                    if(Modernizr.touch) {
                        var dropdownOpener = $(this).find('> a');

                        dropdownOpener.on('click tap', function(e) {
                            e.preventDefault();
                            e.stopPropagation();

                            if(elementToExpand.hasClass('mkdf-float-open')) {
                                elementToExpand.removeClass('mkdf-float-open');
                                $(menuItem).removeClass('open');
                            } else {
                                if(!$(this).parents('li').hasClass('open')) {
                                    menuItems.removeClass('open');
                                    allDropdowns.removeClass('mkdf-float-open');
                                }

                                elementToExpand.addClass('mkdf-float-open');
                                $(menuItem).addClass('open');
                            }
                        });
                    } else {
                        //must use hoverIntent because basic hover effect doesn't catch dropdown
                        //it doesn't start from menu item's edge
                        $(this).hoverIntent({
                            over: function() {
                                elementToExpand.addClass('mkdf-float-open');
                                $(menuItem).addClass('open');
                            },
                            out: function() {
                                elementToExpand.removeClass('mkdf-float-open');
                                $(menuItem).removeClass('open');
                            },
                            timeout: 300
                        });
                    }
                });
            }

            /**
             * Initializes slide in navigation type (dropdowns are coming on top of parent element and cover whole navigation area)
             */
            //function dropdownSlideIn() {
            //    var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
            //    var menuItemsLinks = menuItems.find('> a');
            //
            //    menuItemsLinks.each(function() {
            //        var elementToExpand = $(this).next('.second, ul');
            //        appendToExpandableElement(elementToExpand, this);
            //
            //        if($(this).parent('li').is('.current-menu-ancestor', '.current_page_parent', '.current-menu-parent ')) {
            //            elementToExpand.addClass('mkdf-vertical-slide-open');
            //        }
            //
            //        $(this).on('click tap', function(e) {
            //            e.preventDefault();
            //            e.stopPropagation();
            //
            //            menuItems.removeClass('open');
            //
            //            $(this).parent('li').addClass('open');
            //            elementToExpand.addClass('mkdf-vertical-slide-open');
            //        });
            //    });
            //
            //    var previousLevelItems = menuItems.find('li.mkdf-previous-level > a');
            //
            //    previousLevelItems.on('click tap', function(e) {
            //        e.preventDefault();
            //        e.stopPropagation();
            //
            //        menuItems.removeClass('open');
            //        $(this).parents('.mkdf-vertical-slide-open').first().removeClass('mkdf-vertical-slide-open');
            //    });
            //
            //    /**
            //     * Appends 'li' element as first element in dropdown, which will close current dropdown when clicked
            //     * @param {jQuery object} elementToExpand current dropdown to append element to
            //     * @param currentMenuItem
            //     */
            //    function appendToExpandableElement(elementToExpand, currentMenuItem) {
            //        var itemUrl = $(currentMenuItem).attr('href');
            //        var itemText = $(currentMenuItem).text();
            //
            //        var liItem = $('<li />', {class: 'mkdf-previous-level'});
            //
            //        $('<a />', {
            //            'href': itemUrl,
            //            'html': '<i class="mkdf-vertical-slide-arrow fa fa-angle-left"></i>' + itemText
            //        }).appendTo(liItem);
            //
            //        if(elementToExpand.hasClass('second')) {
            //            elementToExpand.find('> div > ul').prepend(liItem);
            //        } else {
            //            elementToExpand.prepend(liItem);
            //        }
            //    }
            //}
        };

        /**
         * Initializes scrolling in vertical area. It checks if vertical area is scrollable before doing so
         */
        //var initVerticalAreaScroll = function() {
        //    if(verticalAreaScrollable()) {
        //        verticalMenuObject.niceScroll({
        //            scrollspeed: 60,
        //            mousescrollstep: 40,
        //            cursorwidth: 0,
        //            cursorborder: 0,
        //            cursorborderradius: 0,
        //            cursorcolor: "transparent",
        //            autohidemode: false,
        //            horizrailenabled: false
        //        });
        //    }
        //};

        //var initHiddenVerticalArea = function() {
        //    var verticalLogo = $('.mkdf-vertical-area-bottom-logo');
        //    var verticalMenuOpener = verticalMenuObject.find('.mkdf-vertical-menu-hidden-button');
        //    var scrollPosition = 0;
        //
        //    verticalMenuOpener.on('click tap', function() {
        //        if(isVerticalAreaOpen()) {
        //            closeVerticalArea();
        //        } else {
        //            openVerticalArea();
        //        }
        //    });
        //
        //    //take click outside vertical left/right area and close it
        //    $j(verticalMenuObject).outclick({
        //        callback: function() {
        //            closeVerticalArea();
        //        }
        //    });
        //
        //    $(window).scroll(function() {
        //        if(Math.abs($(window).scrollTop() - scrollPosition) > 400){
        //            closeVerticalArea();
        //        }
        //    });
        //
        //    /**
        //     * Closes vertical menu area by removing 'active' class on that element
        //     */
        //    function closeVerticalArea() {
        //        verticalMenuObject.removeClass('active');
        //
        //        if(verticalLogo.length) {
        //            verticalLogo.removeClass('active');
        //        }
        //    }
        //
        //    /**
        //     * Opens vertical menu area by adding 'active' class on that element
        //     */
        //    function openVerticalArea() {
        //        verticalMenuObject.addClass('active');
        //
        //        if(verticalLogo.length) {
        //            verticalLogo.addClass('active');
        //        }
        //
        //        scrollPosition = $(window).scrollTop();
        //    }
        //
        //    function isVerticalAreaOpen() {
        //        return verticalMenuObject.hasClass('active');
        //    }
        //};

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();
                    //initVerticalAreaScroll();
                    //
                    //if(mkdf.body.hasClass('mkdf-vertical-header-hidden')) {
                    //    initHiddenVerticalArea();
                    //}
                }
            }
        };
    };

})(jQuery);