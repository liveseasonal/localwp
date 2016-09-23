(function($) {
    "use strict";

    window.mkdf = {};
    mkdf.modules = {};

    mkdf.scroll = 0;
    mkdf.window = $(window);
    mkdf.document = $(document);
    mkdf.windowWidth = $(window).width();
    mkdf.windowHeight = $(window).height();
    mkdf.body = $('body');
    mkdf.html = $('html, body');
    mkdf.htmlEl = $('html');
    mkdf.menuDropdownHeightSet = false;
    mkdf.defaultHeaderStyle = '';
    mkdf.minVideoWidth = 1500;
    mkdf.videoWidthOriginal = 1280;
    mkdf.videoHeightOriginal = 720;
    mkdf.videoRatio = 1280/720;

    mkdf.mkdfOnDocumentReady = mkdfOnDocumentReady;
    mkdf.mkdfOnWindowLoad = mkdfOnWindowLoad;
    mkdf.mkdfOnWindowResize = mkdfOnWindowResize;
    mkdf.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
        mkdf.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(mkdf.body.hasClass('mkdf-dark-header')){ mkdf.defaultHeaderStyle = 'mkdf-dark-header';}
        if(mkdf.body.hasClass('mkdf-light-header')){ mkdf.defaultHeaderStyle = 'mkdf-light-header';}

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
        mkdf.windowWidth = $(window).width();
        mkdf.windowHeight = $(window).height();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdfOnWindowScroll() {
        mkdf.scroll = $(window).scrollTop();
    }



    //set boxed layout width variable for various calculations

    switch(true){
        case mkdf.body.hasClass('mkdf-grid-1300'):
            mkdf.boxedLayoutWidth = 1350;
            break;
        case mkdf.body.hasClass('mkdf-grid-1200'):
            mkdf.boxedLayoutWidth = 1250;
            break;
        case mkdf.body.hasClass('mkdf-grid-1000'):
            mkdf.boxedLayoutWidth = 1050;
            break;
        case mkdf.body.hasClass('mkdf-grid-800'):
            mkdf.boxedLayoutWidth = 850;
            break;
        default :
            mkdf.boxedLayoutWidth = 1150;
            break;
    }

})(jQuery);
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
(function($) {
    'use strict';

    var ajax = {};

    mkdf.modules.ajax = ajax;

    var animation = {};
    ajax.animation = animation;

    ajax.mkdfFetchPage = mkdfFetchPage;
    ajax.mkdfInitAjax = mkdfInitAjax;
    ajax.mkdfHandleLinkClick = mkdfHandleLinkClick;
    ajax.mkdfInsertFetchedContent = mkdfInsertFetchedContent;
    ajax.mkdfInitBackBehavior = mkdfInitBackBehavior;
    ajax.mkdfSetActiveState = mkdfSetActiveState;
    ajax.mkdfReinitiateAll = mkdfReinitiateAll;
    ajax.mkdfHandleMeta = mkdfHandleMeta;

    ajax.mkdfOnDocumentReady = mkdfOnDocumentReady;
    ajax.mkdfOnWindowLoad = mkdfOnWindowLoad;
    ajax.mkdfOnWindowResize = mkdfOnWindowResize;
    ajax.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
        mkdfInitAjax();
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


    var loadedPageFlag = true; // Indicates whether the page is loaded
    var firstLoad = true; // Indicates whether this is the first loaded page, for back button functionality
    animation.type = null;
    animation.time = 500; // Duration of animation for the content to be changed
    animation.simultaneous = true; // False indicates that the new content should wait for the old content to disappear, true means that it appears at the same time as the old content disappears
    animation.loader = null;
    animation.loaderTime = 500;

    /**
     * Fetching the targeted page
     */
    function mkdfFetchPage(params, destinationSelector, targetSelector) {

        function setDefaultParam(key,value) {
            params[key] = typeof params[key] !== 'undefined' ? params[key] : value;
        }

        destinationSelector = typeof destinationSelector !== 'undefined' ? destinationSelector : '.mkdf-content';
        targetSelector = typeof targetSelector !== 'undefined' ? targetSelector : '.mkdf-content';
        
        // setting default ajax parameters
        params = typeof params !== 'undefined' ? params : {};

        setDefaultParam('url', window.location.href);
        setDefaultParam('type', 'POST');
        setDefaultParam('success', function(response) {
            var jResponse = $(response);

            var meta = jResponse.find('.mkdf-meta'); 
            if (meta.length) { mkdfHandleMeta(meta); }

            var new_content = jResponse.find(targetSelector);
            if (!new_content.length) {
                loadedPageFlag = true;
                return false;
            }
            else {
                mkdfInsertFetchedContent(params.url, new_content, destinationSelector);
            }
        });

        // setting data parameters
        setDefaultParam('ajaxReq', 'yes');
        //setDefaultParam('hasHeader', mkdf.body.find('header').length ? true : false);
        //setDefaultParam('hasFooter', mkdf.body.find('footer').length ? true : false);

        $.ajax({
            url: params.url,
            type: params.type,
            data: {
                ajaxReq: params.ajaxReq
                //hasHeader: params.hasHeader,
                //hasFooter: params.hasFooter
            },
            success: params.success
        });
    }

    function mkdfInitAjax() {
        mkdf.body.removeClass('page-not-loaded'); // Might be necessary for ajax calls
		animation.loader = $('body > .mkdf-smooth-transition-loader.mkdf-ajax');
        if (animation.loader.length) {
            animation.loader.fadeOut(animation.loaderTime);
            $(window).focus(function() {
                animation.loader.fadeOut(animation.loaderTime);
            });

            if(mkdf.body.hasClass('woocommerce') || mkdf.body.hasClass('woocommerce-page')) {
                return false;
            }
            else {
                mkdfInitBackBehavior();
                $(document).on('click', 'a[target!="_blank"]:not(.no-ajax):not(.no-link)', function(click) {
                    var link = $(this);

                    if(click.ctrlKey == 1) { // Check if CTRL key is held with the click
                        window.open(link.attr('href'), '_blank');
                        return false;
                    }

                    if(link.parents('.mkdf-blog-load-more-button').length){ return false; } // Don't initiate ajax for blog load more link

                    if(link.parents('mkdf-post-info-comments').length){ // If it's a comment link, don't load any content, just scroll to the comments section
                        var hash = link.attr('href').split("#")[1];  
                        $('html, body').scrollTop( $("#"+hash).offset().top );  
                        return false;  
                    }

                    if(window.location.href.split('#')[0] == link.attr('href').split('#')[0]){ return false; } //  If the link leads to the same page, don't use ajax

                    if(link.closest('.mkdf-no-animation').length === 0){ // If no parents are set to no-animation...

                        if(document.location.href.indexOf("?s=") >= 0){ // Don't use ajax if currently on search page
                            return true;
                        }
                        if(link.attr('href').indexOf("wp-admin") >= 0){ // Don't use ajax for wp-admin
                            return true;
                        }
                        if(link.attr('href').indexOf("wp-content") >= 0){ // Don't use ajax for wp-content
                            return true;
                        }

                        if(jQuery.inArray(link.attr('href').split('#')[0], mkdfGlobalVars.vars.no_ajax_pages) !== -1){ // If the target page is a no-ajax page, don't use ajax
                            document.location.href = link.attr('href');
                            return false;
                        }

                        if((link.attr('href') !== "http://#") && (link.attr('href') !== "#")){ // Don't use ajax if the link is empty
                            //disableHashChange = true;

                            var url = link.attr('href');
                            var start = url.indexOf(window.location.protocol + '//' + window.location.host); // Check if the link leads to the same domain
                            if(start === 0){
                                if(!loadedPageFlag){ return false; } //if page is not loaded don't load next one
                                click.preventDefault();
                                click.stopImmediatePropagation();
                                click.stopPropagation();
                                if (!link.is('.current')) {
                                    mkdfHandleLinkClick(link);
                                }
                            }

                        }else{
                            return false;
                        }
                    }
                });
            }
        }
    }

    function mkdfInitBackBehavior() {
        if (window.history.pushState) {
            /* the below code is to override back button to get the ajax content without reload*/
            $(window).bind('popstate', function() {
                "use strict";

                var url = location.href;
                if (!firstLoad && loadedPageFlag) {
                    loadedPageFlag = false;
                    mkdfFetchPage({
                        url: url
                    });
                }
            });
        }
    }

    function mkdfHandleLinkClick(link) {
        loadedPageFlag = false;
        animation.loader.fadeIn(animation.loaderTime);
        mkdfFetchPage({
            url: link.attr('href')
        });
    }

    function mkdfSetActiveState(url) {
        var me = $("nav a[href='"+url+"'], .widget_nav_menu a[href='"+url+"']");

		$('.mkdf-main-menu a, .mkdf-mobile-nav a, .mkdf-mobile-nav h4, .mkdf-vertical-menu a, .popup_menu a, .widget_nav_menu a').removeClass('current').parent().removeClass('mkdf-active-item');
		//$('.main_menu a, .mobile_menu a, .mobile_menu h4, .vertical_menu a, .popup_menu a').parent().removeClass('active');
		$('.widget_nav_menu ul.menu > li').removeClass('current-menu-item');

        me.each(function() {
            var me = $(this);

            if(me.closest('.second').length === 0){
                me.parent().addClass('mkdf-active-item');
            }else{
                me.closest('.second').parent().addClass('mkdf-active-item');
            }

            if(me.closest('.mkdf-mobile-nav').length > 0){
                me.closest('.level0').addClass('mkdf-active-item');
                me.closest('.level1').addClass('mkdf-active-item');
                me.closest('.level2').addClass('mkdf-active-item');
            }

            if(me.closest('.widget_nav_menu').length > 0){
                me.closest('.widget_nav_menu').find('.menu-item').addClass('current-menu-item');
            }


            //$('.mkdf-main-menu a, .mkdf-mobile-nav a, .mkdf-vertical-menu a, .popup_menu a').removeClass('current');
            me.addClass('current');
        });
    }

    function mkdfReinitiateAll() {
        $(document).off(); // Remove all event handlers before reinitialization
		$(window).off();
        mkdf.body.off().find('*').off(); // Remove all event handlers before reinitialization

        mkdf.mkdfOnDocumentReady();
        mkdf.mkdfOnWindowLoad();
        mkdf.mkdfOnWindowResize();
        mkdf.mkdfOnWindowScroll();

        var modules = ['common', 'ajax', 'header', 'title', 'shortcodes', 'woocommerce', 'blog', 'like'];
        for (var i=0; i<modules.length; i++) {
            if (1 || typeof mkdf.modules[modules[i]] !== 'undefined') {
                mkdf.modules[modules[i]].mkdfOnDocumentReady();
                mkdf.modules[modules[i]].mkdfOnWindowLoad();
                mkdf.modules[modules[i]].mkdfOnWindowResize();
                mkdf.modules[modules[i]].mkdfOnWindowScroll();
            }
        }
    }

    function mkdfHandleMeta(meta_data) {
        // set up title, meta description and meta keywords
        var newTitle = meta_data.find(".mkdf-seo-title").text();
        var pageTransition = meta_data.find(".mkdf-page-transition").text();
        var newDescription = meta_data.find(".mkdf-seo-description").text();
        var newKeywords = meta_data.find(".mkdf-seo-keywords").text();
        if (typeof pageTransition !== 'undefined') {
            animation.type = pageTransition;
        } 
        if ($('head meta[name="description"]').length) {
            $('head meta[name="description"]').attr('content', newDescription);
        } else if (typeof newDescription !== 'undefined') {
            $('<meta name="description" content="'+newDescription+'">').prependTo($('head'));
        } 
        if ($('head meta[name="keywords"]').length) {
            $('head meta[name="keywords"]').attr('content', newKeywords);
        } else if (typeof newKeywords !== 'undefined') {
            $('<meta name="keywords" content="'+newKeywords+'">').prependTo($('head'));
        } 
        document.title = newTitle;

        var newBodyClasses = meta_data.find(".mkdf-body-classes").text();
        var myArray = newBodyClasses.split(',');
        mkdf.body.removeClass();
        for(var i=0;i<myArray.length;i++){
            if (myArray[i] !== "mkdf-page-not-loaded"){
                mkdf.body.addClass(myArray[i]);
            }
        }

        if($("#wp-admin-bar-edit").length > 0){
            // set up edit link when wp toolbar is enabled
            var pageId = meta_data.find("#mkdf-page-id").text();
            var old_link = $('#wp-admin-bar-edit a').attr("href");
            var new_link = old_link.replace(/(post=).*?(&)/,'$1' + pageId + '$2');
            $('#wp-admin-bar-edit a').attr("href", new_link);
        }
    }

    function mkdfInsertFetchedContent(url, new_content, destinationSelector) {
        destinationSelector = typeof destinationSelector !== 'undefined' ? destinationSelector : '.mkdf-content';
        var destination = mkdf.body.find(destinationSelector);
        
        new_content.height(destination.height()).css({'position': 'absolute', 'opacity': 0, 'overflow': 'hidden'}).insertBefore(destination);
       
        new_content.waitForImages(function() {
            if (url.indexOf('#') !== -1) {
                $('<a class="mkdf-temp-anchor mkdf-anchor" href="'+url+'" style="display: none"></a>').appendTo('body');
            }
            mkdfReinitiateAll();

            if (animation.type == "fade") {
                destination.stop().fadeTo(animation.time, 0, function() {
                    destination.remove();
                    if (window.history.pushState) {
                        if(url!==window.location.href){
                            window.history.pushState({path:url},'',url);
                        }

                        //does Google Analytics code exists on page?
                        if(typeof _gaq !== 'undefined') {
                            //add new url to Google Analytics so it can be tracked
                            _gaq.push(['_trackPageview', url]);
                        }
                    } else {
                        document.location.href = window.location.protocol + '//' + window.location.host + '#' + url.split(window.location.protocol + '//' + window.location.host)[1];
                    }
                    mkdfSetActiveState(url);
                    mkdf.body.animate({scrollTop: 0}, animation.time, 'swing');
                });
                setTimeout(function() {
                    new_content.css('position','relative').height('').stop().fadeTo(animation.time, 1, function() {
                        loadedPageFlag = true;
                        firstLoad = false;
                        animation.loader.fadeOut(animation.loaderTime, function() {
                            var anch = $('.mkdf-temp-anchor');
                            if (anch.length) {
                                anch.trigger('click').remove();
                            }
                        });
                    });
                }, !animation.simultaneous * animation.time);
            }
        });
    }


})(jQuery);
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
(function($) {
    "use strict";

    var title = {};
    mkdf.modules.title = title;

    title.mkdfParallaxTitle = mkdfParallaxTitle;

    title.mkdfOnDocumentReady = mkdfOnDocumentReady;
    title.mkdfOnWindowLoad = mkdfOnWindowLoad;
    title.mkdfOnWindowResize = mkdfOnWindowResize;
    title.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
        mkdfParallaxTitle();
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
    

    /*
     **	Title image with parallax effect
     */
    function mkdfParallaxTitle(){
        if($('.mkdf-title.mkdf-has-parallax-background').length > 0 && $('.touch').length === 0){

            var parallaxBackground = $('.mkdf-title.mkdf-has-parallax-background');
            var parallaxBackgroundWithZoomOut = $('.mkdf-title.mkdf-has-parallax-background.mkdf-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(mkdf.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({'background-position': 'center '+ (titleYPos+mkdfGlobalVars.vars.mkdfAddForAdminBar) +'px' });
            parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-mkdf.scroll + 'px auto'});

            //set position of background on window scroll
            $(window).scroll(function() {
                titleYPos = -(mkdf.scroll * titleRate);
                parallaxBackground.css({'background-position': 'center ' + (titleYPos+mkdfGlobalVars.vars.mkdfAddForAdminBar) + 'px' });
                parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-mkdf.scroll + 'px auto'});
            });

        }
    }

})(jQuery);

(function($) {
    'use strict';

    var shortcodes = {};

    mkdf.modules.shortcodes = shortcodes;

    shortcodes.mkdfInitCounter = mkdfInitCounter;
    shortcodes.mkdfInitProgressBars = mkdfInitProgressBars;
    shortcodes.mkdfInitCountdown = mkdfInitCountdown;
    shortcodes.mkdfInitMessages = mkdfInitMessages;
    shortcodes.mkdfInitMessageHeight = mkdfInitMessageHeight;
    shortcodes.mkdfInitTestimonials = mkdfInitTestimonials;
    shortcodes.mkdfInitCarousels = mkdfInitCarousels;
    shortcodes.mkdfInitPieChart = mkdfInitPieChart;
    shortcodes.mkdfInitPieChartDoughnut = mkdfInitPieChartDoughnut;
    shortcodes.mkdfInitTabs = mkdfInitTabs;
    shortcodes.mkdfInitTabIcons = mkdfInitTabIcons;
    shortcodes.mkdfInitBlogListMasonry = mkdfInitBlogListMasonry;
    shortcodes.mkdfCustomFontResize = mkdfCustomFontResize;
    shortcodes.mkdfInitImageGallery = mkdfInitImageGallery;
    shortcodes.mkdfInitAccordions = mkdfInitAccordions;
    shortcodes.mkdfShowGoogleMap = mkdfShowGoogleMap;
    shortcodes.mkdfInfoBox = mkdfInfoBox;
    shortcodes.mkdfProcess = mkdfProcess;
    shortcodes.blogCarousel = blogCarousel;
    shortcodes.mkdfComparisonPricingTables = mkdfComparisonPricingTables;
    shortcodes.mkdfProgressBarVertical = mkdfProgressBarVertical;
    shortcodes.mkdfIconProgressBar = mkdfIconProgressBar;
    shortcodes.mkdfBlogSlider = mkdfBlogSlider;
    shortcodes.mkdfOnDocumentReady = mkdfOnDocumentReady;
    shortcodes.mkdfOnWindowLoad = mkdfOnWindowLoad;
    shortcodes.mkdfOnWindowResize = mkdfOnWindowResize;
    shortcodes.mkdfOnWindowScroll = mkdfOnWindowScroll;
    shortcodes.emptySpaceResponsive = emptySpaceResponsive;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitCounter();
        mkdfInitProgressBars();
        mkdfInitCountdown();
        mkdfIcon().init();
        mkdfInitMessages();
        mkdfInitMessageHeight();
        mkdfInitTestimonials();
        mkdfInitCarousels();
        mkdfInitPieChart();
        mkdfInitPieChartDoughnut();
        mkdfInitTabs();
        mkdfInitTabIcons();
        blogCarousel();
        mkdfButton().init();
        mkdfInitBlogListMasonry();
        mkdfCustomFontResize();
        mkdfInitImageGallery();
        mkdfBlogSlider();
        mkdfInitAccordions();
        mkdfShowGoogleMap();
        mkdfSocialIconWidget().init();
        mkdfProcess().init();
        mkdfComparisonPricingTables().init();
        mkdfProgressBarVertical().init();
        mkdfIconProgressBar().init();
        emptySpaceResponsive().init();
    }

    /* 
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInfoBox();
    }

    /* 
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {
        mkdfInitBlogListMasonry();
        mkdfCustomFontResize();
    }

    /* 
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {

    }


    /**
     * Counter Shortcode
     */
    function mkdfInitCounter() {

        var counters = $('.mkdf-counter');


        if(counters.length) {
            counters.each(function() {
                var counter = $(this);
                counter.appear(function() {
                    counter.parent().addClass('mkdf-counter-holder-show');

                    //Counter zero type
                    if(counter.hasClass('zero')) {
                        var max = parseFloat(counter.text());
                        counter.countTo({
                            from: 0,
                            to: max,
                            speed: 1500,
                            refreshInterval: 100
                        });
                    } else {
                        counter.absoluteCounter({
                            speed: 2000,
                            fadeInDelay: 1000
                        });
                    }

                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            });
        }

    }

    /*
     **	Horizontal progress bars shortcode
     */
    function mkdfInitProgressBars() {

        var progressBar = $('.mkdf-progress-bar');

        if(progressBar.length) {

            progressBar.each(function() {

                var thisBar = $(this);

                thisBar.appear(function() {
                    mkdfInitToCounterProgressBar(thisBar);
                    if(thisBar.find('.mkdf-floating.mkdf-floating-inside') !== 0) {
                        var floatingInsideMargin = thisBar.find('.mkdf-progress-content').height();
                        floatingInsideMargin += parseFloat(thisBar.find('.mkdf-progress-title-holder').css('padding-bottom'));
                        floatingInsideMargin += parseFloat(thisBar.find('.mkdf-progress-title-holder').css('margin-bottom'));
                        thisBar.find('.mkdf-floating-inside').css('margin-bottom', -(floatingInsideMargin) + 'px');
                    }
                    var percentage = thisBar.find('.mkdf-progress-content').data('percentage'),
                        progressContent = thisBar.find('.mkdf-progress-content'),
                        progressNumber = thisBar.find('.mkdf-progress-number');

                    progressContent.css('width', '0%');
                    progressContent.animate({'width': percentage + '%'}, 1500);
                    progressNumber.css('left', '0%');
                    progressNumber.animate({'left': percentage + '%'}, 1500);

                });
            });
        }
    }

    /*
     **	Counter for horizontal progress bars percent from zero to defined percent
     */
    function mkdfInitToCounterProgressBar(progressBar) {
        var percentage = parseFloat(progressBar.find('.mkdf-progress-content').data('percentage'));
        var percent = progressBar.find('.mkdf-progress-number .mkdf-percent');
        if(percent.length) {
            percent.each(function() {
                var thisPercent = $(this);
                thisPercent.parents('.mkdf-progress-number-wrapper').css('opacity', '1');
                thisPercent.countTo({
                    from: 0,
                    to: percentage,
                    speed: 1500,
                    refreshInterval: 50
                });
            });
        }
    }

    /*
     **	Function to close message shortcode
     */
    function mkdfInitMessages() {
        var message = $('.mkdf-message');
        if(message.length) {
            message.each(function() {
                var thisMessage = $(this);
                thisMessage.find('.mkdf-close').click(function(e) {
                    e.preventDefault();
                    $(this).parent().parent().fadeOut(500);
                });
            });
        }
    }

    /*
     **	Init message height
     */
    function mkdfInitMessageHeight() {
        var message = $('.mkdf-message.mkdf-with-icon');
        if(message.length) {
            message.each(function() {
                var thisMessage = $(this);
                var textHolderHeight = thisMessage.find('.mkdf-message-text-holder').height();
                var iconHolderHeight = thisMessage.find('.mkdf-message-icon-holder').height();

                if(textHolderHeight > iconHolderHeight) {
                    thisMessage.find('.mkdf-message-icon-holder').height(textHolderHeight);
                } else {
                    thisMessage.find('.mkdf-message-text-holder').height(iconHolderHeight);
                }
            });
        }
    }

    /**
     * Countdown Shortcode
     */
    function mkdfInitCountdown() {

        var countdowns = $('.mkdf-countdown'),
            year,
            month,
            day,
            hour,
            minute,
            timezone,
            monthLabel,
            dayLabel,
            hourLabel,
            minuteLabel,
            secondLabel;

        if(countdowns.length) {

            countdowns.each(function() {

                //Find countdown elements by id-s
                var countdownId = $(this).attr('id'),
                    countdown = $('#' + countdownId),
                    digitFontSize,
                    labelFontSize;

                //Get data for countdown
                year = countdown.data('year');
                month = countdown.data('month');
                day = countdown.data('day');
                hour = countdown.data('hour');
                minute = countdown.data('minute');
                timezone = countdown.data('timezone');
                monthLabel = countdown.data('month-label');
                dayLabel = countdown.data('day-label');
                hourLabel = countdown.data('hour-label');
                minuteLabel = countdown.data('minute-label');
                secondLabel = countdown.data('second-label');
                digitFontSize = countdown.data('digit-size');
                labelFontSize = countdown.data('label-size');


                //Initialize countdown
                countdown.countdown({
                    until: new Date(year, month - 1, day, hour, minute, 44),
                    labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
                    format: 'ODHMS',
                    timezone: timezone,
                    padZeroes: true,
                    onTick: setCountdownStyle
                });

                function setCountdownStyle() {
                    countdown.find('.countdown-amount').css({
                        'font-size': digitFontSize + 'px',
                        'line-height': digitFontSize + 'px'
                    });
                    countdown.find('.countdown-period').css({
                        'font-size': labelFontSize + 'px'
                    });
                }

            });

        }

    }

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdfIcon = mkdf.modules.shortcodes.mkdfIcon = function() {
        //get all icons on page
        var icons = $('.mkdf-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function(icon) {
            if(icon.hasClass('mkdf-icon-animation')) {
                icon.appear(function() {
                    icon.parent('.mkdf-icon-animation-holder').addClass('mkdf-icon-animation-show');
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.mkdf-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function(icon) {
            if(typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function(event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.css('background-color');

                if(hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function(icon) {
            if(typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function(event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.css('border-color');

                if(hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });

                }
            }
        };
    };

    /**
     * Object that represents social icon widget
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdfSocialIconWidget = mkdf.modules.shortcodes.mkdfSocialIconWidget = function() {
        //get all social icons on page
        var icons = $('.mkdf-social-icon-widget-holder');

        /**
         * Function that triggers icon hover color functionality
         */
        var socialIconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon;
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        socialIconHoverColor($(this));
                    });

                }
            }
        };
    };

    /**
     * Init testimonials shortcode
     */
    function mkdfInitTestimonials() {

        var testimonial = $('.mkdf-testimonials.testimonials-slider');
        if(testimonial.length) {
            testimonial.each(function() {

                var thisTestimonial = $(this);

                thisTestimonial.waitForImages(function(){
                    thisTestimonial.css('visibility','visible');
                });

                var animationSpeed = 400;
                if(typeof thisTestimonial.data('animation-speed') !== 'undefined' && thisTestimonial.data('animation-speed') !== false) {
                    animationSpeed = thisTestimonial.data('animation-speed');
                }

                if (!thisTestimonial.hasClass('owl-carousel')) {
                    thisTestimonial.addClass('owl-carousel');
                }

                thisTestimonial.owlCarousel({
                    items: 1,
                    autoHeight: true,
                    autoplay:true,
                    autoplayTimeout: 3000,
                    autoplayHoverPause: true,
                    loop:true,
                    nav: false,
                    dots: true,
                    smartSpeed: animationSpeed,
                    animateIn: 'fadeInRight',
                    animateOut: 'fadeOutLeft',
                });

            });

        }

    }

    /**
     * Init Carousel shortcode
     */
    function mkdfInitCarousels() {

        var carouselHolders = $('.mkdf-carousel-holder'),
            carousel,
            numberOfItems;


        if(carouselHolders.length) {
            carouselHolders.each(function() {
                carousel = $(this).find('.mkdf-carousel');
                numberOfItems = carousel.data('items');


                //Carousel Item Height calcs
                function calcItemHeight(carousel) {
                    var carouselItemOuterHolder = carousel.find('.mkdf-carousel-item-outer-holder');
                    carouselItemOuterHolder.each(function(){
                        var thisItem = $(this),
                            imageHeight = thisItem.find('.mkdf-carousel-first-image-holder img:first-child').outerHeight(),
                            descriptionHeight,
                            itemHeight;

                            setTimeout(function () {
                            	descriptionHeight = thisItem.find('.mkdf-carousel-description').outerHeight(true);
                            	itemHeight = imageHeight + descriptionHeight;
                            	thisItem.css('height', itemHeight );
                            },300);


                            if(!thisItem.find('.mkdf-carousel-description').length) {
                                thisItem.find('.mkdf-carousel-item-holder').addClass('mkdf-no-description');
                            } 
                    });
                }

                var showNav = carousel.data('navigation');

                if(typeof showNav !== 'undefined') {
                    showNav = showNav === 'yes';
                } else {
                    showNav = false;
                }

	                carousel.waitForImages(function(){

	                    carousel.css('visibility','visible');
	                    calcItemHeight(carousel);
	                    if (!carousel.hasClass('owl-carousel')) {
	                        carousel.addClass('owl-carousel');
	                    }
	                
		                carousel.owlCarousel({
		                    autoplayInterval: 3000,
		                    autoplayHoverPause: true,
		                    loop:true,
		                    nav: showNav,
		                    items: numberOfItems,
		                    responsive:{
		                        0:{
		                            items:1,
		                        },
		                        480:{
		                            items:2,
		                        },
		                        768:{
		                            items:3,
		                        },
		                        1024:{
		                            items:4,
		                        },
		                        1200:{
		                            items:5,
		                        },
		                        1281:{
		                            items:6,
		                        },
		                        1441:{
		                            items:numberOfItems,
		                        }
		                    },
		                    dots: false,
		                    smartSpeed: 600,
		                    navText: [
		                        '<span class="mkdf-prev-icon"><i class="lnr lnr-chevron-left"></i></span>',
		                        '<span class="mkdf-next-icon"><i class="lnr lnr-chevron-right"></i></span>'
		                    ],
		                    onInitialized: function () {
								var carouselItems = carousel.find('.owl-item');
		                    	var carouselItemsActive = carousel.find('.owl-item.active');
		                    	var focusedItem = $(carouselItemsActive[1]);
		                    	var links = carouselItems.find('a');
		                    	focusedItem.addClass('focus');


								links.each(function(){
									var link = $(this);
									if (mkdf.htmlEl.hasClass('touch')){
										link.on('touch click',function (e) {
											if (link.hasClass('focused')){
												link.removeClass('focused');
												return true;
											}
											else{
												e.preventDefault();
												e.stopPropagation();
												links.removeClass('focused');
												link.addClass('focused');
											}
										});
									}
								});

		                    	carouselItems.each( function(){
		                    		var thisItem = $(this);

									thisItem.on('mouseover touch', function(e){
										carouselItems.removeClass('focus');
										thisItem.addClass('focus');
									});

		                    	});
		                    },
		                    onChanged: function () {
		                    	var carouselItem = carousel.find('.owl-item.active');
		                    	var focusedItem = $(carouselItem[1]);
		                    	carouselItem.removeClass('focus');
		                    	focusedItem.addClass('focus');
		                    }
		                });
	                });

                $(window).resize(function(){
                    calcItemHeight(carousel);
                });

            });
        }

    }

    /**
     * Init Pie Chart and Pie Chart With Icon shortcode
     */
    function mkdfInitPieChart() {

        var pieCharts = $('.mkdf-pie-chart-holder, .mkdf-pie-chart-with-icon-holder');

        if(pieCharts.length) {

            pieCharts.each(function() {

                var pieChart = $(this),
                    percentageHolder = pieChart.children('.mkdf-percentage, .mkdf-percentage-with-icon'),
                    barColor,
                    trackColor,
                    lineWidth,
                    size = 155;

                if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
                    barColor = pieChart.data('bar-color');
                }

                if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
                    trackColor = pieChart.data('track-color');
                }

                percentageHolder.appear(function() {
                    initToCounterPieChart(pieChart);
                    percentageHolder.css('opacity', '1');

                    percentageHolder.easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: 6,
                        animate: 1500,
                        size: size
                    });
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});

            });

        }

    }

    /*
     **	Counter for pie chart number from zero to defined number
     */
    function initToCounterPieChart(pieChart) {

        pieChart.css('opacity', '1');
        var counter = pieChart.find('.mkdf-to-counter'),
            max = parseFloat(counter.text());
        counter.countTo({
            from: 0,
            to: max,
            speed: 1500,
            refreshInterval: 50
        });

    }

    /**
     * Init Pie Chart shortcode
     */
    function mkdfInitPieChartDoughnut() {

        var pieCharts = $('.mkdf-pie-chart-doughnut-holder, .mkdf-pie-chart-pie-holder');

        pieCharts.each(function() {

            var pieChart = $(this),
                canvas = pieChart.find('canvas'),
                chartID = canvas.attr('id'),
                chart = document.getElementById(chartID).getContext('2d'),
                data = [],
                jqChart = $(chart.canvas); //Convert canvas to JQuery object and get data parameters

            for(var i = 1; i <= 10; i++) {

                var chartItem,
                    value = jqChart.data('value-' + i),
                    color = jqChart.data('color-' + i);

                if(typeof value !== 'undefined' && typeof color !== 'undefined') {
                    chartItem = {
                        value: value,
                        color: color
                    };
                    data.push(chartItem);
                }

            }

            if(canvas.hasClass('mkdf-pie')) {
                new Chart(chart).Pie(data,
                    {segmentStrokeColor: 'transparent'}
                );
            } else {
                new Chart(chart).Doughnut(data,
                    {segmentStrokeColor: 'transparent'}
                );
            }

        });

    }

    /*
     **	Init tabs shortcode
     */
    function mkdfInitTabs() {

        var tabs = $('.mkdf-tabs');
        if(tabs.length) {
            tabs.each(function() {
                var thisTabs = $(this);

                thisTabs.children('.mkdf-tab-container').each(function(index) {
                    index = index + 1;
                    var that = $(this),
                        link = that.attr('id'),
                        navItem = that.parent().find('.mkdf-tabs-nav li:nth-child(' + index + ') a'),
                        navLink = navItem.attr('href');

                    link = '#' + link;

                    if(link.indexOf(navLink) > -1) {
                        navItem.attr('href', link);
                    }
                });

                if(thisTabs.hasClass('mkdf-horizontal')) {
                    thisTabs.tabs();
                }
                else if(thisTabs.hasClass('mkdf-vertical')) {
                    thisTabs.tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
                    thisTabs.find('.mkdf-tabs-nav > ul >li').removeClass('ui-corner-top').addClass('ui-corner-left');
                }   

                //horizontal tabs
                if(thisTabs.hasClass('mkdf-horizontal')){
                    var tab = thisTabs.find('li'),
                        tabLine = thisTabs.find('.mkdf-tab-line');

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
                                tabLine.css({top: thisTab.offset().top - thisTab.parent().offset().top + thisTab.height() - 3}); // 3 tabLine height
                            });
                        });
                    }
                }
                //vertical tabs
                if(thisTabs.hasClass('mkdf-vertical')){
                    var tab = thisTabs.find('li'),
                        tabLine = thisTabs.find('.mkdf-tab-line');

                    tabLine.css({height: tab.first().find('> a').outerHeight()});
                    tabLine.css({top: 0});

                    tab.each(function(){
                        var thisTab = $(this);
                        thisTab.mouseenter(function(){
                            tabLine.css({height: thisTab.find('> a').outerHeight()});
                            tabLine.css({top: thisTab.find('> a').offset().top - thisTab.parent().offset().top});
                        });
                    });

                    thisTabs.find('> ul').mouseleave(function(){
                        tabLine.css({height: tab.filter('.ui-tabs-active').find('> a').outerHeight()});
                        tabLine.css({top: tab.filter('.ui-tabs-active').find('> a').offset().top - tab.filter('.ui-tabs-active').parent().offset().top});
                    });
                }

            });
        }
    }

    /*
     **	Generate icons in tabs navigation
     */
    function mkdfInitTabIcons() {

        var tabContent = $('.mkdf-tab-container');
        if(tabContent.length) {

            tabContent.each(function() {
                var thisTabContent = $(this);

                var id = thisTabContent.attr('id');
                var icon = '';
                if(typeof thisTabContent.data('icon-html') !== 'undefined' || thisTabContent.data('icon-html') !== 'false') {
                    icon = thisTabContent.data('icon-html');
                }

                var tabNav = thisTabContent.parents('.mkdf-tabs').find('.mkdf-tabs-nav > li > a[href="#' + id + '"]');

                if(typeof(tabNav) !== 'undefined') {
                    tabNav.children('.mkdf-icon-frame').append(icon);
                }
            });
        }
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var mkdfButton = mkdf.modules.shortcodes.mkdfButton = function() {
        //all buttons on the page
        var buttons = $('.mkdf-btn');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var buttonHoverColor = function(button) {
            if(typeof button.data('hover-color') !== 'undefined') {
                var changeButtonColor = function(event) {
                    event.data.button.css('color', event.data.color);
                };

                var originalColor = button.css('color');
                var hoverColor = button.data('hover-color');

                button.on('mouseenter', {button: button, color: hoverColor}, changeButtonColor);
                button.on('mouseleave', {button: button, color: originalColor}, changeButtonColor);
            }
        };


        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonHoverBgColor = function(button) {
            if(typeof button.data('hover-bg-color') !== 'undefined') {
                var changeButtonBg = function(event) {
                    event.data.button.css('background-color', event.data.color);
                };

                var originalBgColor = button.css('background-color');
                var hoverBgColor = button.data('hover-bg-color');

                button.on('mouseenter', {button: button, color: hoverBgColor}, changeButtonBg);
                button.on('mouseleave', {button: button, color: originalBgColor}, changeButtonBg);
            }
        };

        /**
         * Initializes button border color
         * @param button
         */
        var buttonHoverBorderColor = function(button) {
            if(typeof button.data('hover-border-color') !== 'undefined') {
                var changeBorderColor = function(event) {
                    event.data.button.css('border-color', event.data.color);
                };

                var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', {button: button, color: hoverBorderColor}, changeBorderColor);
                button.on('mouseleave', {button: button, color: originalBorderColor}, changeBorderColor);
            }
        };

        return {
            init: function() {
                if(buttons.length) {
                    buttons.each(function() {
                        buttonHoverColor($(this));
                        buttonHoverBgColor($(this));
                        buttonHoverBorderColor($(this));
                    });
                }
            }
        };
    };

    /*
     **	Init blog list masonry type
     */
    function mkdfInitBlogListMasonry() {
        var blogList = $('.mkdf-blog-list-holder.mkdf-masonry .mkdf-blog-list');
        if(blogList.length) {
            blogList.each(function() {
                var thisBlogList = $(this);
                thisBlogList.animate({opacity: 1});
                thisBlogList.isotope({
                    itemSelector: '.mkdf-blog-list-masonry-item',
                    masonry: {
                        columnWidth: '.mkdf-blog-list-masonry-grid-sizer',
                        gutter: '.mkdf-blog-list-masonry-grid-gutter'
                    }
                });
            });

        }
    }

    /*
     **	Custom Font resizing
     */
    function mkdfCustomFontResize() {
        var customFont = $('.mkdf-custom-font-holder');
        if(customFont.length) {
            customFont.each(function() {
                var thisCustomFont = $(this);
                var fontSize;
                var lineHeight;
                var coef1 = 1;
                var coef2 = 1;

                if(mkdf.windowWidth < 1200) {
                    coef1 = 0.8;
                }

                if(mkdf.windowWidth < 1000) {
                    coef1 = 0.7;
                }

                if(mkdf.windowWidth < 768) {
                    coef1 = 0.6;
                    coef2 = 0.7;
                }

                if(mkdf.windowWidth < 600) {
                    coef1 = 0.5;
                    coef2 = 0.6;
                }

                if(mkdf.windowWidth < 480) {
                    coef1 = 0.4;
                    coef2 = 0.5;
                }

                if(typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
                    fontSize = parseInt(thisCustomFont.data('font-size'));

                    if(fontSize > 70) {
                        fontSize = Math.round(fontSize * coef1);
                    }
                    else if(fontSize > 35) {
                        fontSize = Math.round(fontSize * coef2);
                    }

                    thisCustomFont.css('font-size', fontSize + 'px');
                }

                if(typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
                    lineHeight = parseInt(thisCustomFont.data('line-height'));

                    if(lineHeight > 70 && mkdf.windowWidth < 1200) {
                        lineHeight = '1.2em';
                    }
                    else if(lineHeight > 35 && mkdf.windowWidth < 768) {
                        lineHeight = '1.2em';
                    }
                    else {
                        lineHeight += 'px';
                    }

                    thisCustomFont.css('line-height', lineHeight);
                }
            });
        }
    }

    /*
     **	Show Google Map
     */
    function mkdfShowGoogleMap() {

        if($('.mkdf-google-map').length) {
            $('.mkdf-google-map').each(function() {

                var element = $(this);

                var customMapStyle;
                if(typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if(typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }

                var addresses;
                if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }

                var map = "map_" + uniqueId;
                var geocoder = "geocoder_" + uniqueId;
                var holderId = "mkdf-map-" + uniqueId;

                mkdfInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin, map, geocoder, addresses);
            });
        }

    }

    /*
     **	Init Google Map
     */
    function mkdfInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin, map, geocoder, data) {

        var mapStyles = [
            {
                stylers: [
                    {hue: color},
                    {saturation: saturation},
                    {lightness: lightness},
                    {gamma: 1}
                ]
            }
        ];

        var googleMapStyleId;

        if(customMapStyle) {
            googleMapStyleId = 'mkdf-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        var qoogleMapType = new google.maps.StyledMapType(mapStyles,
            {name: "Mikado Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if(!isNaN(height)) {
            height = height + 'px';
        }

        var myOptions = {

            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'mkdf-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('mkdf-style', qoogleMapType);

        var index;

        for(index = 0; index < data.length; ++index) {
            mkdfInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }

    /*
     **	Init Google Map Addresses
     */
    function mkdfInitializeGoogleAddress(data, pin, map, geocoder) {
        if(data === '')
            return;
        var contentString = '<div id="content">' +
            '<div id="siteNotice">' +
            '</div>' +
            '<div id="bodyContent">' +
            '<p>' + data + '</p>' +
            '</div>' +
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        geocoder.geocode({'address': data}, function(results, status) {
            if(status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: pin,
                    title: data['store_title']
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map, marker);
                });

                google.maps.event.addDomListener(window, 'resize', function() {
                    map.setCenter(results[0].geometry.location);
                });

            }
        });
    }

    function mkdfInitAccordions() {
        var accordion = $('.mkdf-accordion-holder');
        if(accordion.length) {
            accordion.each(function() {

                var thisAccordion = $(this);

                if(thisAccordion.hasClass('mkdf-accordion')) {

                    thisAccordion.accordion({
                        animate: "swing",
                        collapsible: false,
                        active: 0,
                        icons: "",
                        heightStyle: "content"
                    });
                }

                if(thisAccordion.hasClass('mkdf-toggle')) {

                    var toggleAccordion = $(this);
                    var toggleAccordionTitle = toggleAccordion.find('.mkdf-title-holder');
                    var toggleAccordionContent = toggleAccordionTitle.next();

                    toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
                    toggleAccordionTitle.addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom");
                    toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

                    toggleAccordionTitle.each(function() {
                        var thisTitle = $(this);
                        thisTitle.hover(function() {
                            thisTitle.toggleClass("ui-state-hover");
                        });

                        thisTitle.on('click', function() {
                            thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
                            thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
                        });
                    });
                }
            });
        }
    }

    function mkdfInitImageGallery() {

        var galleries = $('.mkdf-image-gallery');

        if(galleries.length) {
            galleries.each(function() {
                var gallery = $(this).children('.mkdf-image-gallery-slider'),
                    autoplay = false,
                    autoplayInterval = gallery.data('autoplay'),
                    animation,
                    animateIn,
                    animateOut,
                    navigation = (gallery.data('navigation') == 'yes'),
                    pagination = (gallery.data('pagination') == 'yes');

                if (autoplayInterval != '') {
                    autoplay = true;
                }

                if (animation = (gallery.data('animation') == 'slide')) {
                    animateIn = 'fadeInRight';
                    animateOut = 'fadeOutLeft';
                } else if (animation = (gallery.data('animation') == 'fade'))  {
                    animateIn = 'fadeIn';
                    animateOut = 'fadeOut';
                } else if (animation = (gallery.data('animation') == 'fadeUp'))  {
                    animateIn = 'fadeInUp';
                    animateOut = 'fadeOutUp';
                } else if (animation = (gallery.data('animation') == 'backSlide'))  {
                    animateIn = 'zoomInRight';
                    animateOut = 'zoomOutLeft';
                } else if (animation = (gallery.data('animation') == 'goDown'))  {
                    animateIn = 'slideInDown';
                    animateOut = 'slideOutDown';
                }

                if (!gallery.hasClass('owl-carousel')) {
                    gallery.addClass('owl-carousel');
                }

                gallery.waitForImages(function(){
                    gallery.css('visibility','visible');
                });

                gallery.owlCarousel({
                    items: 1,
                    autoplay: autoplay,
                    autoplayInterval: autoplayInterval * 1000,
                    autoplayHoverPause: true,
                    loop:true,
                    nav: navigation,
                    dots: pagination,
                    transitionStyle: animation,
                    autoHeight: true,
                    smartSpeed: 600,
                    navText: [
                        '<span class="mkdf-prev-icon"><i class="lnr lnr-chevron-left"></i></span>',
                        '<span class="mkdf-next-icon"><i class="lnr lnr-chevron-right"></i></span>'
                    ],
                    animateIn: animateIn,
                    animateOut: animateOut,
                    onTranslate: function() {
                        gallery.find('.owl-nav > div').css({'pointer-events':'none','cursor':'pointer'});
                    },
                    onTranslated: function() {
                        gallery.find('.owl-nav > div').css('pointer-events','initial');
                    }
                });
            });
        }

    }


    function mkdfConvertHTML(html) {
        var newHtml = $.trim(html),
            $html = $(newHtml),
            $empty = $();

        $html.each(function(index, value) {
            if(value.nodeType === 1) {
                $empty = $empty.add(this);
            }
        });

        return $empty;
    }


    function mkdfInfoBox() {
        var infoBoxes = $('.mkdf-info-box-holder');

        var getBottomHeight = function(bottomHolder) {
            if(bottomHolder.length) {
                return bottomHolder.height();
            }

            return false;
        }

        var infoBoxesHeight = function() {
            if(infoBoxes.length) {
                var maxHeight = 0;
                var heightestBox;

                infoBoxes.each(function() {
                    var bottomHolder = $(this).find('.mkdf-ib-bottom-holder');
                    var topHolder = $(this).find('.mkdf-ib-top-holder')

                    var currentHeight = getBottomHeight(bottomHolder) + topHolder.height();

                    maxHeight = Math.max(maxHeight, currentHeight);

                    if(maxHeight <= currentHeight) {
                        heightestBox = $(this);
                        maxHeight = currentHeight;
                    }
                });

                infoBoxes.height(maxHeight);
            }
        }

        var initHover = function(infoBox) {
            var timeline = new TimelineLite({paused: true}),
                topHolder = infoBox.find('.mkdf-ib-top-holder'),
                bottomHolder = infoBox.find('.mkdf-ib-bottom-holder'),
                bottomHeight = getBottomHeight(bottomHolder);

            timeline.to(topHolder, 0.6, {y: -(bottomHeight / 2), ease: Back.easeInOut.config(2)});
            timeline.to(bottomHolder, 0.4, {y: -(bottomHeight / 2), opacity: 1, ease: Back.easeOut}, '-=0.3');

            infoBox.hover(function() {
                timeline.restart();
            }, function() {
                timeline.reverse();
            });
        }

        if(infoBoxes.length) {
            infoBoxesHeight();

            $(mkdf.window).resize(function() {
                infoBoxesHeight();
            });

            infoBoxes.each(function() {
                var thisInfoBox = $(this);
                initHover(thisInfoBox);

                $(mkdf.window).resize(function() {
                    initHover(thisInfoBox);
                });
            });
        }
    }

    function mkdfProcess() {
        var processes = $('.mkdf-process-holder');

        var setProcessItemsPosition = function(process) {
            var items = process.find('.mkdf-process-item-holder');
            var highlighted = items.filter('.mkdf-pi-highlighted');

            if(highlighted.length) {
                if(highlighted.length === 1) {
                    var afterHighlighed = highlighted.nextAll();

                    if(afterHighlighed.length) {
                        afterHighlighed.addClass('mkdf-pi-push-right');
                    }
                } else {
                    process.addClass('mkdf-process-multiple-highlights');
                }
            }
        }

        var processAnimation = function(process) {
            if(!mkdf.body.hasClass('mkdf-no-animations-on-touch')) {
                var items = process.find('.mkdf-process-item-holder');
                var background = process.find('.mkdf-process-bg-holder');

                process.appear(function() {
                    var tl = new TimelineLite();
                    tl.fromTo(background, 0.2, {y: 50, opacity: 0, delay: 0.1}, {opacity: 1, y: 0, delay: 0.1});
                    tl.staggerFromTo(items, 0.3, {opacity: 0, y: 50, ease: Back.easeOut.config(2)}, {
                        opacity: 1,
                        y: 0,
                        ease: Back.easeOut.config(2)
                    }, 0.2);
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            }
        }

        return {
            init: function() {
                if(processes.length) {
                    processes.each(function() {
                        setProcessItemsPosition($(this));
                        processAnimation($(this));
                    });
                }
            }
        }
    };

    function mkdfComparisonPricingTables() {
        var pricingTablesHolder = $('.mkdf-comparision-pricing-tables-holder');

        var alterPricingTableColumn = function(holder) {
            var featuresHolder = holder.find('.mkdf-cpt-features-item');
            var pricingTables = holder.find('.mkdf-comparision-table-holder');

            if(pricingTables.length) {
                pricingTables.each(function() {
                    var currentPricingTable = $(this);
                    var pricingItems = currentPricingTable.find('.mkdf-cpt-table-content li');

                    if(pricingItems.length) {
                        pricingItems.each(function(i) {
                            var pricingItemFeature = featuresHolder[i];
                            var pricingItem = this;
                            var pricingItemContent = pricingItem.innerHTML;

                            if(typeof pricingItemFeature !== 'undefined') {
                                pricingItem.innerHTML = '<span class="mkdf-cpt-table-item-feature">' + $(pricingItemFeature).text() + ': </span>' + pricingItemContent;
                            }
                        });
                    }
                });
            }
        };

        return {
            init: function() {
                if(pricingTablesHolder.length) {
                    pricingTablesHolder.each(function() {
                        alterPricingTableColumn($(this));
                    });
                }
            }
        }
    }

    function mkdfProgressBarVertical() {
        var progressBars = $('.mkdf-vertical-progress-bar-holder');

        var animateProgressBar = function(progressBar) {

            progressBar.appear(function() {
                var barHolder = progressBar.find('.mkdf-vpb-bar');
                var activeBar = progressBar.find('.mkdf-vpb-active-bar');
                var percentage = barHolder.data('percent');

                activeBar.animate({
                    height: percentage + '%'
                }, 1500);

            }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
        };

        var animatePercentageNumber = function(progressBar) {
            progressBar.appear(function() {
                var barHolder = progressBar.find('.mkdf-vpb-bar');
                var percentage = barHolder.data('percent');
                var percentHolder = progressBar.find('.mkdf-vpb-percent-number');

                percentHolder.countTo({
                    from: 0,
                    to: percentage,
                    speed: 1500,
                    refreshInterval: 50
                });
            });
        };

        return {
            init: function() {

                if(progressBars.length) {

                    progressBars.each(function() {
                        animateProgressBar($(this));
                        animatePercentageNumber($(this));
                    });
                }
            }
        }
    }

    function mkdfIconProgressBar() {
        var progressBars = $('.mkdf-icon-progress-bar');

        var animateActiveIcons = function(progressBar) {
            var timeouts = [];
            progressBar.appear(function() {
                var numberOfActive = parseInt(progressBar.data('number-of-active-icons'));
                var icons = progressBar.find('.mkdf-ipb-icon');
                var customColor = progressBar.data('icon-active-color');

                if(typeof numberOfActive !== 'undefined') {

                    icons.each(function(i) {
                        if(i < numberOfActive) {
                            var time = (i + 1) * 150;
                            var currentIcon = $(this);

                            timeouts[i] = setTimeout(function() {
                                animateSingleIcon(currentIcon, customColor);
                                $(icons[i]).addClass('active');
                            }, time);
                        }
                    });
                }
            }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
        };

        var animateSingleIcon = function(icon, customColor) {
            icon.addClass('mkdf-ipb-active');

            if(typeof customColor !== 'undefined' && customColor !== '') {
                icon.find('.mkdf-ipb-icon-elem').css('color', customColor);
            }
        }

        return {
            init: function() {
                if(progressBars.length) {
                    progressBars.each(function() {
                        animateActiveIcons($(this));
                    });
                }
            }
        }
    }

    function mkdfBlogSlider() {
        var blogSliders = $('.mkdf-blog-slider-holder');

        if(blogSliders.length) {
            blogSliders.each(function() {
                var thisSlider = $(this);

                if (!thisSlider.hasClass('owl-carousel')) {
                    thisSlider.addClass('owl-carousel');
                }

                thisSlider.owlCarousel({
                    items: 1,
                    nav: true,
                    autoHeight: true,
                    dots: false,
                    smartSpeed: 600,
                    navText: [
                        '<span class="mkdf-prev-icon"><i class="lnr lnr-chevron-left"></i></span>',
                        '<span class="mkdf-next-icon"><i class="lnr lnr-chevron-right"></i></span>'
                    ],
                    animateIn: 'fadeIn',
                    animateOut: 'fadeOut',
                });
            });
        }
    }

    function blogCarousel() {
        var blogCarousels = $('.mkdf-blog-carousel');

        if(blogCarousels.length) {
            blogCarousels.each(function() {
                var currentCarousel = $(this);

                if (!currentCarousel.hasClass('owl-carousel')) {
                    currentCarousel.addClass('owl-carousel');
                }

                currentCarousel.waitForImages(function(){
                    currentCarousel.animate({opacity:1});
                });

                currentCarousel.owlCarousel({
                    autoplay:true,
                    autoplayHoverPause:true,
                    loop:true,
                    responsive:{
                        0:{
                            items:1,
                        },
                        768:{
                            items:2,
                        },
                        1025:{
                            items:3,
                        }
                    },
                    dots: false,
                    smartSpeed: 400,
                    nav: true,
                    navText: [
                        '<span class="mkdf-prev-icon"><i class="lnr lnr-chevron-left"></i></span>',
                        '<span class="mkdf-next-icon"><i class="lnr lnr-chevron-right"></i></span>'
                    ]
                });
            });
        }
    }

    function emptySpaceResponsive() {
        var emptySpaces = $('.vc_empty_space');

        var sizes = {
            'large_laptop': 1560,
            'laptop': 1280,
            'tablet_landscape': 1024,
            'tablet_portrait': 768,
            'phone_landscape': 600,
            'phone_portrait': 480
        }

        var sizeValues = function() {
            var values = [];
            for(var size in sizes) {
                values.push(sizes[size]);
            }
            ;

            return values;
        }();

        var getHeights = function(emptySpace) {
            var heights = {};

            for(var size in sizes) {
                var dataValue = emptySpace.data(size);
                if(typeof dataValue !== 'undefined' && dataValue !== '') {
                    heights[size] = dataValue;
                }
            }

            return heights;
        };

        var usedSizes = function(emptySpace) {
            var usedSizes = [];

            for(var size in sizes) {
                var dataValue = emptySpace.data(size);
                if(typeof dataValue !== 'undefined' && dataValue !== '') {
                    usedSizes.push(sizes[size]);
                }
            }

            return usedSizes;
        };

        var resizeEmptySpace = function(heights, emptySpace) {
            if(typeof heights !== 'undefined') {
                var originalHeight = emptySpace.data('original-height');
                var sizeValues = usedSizes(emptySpace);
                var heightestSize = Math.max.apply(null, sizeValues);

                for(var size in sizes) {
                    if(mkdf.windowWidth <= sizes[size]) {
                        emptySpace.height(heights[size]);
                    } else if(mkdf.windowWidth > heightestSize) {
                        emptySpace.height(originalHeight);
                    }
                }
            }
        };

        return {
            init: function() {
                if(emptySpaces.length) {
                    emptySpaces.each(function() {
                        var heights = getHeights($(this));

                        resizeEmptySpace(heights, $(this));

                        var thisEmptySpace = $(this);

                        $(window).resize(function() {
                            resizeEmptySpace(heights, thisEmptySpace);
                        });
                    });
                }
            }
        }
    }

})(jQuery);
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