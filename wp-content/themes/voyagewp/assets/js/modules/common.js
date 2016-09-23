(function($) {
	"use strict";

    var common = {};
    mkdf.modules.common = common;

	common.mkdfIsTouchDevice = mkdfIsTouchDevice;
	common.mkdfDisableSmoothScrollForMac = mkdfDisableSmoothScrollForMac;
    common.mkdfFluidVideo = mkdfFluidVideo;
    common.mkdfPreloadBackgrounds = mkdfPreloadBackgrounds;
    common.mkdfPrettyPhoto = mkdfPrettyPhoto;
    common.mkdfCheckHeaderStyleOnScroll = mkdfCheckHeaderStyleOnScroll;
    common.mkdfInitParallax = mkdfInitParallax;
    //common.mkdfSmoothScroll = mkdfSmoothScroll;
    common.mkdfEnableScroll = mkdfEnableScroll;
    common.mkdfDisableScroll = mkdfDisableScroll;
    common.mkdfWheel = mkdfWheel;
    common.mkdfKeydown = mkdfKeydown;
    common.mkdfPreventDefaultValue = mkdfPreventDefaultValue;
    common.mkdfOwlSlider = mkdfOwlSlider;
    common.mkdfInitSelfHostedVideoPlayer = mkdfInitSelfHostedVideoPlayer;
    common.mkdfSelfHostedVideoSize = mkdfSelfHostedVideoSize;
    common.mkdfInitBackToTop = mkdfInitBackToTop;
    common.mkdfBackButtonShowHide = mkdfBackButtonShowHide;
    common.mkdfSmoothTransition = mkdfSmoothTransition;
	common.mkdfInitCustomMenuDropdown = mkdfInitCustomMenuDropdown;
    common.mkdfInitOrderingFollowLine = mkdfInitOrderingFollowLine;
    common.mkdfInitMembershipFollowLine = mkdfInitMembershipFollowLine;

    common.mkdfOnDocumentReady = mkdfOnDocumentReady;
    common.mkdfOnWindowLoad = mkdfOnWindowLoad;
    common.mkdfOnWindowResize = mkdfOnWindowResize;
    common.mkdfOnWindowScroll = mkdfOnWindowScroll;
    common.mkdfIsTouchDevice = mkdfIsTouchDevice;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
        mkdfTouchDeviceBodyClass();
		mkdfDisableSmoothScrollForMac();
        mkdfFluidVideo();
        mkdfPreloadBackgrounds();
        mkdfPrettyPhoto();
        mkdfInitElementsAnimations();
        mkdfInitAnchor().init();
        mkdfInitVideoBackground();
        mkdfInitVideoBackgroundSize();
        mkdfSetContentBottomMargin();
        //mkdfSmoothScroll();
        mkdfOwlSlider();
        mkdfInitSelfHostedVideoPlayer();
        mkdfSelfHostedVideoSize();
        mkdfInitBackToTop();
        mkdfBackButtonShowHide();
		mkdfInitCustomMenuDropdown();
        mkdfInitOrderingFollowLine();
        mkdfInitMembershipFollowLine();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdfOnWindowLoad() {
        mkdfCheckHeaderStyleOnScroll(); //called on load since all content needs to be loaded in order to calculate row's position right
        mkdfInitParallax();
        mkdfSmoothTransition();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdfOnWindowResize() {
        mkdfInitVideoBackgroundSize();
        mkdfSelfHostedVideoSize();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdfOnWindowScroll() {
        
    }

	/*
	 ** Disable shortcodes animation on appear for touch devices
	 */
    function mkdfTouchDeviceBodyClass() {
        if(mkdfIsTouchDevice()) {
            mkdf.body.addClass('mkd-no-animations-on-touch');
        }
    }

    function mkdfIsTouchDevice() {
        return Modernizr.touch && !mkdf.body.hasClass('mkd-no-animations-on-touch');
    }
	/*
	 ** Disable smooth scroll for mac if smooth scroll is enabled
	 */
	function mkdfDisableSmoothScrollForMac() {
		var os = navigator.appVersion.toLowerCase();

		if (os.indexOf('mac') > -1 && mkdf.body.hasClass('mkdf-smooth-scroll')) {
			mkdf.body.removeClass('mkdf-smooth-scroll');
		}
	}

	function mkdfFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

    /**
     * Init Owl Carousel
     */
    function mkdfOwlSlider() {

        var sliders = $('.mkdf-owl-slider');

        if (sliders.length) {
            sliders.each(function(){
                var slider = $(this);

                if (!slider.hasClass('owl-carousel')) {
                    slider.addClass('owl-carousel');
                }

                slider.waitForImages(function(){
                    slider.css('visibility','visible');
                    slider.animate({opacity:1});
                });

                slider.owlCarousel({
                    autoplay:true,
                    autoplayHoverPause:true,
                    loop: true,
                    items: 1,
                    nav: true,
                    autoHeight: true,
                    dots: false,
                    navText: [
                        '<span class="mkdf-prev-icon"><i class="fa fa-angle-left"></i></span>',
                        '<span class="mkdf-next-icon"><i class="fa fa-angle-right"></i></span>'
                    ],
                    smartSpeed: 200,
                    animateIn: 'fadeIn',
                    animateOut: 'fadeOut',
                });

            });
        }

    }


    /*
     *	Preload background images for elements that have 'mkdf-preload-background' class
     */
    function mkdfPreloadBackgrounds(){

        $(".mkdf-preload-background").each(function() {
            var preloadBackground = $(this);
            if(preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") != "none") {

                var bgUrl = preloadBackground.attr('style');

                bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
                bgUrl = bgUrl ? bgUrl[1] : "";

                if (bgUrl) {
                    var backImg = new Image();
                    backImg.src = bgUrl;
                    $(backImg).load(function(){
                        preloadBackground.removeClass('mkdf-preload-background');
                    });
                }
            }else{
                $(window).load(function(){ preloadBackground.removeClass('mkdf-preload-background'); }); //make sure that mkdf-preload-background class is removed from elements with forced background none in css
            }
        });
    }

    function mkdfPrettyPhoto() {
        /*jshint multistr: true */
        var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="lnr lnr-chevron-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="lnr lnr-chevron-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';

        $("a[data-rel^='prettyPhoto']").prettyPhoto({
            hook: 'data-rel',
            animation_speed: 'normal', /* fast/slow/normal */
            slideshow: false, /* false OR interval time in ms */
            autoplay_slideshow: false, /* true/false */
            opacity: 0.80, /* Value between 0 and 1 */
            show_title: true, /* true/false */
            allow_resize: true, /* Resize the photos bigger than viewport. true/false */
            horizontal_padding: 0,
            default_width: 960,
            default_height: 540,
            counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
            theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
            wmode: 'opaque', /* Set the flash wmode attribute */
            autoplay: true, /* Automatically start videos: True/False */
            modal: false, /* If set to true, only the close button will close the window */
            overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
            deeplinking: false,
            custom_markup: '',
            social_tools: false,
            markup: markupWhole
        });
    }

    /*
     *	Check header style on scroll, depending on row settings
     */
    function mkdfCheckHeaderStyleOnScroll(){

        if($('[data-mkdf_header_style]').length > 0 && mkdf.body.hasClass('mkdf-header-style-on-scroll')) {

            var waypointSelectors = $('.mkdf-full-width-inner > .wpb_row.mkdf-section, .mkdf-full-width-inner > .mkdf-parallax-section-holder, .mkdf-container-inner > .wpb_row.mkdf-section, .mkdf-container-inner > .mkdf-parallax-section-holder');
            var changeStyle = function(element){
                (element.data("mkdf_header_style") !== undefined) ? mkdf.body.removeClass('mkdf-dark-header mkdf-light-header').addClass(element.data("mkdf_header_style")) : mkdf.body.removeClass('mkdf-dark-header mkdf-light-header').addClass(''+mkdf.defaultHeaderStyle);
            };

            waypointSelectors.waypoint( function(direction) {
                if(direction === 'down') { changeStyle($(this.element)); }
            }, { offset: 0});

            waypointSelectors.waypoint( function(direction) {
                if(direction === 'up') { changeStyle($(this.element)); }
            }, { offset: function(){
                return -$(this.element).outerHeight();
            } });
        }
    }

    /*
     *	Start animations on elements
     */
    function mkdfInitElementsAnimations(){

        var touchClass = $('.mkdf-no-animations-on-touch'),
            noAnimationsOnTouch = true,
            elements = $('.mkdf-grow-in, .mkdf-fade-in-down, .mkdf-element-from-fade, .mkdf-element-from-left, .mkdf-element-from-right, .mkdf-element-from-top, .mkdf-element-from-bottom, .mkdf-flip-in, .mkdf-x-rotate, .mkdf-z-rotate, .mkdf-y-translate, .mkdf-fade-in, .mkdf-fade-in-left-x-rotate'),
            animationClass,
            animationData;

        if (touchClass.length) {
            noAnimationsOnTouch = false;
        }

        if(elements.length > 0 && noAnimationsOnTouch){
            elements.each(function(){
				$(this).appear(function() {
					animationData = $(this).data('animation');
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						$(this).addClass(animationClass+'-on');
					}
                },{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            });
        }

    }


/*
 **	Sections with parallax background image
 */
function mkdfInitParallax(){
    if($('.mkdf-parallax-section-holder').length){

        $('.mkdf-parallax-section-holder').each(function() {

            var parallaxElement = $(this);
            if(parallaxElement.hasClass('mkdf-full-screen-height-parallax')){
                parallaxElement.height(mkdf.windowHeight);
                parallaxElement.find('.mkdf-parallax-content-outer').css('padding',0);
            }
            var speed = parallaxElement.data('mkdf-parallax-speed')*0.4;
            parallaxElement.parallax("50%", speed);
        });
    }
}

/*
 **	Anchor functionality
 */
var mkdfInitAnchor = mkdf.modules.common.mkdfInitAnchor = function() {

    /**
     * Set active state on clicked anchor
     * @param anchor, clicked anchor
     */
    var setActiveState = function(anchor){

        $('.mkdf-main-menu .mkdf-active-item, .mkdf-mobile-nav .mkdf-active-item, .mkdf-vertical-menu .mkdf-active-item').removeClass('mkdf-active-item');
        anchor.parent().addClass('mkdf-active-item');

        $('.mkdf-main-menu a, .mkdf-mobile-nav a, .mkdf-vertical-menu a').removeClass('current');
        anchor.addClass('current');
    };

    /**
     * Check anchor active state on scroll
     */
    var checkActiveStateOnScroll = function(){

        $('[data-mkdf-anchor]').waypoint( function(direction) {
            if(direction === 'down') {
                setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("mkdf-anchor")+"']"));
            }
        }, { offset: '50%' });

        $('[data-mkdf-anchor]').waypoint( function(direction) {
            if(direction === 'up') {
                setActiveState($("a[href='"+window.location.href.split('#')[0]+"#"+$(this.element).data("mkdf-anchor")+"']"));
            }
        }, { offset: function(){
            return -($(this.element).outerHeight() - 150);
        } });

    };

    /**
     * Check anchor active state on load
     */
    var checkActiveStateOnLoad = function(){
        var hash = window.location.hash.split('#')[1];

        if(hash !== "" && $('[data-mkdf-anchor="'+hash+'"]').length > 0){
            //triggers click which is handled in 'anchorClick' function
            var linkURL = window.location.href.split('#')[0]+"#"+hash
            $("a[href='"+linkURL+'"]').trigger( "click" );
        }
    };

    /**
     * Calculate header height to be substract from scroll amount
     * @param anchoredElementOffset, anchorded element offest
     */
    var headerHeihtToSubtract = function(anchoredElementOffset){

        if(mkdf.modules.header.behaviour == 'mkdf-sticky-header-on-scroll-down-up') {
            (anchoredElementOffset > mkdf.modules.header.stickyAppearAmount) ? mkdf.modules.header.isStickyVisible = true : mkdf.modules.header.isStickyVisible = false;
        }

        if(mkdf.modules.header.behaviour == 'mkdf-sticky-header-on-scroll-up') {
            (anchoredElementOffset > mkdf.scroll) ? mkdf.modules.header.isStickyVisible = false : '';
        }

        var headerHeight = mkdf.modules.header.isStickyVisible ? mkdfGlobalVars.vars.mkdfStickyHeaderTransparencyHeight : mkdfPerPageVars.vars.mkdfHeaderTransparencyHeight;

        return headerHeight;
    };

    /**
     * Handle anchor click
     */
    var anchorClick = function() {
        mkdf.document.on("click", ".mkdf-main-menu a, .mkdf-vertical-menu a, .mkdf-btn, .mkdf-anchor, .mkdf-mobile-nav a", function() {
            var scrollAmount;
            var anchor = $(this);
            var hash = anchor.prop("hash").split('#')[1];

            if(hash !== "" && $('[data-mkdf-anchor="' + hash + '"]').length > 0 /*&& anchor.attr('href').split('#')[0] == window.location.href.split('#')[0]*/) {

                var anchoredElementOffset = $('[data-mkdf-anchor="' + hash + '"]').offset().top;
                scrollAmount = $('[data-mkdf-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset);

                setActiveState(anchor);

                mkdf.html.stop().animate({
                    scrollTop: Math.round(scrollAmount)
                }, 1000, function() {
                    //change hash tag in url
                    if(history.pushState) { history.pushState(null, null, '#'+hash); }
                });
                return false;
            }
        });
    };

    return {
        init: function() {
            if($('[data-mkdf-anchor]').length) {
                anchorClick();
                checkActiveStateOnScroll();
                $(window).load(function() { checkActiveStateOnLoad(); });
            }
        }
    };

};

/*
 **	Video background initialization
 */
function mkdfInitVideoBackground(){

    $('.mkdf-section .mkdf-video-wrap .mkdf-video').mediaelementplayer({
        enableKeyboard: false,
        iPadUseNativeControls: false,
        pauseOtherPlayers: false,
        // force iPhone's native controls
        iPhoneUseNativeControls: false,
        // force Android's native controls
        AndroidUseNativeControls: false
    });

    //mobile check
    if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
        mkdfInitVideoBackgroundSize();
        $('.mkdf-section .mkdf-mobile-video-image').show();
        $('.mkdf-section .mkdf-video-wrap').remove();
    }
}

    /*
     **	Calculate video background size
     */
    function mkdfInitVideoBackgroundSize(){

        $('.mkdf-section .mkdf-video-wrap').each(function(){

            var element = $(this);
            var sectionWidth = element.closest('.mkdf-section').outerWidth();
            element.width(sectionWidth);

            var sectionHeight = element.closest('.mkdf-section').outerHeight();
            mkdf.minVideoWidth = mkdf.videoRatio * (sectionHeight+20);
            element.height(sectionHeight);

            var scaleH = sectionWidth / mkdf.videoWidthOriginal;
            var scaleV = sectionHeight / mkdf.videoHeightOriginal;
            var scale =  scaleV;
            if (scaleH > scaleV)
                scale =  scaleH;
            if (scale * mkdf.videoWidthOriginal < mkdf.minVideoWidth) {scale = mkdf.minVideoWidth / mkdf.videoWidthOriginal;}

            element.find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * mkdf.videoWidthOriginal +2));
            element.find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * mkdf.videoHeightOriginal +2));
            element.scrollLeft((element.find('video').width() - sectionWidth) / 2);
            element.find('.mejs-overlay, .mejs-poster').scrollTop((element.find('video').height() - (sectionHeight)) / 2);
            element.scrollTop((element.find('video').height() - sectionHeight) / 2);
        });

    }

    /*
     **	Set content bottom margin because of the uncovering footer
     */
    function mkdfSetContentBottomMargin(){
        var uncoverFooter = $('.mkdf-footer-uncover');

        if(uncoverFooter.length){
            $('.mkdf-content').css('margin-bottom', $('.mkdf-footer-inner').height());
        }
    }

	/*
	** Initiate Smooth Scroll
	*/
	//function mkdfSmoothScroll(){
	//
	//	if(mkdf.body.hasClass('mkdf-smooth-scroll')){
	//
	//		var scrollTime = 0.4;			//Scroll time
	//		var scrollDistance = 300;		//Distance. Use smaller value for shorter scroll and greater value for longer scroll
	//
	//		var mobile_ie = -1 !== navigator.userAgent.indexOf("IEMobile");
	//
	//		var smoothScrollListener = function(event){
	//			event.preventDefault();
	//
	//			var delta = event.wheelDelta / 120 || -event.detail / 3;
	//			var scrollTop = mkdf.window.scrollTop();
	//			var finalScroll = scrollTop - parseInt(delta * scrollDistance);
	//
	//			TweenLite.to(mkdf.window, scrollTime, {
	//				scrollTo: {
	//					y: finalScroll, autoKill: !0
	//				},
	//				ease: Power1.easeOut,
	//				autoKill: !0,
	//				overwrite: 5
	//			});
	//		};
	//
	//		if (!$('html').hasClass('touch') && !mobile_ie) {
	//			if (window.addEventListener) {
	//				window.addEventListener('mousewheel', smoothScrollListener, false);
	//				window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
	//			}
	//		}
	//	}
	//}

    function mkdfDisableScroll() {

        if (window.addEventListener) {
            window.addEventListener('DOMMouseScroll', mkdfWheel, false);
        }
        window.onmousewheel = document.onmousewheel = mkdfWheel;
        document.onkeydown = mkdfKeydown;

        if(mkdf.body.hasClass('mkdf-smooth-scroll')){
            window.removeEventListener('mousewheel', smoothScrollListener, false);
            window.removeEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function mkdfEnableScroll() {
        if (window.removeEventListener) {
            window.removeEventListener('DOMMouseScroll', mkdfWheel, false);
        }
        window.onmousewheel = document.onmousewheel = document.onkeydown = null;

        if(mkdf.body.hasClass('mkdf-smooth-scroll')){
            window.addEventListener('mousewheel', smoothScrollListener, false);
            window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
        }
    }

    function mkdfWheel(e) {
        mkdfPreventDefaultValue(e);
    }

    function mkdfKeydown(e) {
        var keys = [37, 38, 39, 40];

        for (var i = keys.length; i--;) {
            if (e.keyCode === keys[i]) {
                mkdfPreventDefaultValue(e);
                return;
            }
        }
    }

    function mkdfPreventDefaultValue(e) {
        e = e || window.event;
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.returnValue = false;
    }

    function mkdfInitSelfHostedVideoPlayer() {

        var players = $('.mkdf-self-hosted-video');
            players.mediaelementplayer({
                audioWidth: '100%'
            });
    }

	function mkdfSelfHostedVideoSize(){

		$('.mkdf-self-hosted-video-holder .mkdf-video-wrap').each(function(){
			var thisVideo = $(this);

			var videoWidth = thisVideo.closest('.mkdf-self-hosted-video-holder').outerWidth();
			var videoHeight = videoWidth / mkdf.videoRatio;

			if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
				thisVideo.parent().width(videoWidth);
				thisVideo.parent().height(videoHeight);
			}

			thisVideo.width(videoWidth);
			thisVideo.height(videoHeight);

			thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
			thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
		});
	}

    function mkdfToTopButton(a) {

        var b = $("#mkdf-back-to-top");
        b.removeClass('off on');
        if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
    }

    function mkdfBackButtonShowHide(){
        mkdf.window.scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) { d = b + c / 2; } else { d = 1; }
            if (d < 1e3) { mkdfToTopButton('off'); } else { mkdfToTopButton('on'); }
        });
    }

    function mkdfInitBackToTop(){
        var backToTopButton = $('#mkdf-back-to-top');
        backToTopButton.on('click',function(e){
            e.preventDefault();
            mkdf.html.animate({scrollTop: 0}, mkdf.window.scrollTop()/2, 'easeInOutQuint');
        });
    }

    function mkdfSmoothTransition() {
		var loader = $('body > .mkdf-smooth-transition-loader.mkdf-mimic-ajax');
        if (loader.length) {
            loader.fadeOut(500);
			$(window).bind('pageshow', function(event) {
				if (event.originalEvent.persisted) {
					loader.fadeOut(500);
				}
			});

            $('a').click(function(e) {
                var a = $(this);
                if (
                    e.which == 1 && // check if the left mouse button has been pressed
                    a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
					(typeof a.data('rel') === 'undefined') && //Not pretty photo link
                    (typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                    (typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
                    (a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
                ) {
                    e.preventDefault();
                    loader.addClass('mkdf-hide-spinner');
                    loader.fadeIn(500, function() {
                        window.location = a.attr('href');
                    });
                }
            });
        }
    }

	function mkdfInitCustomMenuDropdown() {
		var menus = $('.mkdf-sidebar .widget_nav_menu .menu');

		var dropdownOpeners,
			currentMenu;


		if(menus.length) {
			menus.each(function() {
				currentMenu = $(this);

				dropdownOpeners = currentMenu.find('li.menu-item-has-children > a');

				if(dropdownOpeners.length) {
					dropdownOpeners.each(function() {
						var currentDropdownOpener = $(this);

						currentDropdownOpener.on('click', function(e) {
							e.preventDefault();

							var dropdownToOpen = currentDropdownOpener.parent().children('.sub-menu');

							if(dropdownToOpen.is(':visible')) {
								dropdownToOpen.hide();
								currentDropdownOpener.removeClass('mkdf-custom-menu-active');
							} else {
								dropdownToOpen.show();
								currentDropdownOpener.addClass('mkdf-custom-menu-active');
							}
						});
					});
				}
			});
		}
	}

    /*
    * Follow animation for search ordering
    */
    function mkdfInitOrderingFollowLine() {
        var orderingLists = $('.mkdf-search-ordering-list');
        if (orderingLists.length) {
            orderingLists.each(function(){
                var orderingList = $(this),
                    tab = orderingList.find('li'),
                    tabLine = orderingList.find('.mkdf-tab-line');

                    tabLine.css({width: tab.first().find('> a').outerWidth()});
                    tabLine.css({left: 0});

                    if (tab.height() == tab.parent('ul').height()) { //tabs are in the same line, default layout
                        tab.each(function(){
                            var thisTab = $(this);
                            thisTab.mouseenter(function(){
                                tabLine.css({width: thisTab.find('> a').outerWidth()});
                                tabLine.css({left: thisTab.find('> a').offset().left - thisTab.parent().offset().left});
                            });
                        });

                        orderingList.mouseleave(function(){
                            tabLine.css({width: tab.filter('.mkdf-search-ordering-item-active').find('> a').outerWidth()});
                            tabLine.css({left: tab.filter('.mkdf-search-ordering-item-active').find('> a').offset().left - tab.filter('.mkdf-search-ordering-item-active').parent().offset().left});
                        });
                    } else { //tabs are on top of each other, responsive layout
                        tab.each(function(){
                            tabLine.css({width: tab.outerWidth()});
                            tabLine.css({left: 'auto'});
                            var thisTab = $(this);
                            thisTab.click(function(){
                                tabLine.css({top: thisTab.offset().top - thisTab.parent().offset().top + thisTab.height()});
                            });
                        });
                    }
            });
        }
    }

    /*
    * Follow animation for membership pages
    */ 
    function mkdfInitMembershipFollowLine() {
        var membershipPages = $('.page-template-user-dashboard');
        if (membershipPages.length) {
            membershipPages.each(function(){
                var membershipPage = $(this),
                    dashboard = membershipPage.find('.mkdf-membership-dashboard-nav'),
                    registerPanel = membershipPage.find('.mkdf-login-register-content ');

                // logged in
                if (dashboard.length) {
                    var tab = dashboard.find('li'),
                        tabLine = dashboard.find('.mkdf-tab-line');


                    tabLine.css({height: dashboard.find('.mkdf-active-dash').outerHeight()});
                    tabLine.css({top: dashboard.find('.mkdf-active-dash').offset().top - dashboard.offset().top});

                    tab.each(function(){
                        var thisTab = $(this);
                        thisTab.mouseenter(function(){
                            tabLine.css({height: thisTab.find('> a').outerHeight()});
                            tabLine.css({top: thisTab.offset().top - thisTab.parent().offset().top});
                        });
                    });

                    dashboard.find('> ul').mouseleave(function(){
                        tabLine.css({height: tab.filter('.mkdf-active-dash').find('> a').outerHeight()});
                        tabLine.css({top: tab.filter('.mkdf-active-dash').offset().top - tab.filter('.mkdf-active-dash').parent().offset().top});
                    });
                }
                // logged out 
                else {
                    var tab = registerPanel.find('li'),
                        tabLine = registerPanel.find('.mkdf-tab-line');

                    tabLine.css({width: tab.first().find('> a').outerWidth()});
                    tabLine.css({left: 0});

                    tab.each(function(){
                        var thisTab = $(this);
                        thisTab.mouseenter(function(){
                            tabLine.css({width: thisTab.find('> a').outerWidth()});
                            tabLine.css({left: thisTab.offset().left - thisTab.parent().offset().left});
                        });
                    });

                    registerPanel.find('> ul').mouseleave(function(){
                        tabLine.css({width: tab.filter('.ui-tabs-active').find('> a').outerWidth()});
                        tabLine.css({left: tab.filter('.ui-tabs-active').find('> a').offset().left - tab.filter('.ui-tabs-active').parent().offset().left});
                    });
                }

            });
        }
    }

})(jQuery);