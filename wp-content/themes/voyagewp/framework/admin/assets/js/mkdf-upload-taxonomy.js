(function($){

    $(document).ready(function() {
        mkdfInitIconSelectDependency();
    });

    function mkdfInitIconSelectDependency() {

        var iconPack = $('#icon_pack'),
            holders = $('.term-icons-wrap .icon-collection');

        var checkDependency = function() {
            holders.each(function(){
                var value = iconPack.val(),
                    holder = $(this);
                if ( holder.hasClass( value ) ) {
                    holder.fadeIn(300);
                } else {
                    holder.fadeOut(300);
                }
            });
        };
        checkDependency();

        iconPack.change( function() {
            checkDependency();
        });

    }

})(jQuery);
