$(document).ready(function () {
    showDropdownList();

    function showDropdownList(){
        var drop = $('.js-dropdown');

        // Раскрываю dropdown
        drop.on('click', '.dropdown__head', function () {
            $(this).parent().addClass('active');
        });

        // В случае клика вне dropdown
        $(document).mouseup(function (e) {
            if ($('.dropdown__body').has(e.target).length === 0) {
                $('.js-dropdown').removeClass('active');
            }
        });

        // Получаю выбранное значение. В случае callback, возвращаю его
        drop.on('click', '.dropdown__list', function (){
            var parents = $(this).parents('.js-dropdown'),
            valField = parents.find('.dropdown__val'),
            currentVal = $(this).find('span').text();

            valField.text(currentVal);

            drop.removeClass('active');

            // if(callback !== null) callback($(this).find('span'));
        });
    }

    $('.dropdown__list').click(function (){
        showDropdownList(function (current){
            var input = current.attr('data-input'),
            value = current.attr('data-value');

            $(current).parents('form').find('input[name="'+input+'"]').val(value);

            // runReloadForm(current);
        });
    });
});