$(document).ready(function () {
    /*Placeholder у поиска в шапке*/
    getPlaceholderSearch();

    function getPlaceholderSearch() {
        if($('form').hasClass('form')){
            var innerWidth = window.innerWidth;
            if (innerWidth < 1270) {
                $(".form .search-group input").attr("placeholder", "Поиск");
            }
            else {
                $(".form .search-group input").attr("placeholder", 'Введите ваш запрос, например "Бумага офисная”');
            }
        }
    }
});