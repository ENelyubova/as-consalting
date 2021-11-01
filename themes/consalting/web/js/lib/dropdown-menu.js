$(document).ready(function () {
    /*Кнопка открыть/закрыть*/
    $('.header-menu-catalog__btn').on("click", function(){
        $('.header-catalog').toggleClass('active');
    });
    // Закрытие при клике в любой области
    $(document).click(function (e){
        if(!$('.header-catalog__container').is(e.target) 
            && !$('.header-menu-catalog__btn').is(e.target)
            && $('.header-catalog__container').has(e.target).length === 0) {
            $('.header-catalog').removeClass('active');
        }
    });

    /*Каталог меню mvideo*/
    $('.js-menu-li').hover(function(){
        var id = $(this).data('id');
        // if($(id).hasClass('hidden') || !$(this).hasClass('has-submenu')){
            $('.js-menu-catalogChild').addClass('hidden');
            $('.js-menu-li').removeClass('active');
        // }

        $(id).removeClass('hidden');
        $(this).addClass('active');
    }, function(){
        if(!$(this).hasClass('has-submenu')){
            $('.js-menu-li').removeClass('active');
        }
    });
     $('.js-menu-catalogChild').hover(function(){
        $(this).removeClass('hidden');
    }, function(){
    });
});