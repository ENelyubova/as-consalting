$(document).ready(function () {
    /*Поиск*/
    $('.search-group .icon-search').on('click',function(e){
        $('.header-search').toggleClass('active');
        $('.icon-search').toggleClass('active');
        $('.search-group, .form-control').toggleClass('active');
        $(".search-group .form-control").focus();
    });
    /*Закрытие окна поиска*/
    $(document).mouseup(function (e){
        if(!$('.header-search').is(e.target) 
            && $('.header-search').has(e.target).length === 0) {
            $('.header-search').removeClass('active');
            $('.search-group').removeClass('active');
            $('.form-control').removeClass('active');
            $('.icon-search').removeClass('active');
        }
    });
});