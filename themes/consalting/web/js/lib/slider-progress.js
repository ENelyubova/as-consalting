$(document).ready(function () {
    /*Прогрессбар слайдер*/
    jQuery(document).ready(function($) {
        var sliderTimer = 10000;
        var beforeEnd = 500;
        var $imageSlider = $('.carousel-slider');
        $imageSlider.slick({
            fade: true,
            infinite: true,
            appendArrows: '.slider-arrows .arrows',
            autoplay: true,
            autoplaySpeed: sliderTimer,
            speed: 1000,
            arrows: true,
            dots: false,
            adaptiveHeight: true,
            pauseOnFocus: false,
            pauseOnHover: false,
            responsive: [
                {
                    breakpoint: 1020,
                    settings: {
                        arrows: false,
                    },
                },
            ]
        });

        function progressBar(){
            $('.slider-progress').find('.progress').removeAttr('style');
            $('.slider-progress').find('.progress').removeClass('active');
            setTimeout(function(){
                $('.slider-progress').find('.progress').css('transition-duration', (sliderTimer/1000)+'s').addClass('active');
            }, 100);
        }
        progressBar();
        $imageSlider.on('beforeChange', function(e, slick) {
            progressBar();
        });
        $imageSlider.on('afterChange', function(e, slick, nextSlide) {
            titleAnim(nextSlide);
        });

        // Title Animation JS
        function titleAnim(ele){
            $imageSlider.find('.slick-current').find('h1').addClass('show');
            setTimeout(function(){
                $imageSlider.find('.slick-current').find('h1').removeClass('show');
            }, sliderTimer - beforeEnd);
        }
        titleAnim();
    });
});