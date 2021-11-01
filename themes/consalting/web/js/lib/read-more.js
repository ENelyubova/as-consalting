$(document).ready(function () {
    // фунция определения длины текста, если много добавляем кнопку
    function getMorePortfolio() {
        if($('div').hasClass('js-portfolio-item')){
            $('.js-portfolio-item').each(function () {
                var desc = $(this).find('.js-portfolio-desc').height();
                var text = $(this).find('.js-portfolio-text').height();
                if(text >= desc) {
                    $(this).find('.js-portfolio-more').show();
                } else {
                    $(this).find('.js-portfolio-more').hide();
                }
            });
        }
    }
    getMorePortfolio();

    // Открытие в модальном окне
    $(document).delegate('.js-portfolio-more', 'click', function(e){
        var modal = $('.js-portfolioModal');
        var content = $(this).parents('.js-portfolio-item').html();
        modal.find('.portfolio-block').html(content);
        modal.modal('show');
        return false;

        /*var span = $(this).find('span');
        var text = $(this).data('text');

        e.preventDefault();
        $('.portfolio-item__description').toggleClass('active');

        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).data('text', span.text());
            span.text(text);
        } else {
            $(this).addClass('active');
            $(this).data('text', span.text());
            span.text(text);
        }
        return false;*/
    });

    /*
     * Кнопка показать все характеристики
    */
    $(document).delegate('.js-more-attributes', 'click', function(){
        var span = $(this).find('span');
        var text = $(this).data('text');

        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $('.js-product-attributes').removeClass('active').find('.js-product-attributes-item.hidden2').addClass('hidden').removeClass('hidden2');
            $(this).data('text', span.text());
            span.text(text);
        } else {
            $(this).addClass('active');
            $('.js-product-attributes').addClass('active').find('.js-product-attributes-item.hidden').addClass('hidden2').removeClass('hidden');
            $(this).data('text', span.text());
            span.text(text);
        }
        return false;
    });
});