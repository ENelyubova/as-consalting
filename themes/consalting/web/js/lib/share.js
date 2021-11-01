$(document).ready(function () {
    /*Share*/
    $('.social-share-more').on('click',function(e){
        e.preventDefault();
        $('.social-share-tooltip').toggleClass('active');
    });
    $(document).click(function (e){
        if(!$('.social-share-more').is(e.target)){
            $('.social-share-tooltip').removeClass('active');
        }
    });
});