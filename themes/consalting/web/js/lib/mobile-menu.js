$(document).ready(function () {
    // мобильное меню
    /*$('.m-menu-button').on("click", function(){
        $(this).toggleClass('open');
        $('body').toggleClass('modal-open');
        $('.mobile-menu').toggleClass('active-menu');
    });*/

    /*$('.m-menu-button').on("click", function(){
        if($('body').hasClass('menu_m_visible') == true){
            $('body').removeClass('menu_m_visible');
            $('.mobile-content').removeClass('active-menu');
            $('.mobile-panel').removeClass('open');
        }
        else{
            $('body').addClass('menu_m_visible');
            $('.mobile-content').addClass('active-menu');
        }
    });*/

    $('.listItemLink').on( 'click', function(){
        $('.mobile-menu').removeClass('active-menu');
    });

    function removeClasses() {
        $(".mobile-menu ul li").each(function() {
            var custom_class = $(this).find('a').data('class');
            $('body').removeClass(custom_class);
        });
    }

    $('.mobile-menu a').on('click',function(e){
        removeClasses();
        var custom_class = $(this).data('class');
        $('body').addClass(custom_class);
    });
});