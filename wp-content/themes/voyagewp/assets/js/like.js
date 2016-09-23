(function($) {
    'use strict';

    var like = {};
    mkdf.modules.like = like;

    like.mkdfLikes = mkdfLikes;

    like.mkdfOnDocumentReady = mkdfOnDocumentReady;
    like.mkdfOnWindowLoad = mkdfOnWindowLoad;
    like.mkdfOnWindowResize = mkdfOnWindowResize;
    like.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
        mkdfLikes();
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
    

    function mkdfLikes() {

        $(document).on('click','.mkdf-like', function() {

            var likeLink = $(this),
                id = likeLink.attr('id'),
                type;

            if ( likeLink.hasClass('liked') ) {
                return false;
            }

            if(typeof likeLink.data('type') !== 'undefined') {
                type = likeLink.data('type');
            }

            var dataToPass = {
                action: 'voyage_mikado_like',
                likes_id: id,
                type: type
            };

            var like = $.post(mkdfLike.ajaxurl, dataToPass, function( data ) {

                likeLink.html(data).addClass('liked').attr('title','You already like this!');

                if(type !== 'blog_list') {
                    likeLink.children('span').css('opacity',1);
                }

            });

            return false;
        });

    }


})(jQuery);