(function ($) {
    'use strict';

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitBookingDashboardActions();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
    }

    /**
     * Initialize Booking Table Ajax Actions
     */
    function mkdfInitBookingDashboardActions() {

        var actionButtons = $('.mkdf-booking-table-action-btn');

        if (actionButtons.length) {

            actionButtons.click(function (e) {
                e.preventDefault();
                var self = $(this),
                    bookingId = self.data('booking-id'),
                    action;

                if (self.hasClass('approve-booking')) {
                    action = 'approve';
                } else if (self.hasClass('cancel-booking')) {
                    action = 'cancel';
                }
                mkdfChangeButtonStatus( bookingId, action );

            });

        }

    }

    function mkdfChangeButtonStatus( id, action ) {

        var notice = $('.mkdf-booking-dash-notice');
        var ajaxData = {
            action: 'mkdfToursChangeBookingStatus',
            bookingId: id,
            newStatus: action
        };

        $.ajax({
            type: 'POST',
            data: ajaxData,
            url: MikadofToursAjaxUrl.url,
            success: function (data) {
                var response = JSON.parse( data );
                if ( response.status == 'success' ) {
                    notice.addClass(response.status);
                    notice.html(response.message);
                    notice.fadeIn(500);
                    window.location.reload();
                } else {
                    notice.addClass(response.status);
                    notice.html(response.message);
                    notice.fadeIn(500);
                    setTimeout(function(){
                        notice.fadeOut(500);
                    }, 1500);
                }
            }
        });


    }


})(jQuery);