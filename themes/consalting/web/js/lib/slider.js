$(document).ready(function () {
    /*Слайдер*/
    if($('div').hasClass('news-box')){
        $('.news-box').slick({
            fade: false,
            infinite: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            arrows: true,
            dots: false,
            focusOnSelect: false,
            appendArrows: '.news-nav .arrows',
            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            touchThreshold: 100,
            speed: 700, 
            responsive: [
                {
                    breakpoint: 1000,
                    settings: {
                        adaptiveHeight: true,
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        fade: true,
                        slidesToShow: 1,
                    },
                },
            ]
        });
    }
    /*Преимущества*/
    if($('div').hasClass('advantages-list')){
        $('.advantages-list').slick({
            fade: false,
            infinite: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            arrows: true,
            dots: false,
            focusOnSelect: false,
            appendArrows: '.advantages-nav .arrows',
            // cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            touchThreshold: 100,
            speed: 700, 
            responsive: [
                {
                    breakpoint: 1000,
                    settings: {
                        adaptiveHeight: true,
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ]
        });
    }

    /*Сертификаты*/
    if($('div').hasClass('sertificate-carousel')){
        $('.sertificate-carousel').slick({
            fade: false,
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            arrows: false,
            dots: true,
            speed: 600,
            focusOnSelect: false,
            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            touchThreshold: 100,
            responsive: [ 
                {
                    breakpoint: 1000,
                    settings: {
                       slidesToShow: 3,
                        slidesToScroll: 1,
                        adaptiveHeight: true,
                    },
                },   
                {
                    breakpoint: 768,
                    settings: {
                        fade: false,
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        autoplay: true,
                        adaptiveHeight: true,
                    },
                },
                {
                    breakpoint: 400,
                    settings: {
                        fade: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: true,
                        adaptiveHeight: true,
                    },
                },
            ]
        });
    }
});