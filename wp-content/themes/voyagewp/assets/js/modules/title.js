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
