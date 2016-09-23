(function($) {
    "use strict";


    var blog = {};
    mkdf.modules.blog = blog;

    blog.mkdfInitAudioPlayer = mkdfInitAudioPlayer;

    blog.mkdfOnDocumentReady = mkdfOnDocumentReady;
    blog.mkdfOnWindowLoad = mkdfOnWindowLoad;
    blog.mkdfOnWindowResize = mkdfOnWindowResize;
    blog.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
        mkdfInitAudioPlayer();
        mkdfInitBlogMasonry();
        mkdfInitBlogMasonryLoadMore();
        mkdfInitBlogLoadMore();
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



    function mkdfInitAudioPlayer() {

        var players = $('audio.mkdf-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }


    function mkdfInitBlogMasonry() {

        if($('.mkdf-blog-holder.mkdf-blog-type-masonry').length) {

            var container = $('.mkdf-blog-holder.mkdf-blog-type-masonry');


			container.waitForImages(function(){
				container.isotope({
					itemSelector: 'article',
					resizable: false,
					masonry: {
						columnWidth: '.mkdf-blog-masonry-grid-sizer',
						gutter: '.mkdf-blog-masonry-grid-gutter'
					}
				});
			});

            var filters = $('.mkdf-filter-blog-holder');
            $('.mkdf-filter').click(function() {
                var filter = $(this);
                var selector = filter.attr('data-filter');
                filters.find('.mkdf-active').removeClass('mkdf-active');
                filter.addClass('mkdf-active');
                container.isotope({filter: selector});
                return false;
            });
        }
    }

    function mkdfInitBlogMasonryLoadMore() {

        if($('.mkdf-blog-holder.mkdf-blog-type-masonry').length) {

            var container = $('.mkdf-blog-holder.mkdf-blog-type-masonry');

            if(container.hasClass('mkdf-masonry-pagination-infinite-scroll')) {
                container.infinitescroll({
                        navSelector: '.mkdf-blog-infinite-scroll-button',
                        nextSelector: '.mkdf-blog-infinite-scroll-button a',
                        itemSelector: 'article',
                        loading: {
                            finishedMsg: mkdfGlobalVars.vars.mkdfFinishedMessage,
                            msgText: mkdfGlobalVars.vars.mkdfMessage
                        }
                    },
                    function(newElements) {
                        container.append(newElements).isotope('appended', $(newElements));
                        mkdf.modules.blog.mkdfInitAudioPlayer();
                        mkdf.modules.common.mkdfOwlSlider();
                        mkdf.modules.common.mkdfFluidVideo();
                        setTimeout(function() {
                            container.isotope('layout');
                        }, 400);
                    }
                );
            } else if(container.hasClass('mkdf-masonry-pagination-load-more')) {
                var i = 1;
                $('.mkdf-blog-load-more-button a').on('click', function(e) {
                    e.preventDefault();

                    var button = $(this);

                    var link = button.attr('href');
                    var content = '.mkdf-masonry-pagination-load-more';
                    var anchor = '.mkdf-blog-load-more-button a';
                    var nextHref = $(anchor).attr('href');
                    $.get(link + '', function(data) {
                        var newContent = $(content, data).wrapInner('').html();
                        nextHref = $(anchor, data).attr('href');
                        container.append(newContent).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        mkdf.modules.blog.mkdfInitAudioPlayer();
                        mkdf.modules.common.mkdfOwlSlider();
                        mkdf.modules.common.mkdfFluidVideo();
                        setTimeout(function() {
                            $('.mkdf-masonry-pagination-load-more').isotope('layout');
                        }, 400);
                        if(button.parent().data('rel') > i) {
                            button.attr('href', nextHref); // Change the next URL
                        } else {
                            button.parent().remove();
                        }
                    });
                    i++;
                });
            }
        }
    }
    function mkdfInitBlogLoadMore(){
        var blogHolder = $('.mkdf-blog-holder.mkdf-blog-load-more:not(.mkdf-blog-type-masonry)');
        
        if(blogHolder.length){
            blogHolder.each(function(){
                var thisBlogHolder = $(this);
                var nextPage;
                var maxNumPages;
                
                var loadMoreButton = thisBlogHolder.find('.mkdf-load-more-ajax-pagination .mkdf-btn');
                maxNumPages =  thisBlogHolder.data('max-pages');                
                
                loadMoreButton.on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    var loadMoreDatta = getBlogLoadMoreData(thisBlogHolder);
                    nextPage = loadMoreDatta.nextPage;
                    
                    if(nextPage <= maxNumPages){
                        var ajaxData = setBlogLoadMoreAjaxData(loadMoreDatta);
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: MikadofAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisBlogHolder.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml =  response.html;
                                thisBlogHolder.waitForImages(function(){    
                                    thisBlogHolder.find('article:last').after(responseHtml); // Append the new content 
                                    setTimeout(function() {               
                                        mkdf.modules.blog.mkdfInitAudioPlayer();
                                        mkdf.modules.common.mkdfOwlSlider();
                                        mkdf.modules.common.mkdfFluidVideo();
                                    },400);
                                });
                            }
                        });
                    }
                    
                    if(nextPage === maxNumPages){
                        loadMoreButton.hide();
                    }
                    
                });
            });
        }
    }
    function getBlogLoadMoreData(container){
        
        var returnValue = {};
        
        returnValue.nextPage = '';
        returnValue.number = '';
        returnValue.category = '';
        returnValue.blogType = '';
        returnValue.archiveCategory = '';
        returnValue.archiveAuthor = '';
        returnValue.archiveTag = '';
        returnValue.archiveDay = '';
        returnValue.archiveMonth = '';
        returnValue.archiveYear = '';
        
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('post-number') !== 'undefined' && container.data('post-number') !== false) {                    
            returnValue.number = container.data('post-number');
        }
        if (typeof container.data('category') !== 'undefined' && container.data('category') !== false) {                    
            returnValue.category = container.data('category');
        }
        if (typeof container.data('blog-type') !== 'undefined' && container.data('blog-type') !== false) {                    
            returnValue.blogType = container.data('blog-type');
        }
        if (typeof container.data('archive-category') !== 'undefined' && container.data('archive-category') !== false) {                    
            returnValue.archiveCategory = container.data('archive-category');
        }
        if (typeof container.data('archive-author') !== 'undefined' && container.data('archive-author') !== false) {                    
            returnValue.archiveAuthor = container.data('archive-author');
        }
        if (typeof container.data('archive-tag') !== 'undefined' && container.data('archive-tag') !== false) {                    
            returnValue.archiveTag = container.data('archive-tag');
        }
        if (typeof container.data('archive-day') !== 'undefined' && container.data('archive-day') !== false) {                    
            returnValue.archiveDay = container.data('archive-day');
        }
        if (typeof container.data('archive-month') !== 'undefined' && container.data('archive-month') !== false) {                    
            returnValue.archiveMonth = container.data('archive-month');
        }
        if (typeof container.data('archive-year') !== 'undefined' && container.data('archive-year') !== false) {                    
            returnValue.archiveYear = container.data('archive-year');
        }
        
        return returnValue;
        
    }
    
    function setBlogLoadMoreAjaxData(container){
        
        var returnValue = {
            action: 'voyage_mikado_blog_load_more',
            nextPage: container.nextPage,
            number: container.number,
            category: container.category,
            blogType: container.blogType,
            archiveCategory: container.archiveCategory,
            archiveAuthor: container.archiveAuthor,
            archiveTag: container.archiveTag,
            archiveDay: container.archiveDay,
            archiveMonth: container.archiveMonth,
            archiveYear: container.archiveYear
        };
        
        return returnValue;
    }



})(jQuery);