function showNotify(element, result, message) {
    if(message != undefined){
        $('#notifications').html('<div class="notifications-' + result + '">' + message + '</div>').fadeIn().delay(3000).fadeOut();
    }
}

// $(document).ajaxError(function () {
//     $('#notifications').html('<div class="alert alert-danger">Произошла ошибка =(</div>').fadeIn().delay(3000).fadeOut();
// });

$(document).ready(function () {
    /*
     * фильтры при адаптации
    */
    $(document).delegate('.but-menu-filter', 'click', function() {
        $('body').addClass('bodymenu');
        // $('html').addClass('htmlmenu');
        $("#store-filter").addClass('active');
        $(".sidebar-box").addClass('active');
        return false;
    });
    // $(document).delegate('.sidebar-box', 'click', function(e) {  
    $('.sidebar-box').on('click', function(e){   
        if($(e.target).hasClass('sidebar-box')){
            $('body').removeClass('bodymenu');
            $(".sidebar-box").removeClass('active');
            $("#store-filter").removeClass('active');
            return false;
        }
    });
    $(document).delegate('.filter-block .filter-block__header', 'click', function(){
        var parent = $(this).parents('.filter-block');
        if(parent.hasClass('active')){
            parent.removeClass('active');
        } else{
            $('.filter-block').removeClass('active');
            parent.addClass('active');
        }
        return false; 
    });
    /* Функция для обновления списка */
    function filterUpdate() {
        var form = $('#store-filter'),
            data = form.serialize();
        if (data == '') {
            data={};
        }

        filterListSelected();

        // $('.ajax-loading').fadeIn(500);

        var top = $('#product-box').offset().top - 50;

        $('body,html').animate({
            scrollTop: top + 'px'
        }, 400);

        $.fn.yiiListView.update('product-box', {
            'data': data,
            'url': '',
            complete:function() {
                if($('div').hasClass('raiting-list')){
                    $('.raiting-list input').rating({'starWidth':'16','readOnly':true});
                }
                // $('.ajax-loading').delay(100).fadeOut(500);
            }
        });


        return false;
    };

    $(document).delegate('.js-popular-category', 'click', function(){
        var id = $(this).data('id');

        // $.ajax({
        //     data: 'category_id=' + id,
        //     success: function (html) {
        //         console.log(html);
        //         $('.product-popular-box').html($(html).find('.product-popular-box'));
        //         setTimeout(function () {
        //             $(html).find('.productSlider').slick('refresh');
        //         },500)
        //     }
        // });

        $.fn.yiiListView.update('product-popular-box', {
            'data': 'category_id=' + id,
            'url': '',
            complete:function(data) {
                productCarousel();
            }
        });
        return false;
    });

    /* Клик по постраничной навигации */
    $(document).delegate('#product-box .pagination li a', 'click', function(){
        // $('.ajax-loading').fadeIn(500);
        var top = $('#product-box').offset().top - 50;
        $('body,html').animate({
            scrollTop: top + 'px'
        }, 400);
        // $('.ajax-loading').delay(100).fadeOut(500);
    });

    /* Клик по кнопке применить фильтры */
    $(document).delegate('.but-filter', 'click', function(e){
        
        filterUpdate();

        if($('.filter-block').hasClass('active')){
            $('.filter-block').removeClass('active');
        }
        $('body').removeClass('bodymenu');
        $(".sidebar-box").removeClass('active');
        $("#store-filter").removeClass('active');

        return false;
    });

    /* Кнопка сбросить убираем выделенные фильтры */
    $(document).delegate('.reset-filter, #reset-filter, button[type=reset]', 'click', function(e){
        $('#store-filter').get(0).reset();
        // Saving it's instance to var
        rangeInputUpdate();

        $('.filter-block').removeClass('active');
        // filterUpdate();
        $('body').removeClass('bodymenu');
        $(".sidebar-box").removeClass('active');
        $("#store-filter").removeClass('active');

        return false;
    });
    function rangeInputUpdate(){
        $(".js-range").each(function(){
            var slider = $('#'+$(this).attr('id')).data("ionRangeSlider");
            slider.update({
                from: 0,
                to: $(this).data('max')
            });
        });
    }
    /* Вывод выбранных фильтров*/
    function filterListSelected(){
        var selectedFilters = $('.selected-filters');
        var storeFilter = $('#store-filter');
        var blocks = storeFilter.find('.filter-block__item');
        var elem;
        var flag;
        var elems = [];
        selectedFilters.html('');
        $.each(blocks, function(i, e) {
            elem = $(this).find('input:checked, option:selected, .range-input');
            $.each(elem, function(i, e) {
                var el = $(e);
                var type = null;
                var label = null;
                var flag = null;
                if (e.tagName==='INPUT') {
                    type = el.attr('type');
                    if (type=='radio') {
                        var par = el.parents('.filter-block').find('.filter-block__header span');
                        label = par.data('title') + ': ';
                        label += ' ' + el.next('label').text();
                    } else if(type=='checkbox') {
                        var par = el.parents('.filter-block').find('.filter-block__header span');
                        label = par.data('title') + ': ';
                        label += ' ' + el.next().text();
                    } else if(type=='text') {
                        var value = el.val();
                        if (value) {
                            // label = el.prev('label').text();
                            label = el.parents('.filter-block').find('.filter-block__header span').text() + ': ';
                            label += ' '+el.val();
                        }
                    }
                } else if(el.hasClass('range-input')) {
                    var par = el.parents('.filter-block').find('.filter-block__header span');
                    type = 'number';
                    var value = '';
                    var count = 0;
                    el.find('input').each(function(){
                        if($(this).val()){
                            if(count != 0){
                                value += ' - ';
                            }
                            value += $(this).val();
                            count++;
                        }
                    });
                    if(value){
                        label = par.data('title') + ': ';
                        label += value+' '+par.data('unit');
                    }
                } else {
                    type = 'select';
                    label = el.text();
                }
                if (label && type) {
                    el.parents('.filter-block').addClass('selected');
                    flag = true;
                    elems.push({
                        el: el,
                        type: type,
                        label: label,
                    });
                }
            });
            if(flag===null){
                if($(this).parents('.filter-block').hasClass(selected)){
                    $(this).parents('.filter-block').removeClass('selected');
                }
            }
        });

        if(elems.length > 0){
        }

        $.each(elems, function(i, e) {
            var span = $('<span data-id=#'+e.el.attr("id")+' class="label label-default"></span>');
            span
                .text(e.label);

            selectedFilters.append(span);
        });
        if(elems.length > 0){
            selectedFilters.prepend('<span class="reset-filter">Сбросить фильтры</span>').addClass('active');
        } else{
            selectedFilters.removeClass('active');
            $('.filter-block').removeClass('selected');
        }
    }

    /* Удаление выбраных фильтров при клике на крестик (выделеный красный блок) */
    $(document).delegate('.filter-close', 'click', function(e){
        var parent = $(this).parents('.filter-block');
        var elem = parent.find('input:checked, option:selected, .range-input');
        var type;
        $.each(elem, function(i, e) {
            type = $(this).attr('type')
            if (type=='radio') {
                $(this).prop('checked', false);
            } else if(type=='checkbox') {
                $(this).prop('checked', false);
            } else if(type=='range-input') {
                $(this).find('input').val('');
                rangeInputUpdate();
            } else {
                $(this).prop("selected", false)
            }
        });
        
        parent.removeClass('selected');

        filterUpdate();

        return false;
    });

    /* Удаление фильтров из списка примененных */
    $(document).delegate('.selected-filters span', 'click', function(e){
        var id = $(this).attr('data-id');
        var type = $(id).attr('type');
        var parent = $(id).parents('.filter-block');
        var checked;

        if (type=='radio') {
            $(id).prop('checked', false);
            checked = parent.find('input:checked');
            if(checked.length == 0){
                parent.removeClass('selected');
            }
        } else if(type=='checkbox') {
            $(id).click();
            checked = parent.find('input:checked');
            if(checked.length == 0){
                parent.removeClass('selected');
            }
        } else if(type=='range-input') {
            $(id).find('input').val('');
            rangeInputUpdate();
            parent.removeClass('selected');
        } else {
            $(id).prop("selected", false);
            checked = parent.find('option:selected');
            if(checked.length == 0){
                parent.removeClass('selected');
            }
        }

        filterUpdate()

        return false;
    });

    /* 
     * Сортировка 
    */
    /* Открыть список сортировок */
    $(document).delegate('.box-wrapper__header', 'click', function(){
        $(this).siblings().toggleClass('active');
        $(this).find('.res-link').toggleClass('active');
    });

    /* Клик по любому месту, чтобы закрыть все выпадающие списки */
    /*$(document).delegate('body', 'click', function(e){
        if($(e.target).parents('.filter-block').length < 1){
            $('.filter-block').removeClass('active');
            // return false;
        }
    });*/
    $(document).mouseup(function (e){
        if(!$('.sort-box-wrapper').is(e.target) // если клик был не по нашему блоку
            && $('.sort-box-wrapper').has(e.target).length === 0) { // и не по его дочерним элементам
            $('.sort-box-wrapper__body').removeClass('active'); // скрываем его
            $('.res-link').removeClass('active');
        }
    });

    /* клик по сортировке */
    $(document).delegate('.sort-box-wrapper__link', 'click', function(){
        var elem = $(this);

        $('.sort-box-wrapper__link').removeClass('active');
        $('.sort-box-wrapper__body').removeClass('active');
        $('.res-link').removeClass('active');
        
        if($('.filter-block').hasClass('active')){
            $('.filter-block').removeClass('active');
        }

        $('body').removeClass('bodymenu');
        $(".sidebar-box").removeClass('active');
        $("#store-filter").removeClass('active');
        
        // $('.ajax-loading').fadeIn(500);
        
        var top = $('#product-box').offset().top - 50;
        
        $('body,html').animate({
            scrollTop: top + 'px'
        }, 400);

        $.fn.yiiListView.update('product-box', { 
            data: 'ajax=product-box&sort=' + elem.attr('data-href'),
            complete:function() {
                elem.addClass('active');
                elem.parents('.sort-box-wrapper').removeClass('active');
                elem.parents('.sort-box-wrapper').find('.res-link').html(elem.html());
                // $('.ajax-loading').delay(100).fadeOut(500);
            }
        });
        

        return false;
    });
    
    $(document).delegate('.showmore', 'click', function(){
        var id = $(this).attr('href');
        $('.ajax-loading').fadeIn(500);
        
        var top = $(id).offset().top - 50;
        $('#myTab li').removeClass('active');
        $('#myTab li a[href='+id+']').parent().addClass('active');
        $('body,html').animate({
            scrollTop: top + 'px'
        }, 400);
        
        $('.ajax-loading').delay(100).fadeOut(500);
        return false;
    });

    $(document).delegate('#myTab li a', 'click', function(){
        var innerWidth = window.innerWidth;
        if(innerWidth < 641){
            var id = $(this).attr('href');
            var top = $(id).offset().top - 50;
            $('body,html').animate({
                scrollTop: top + 'px'
            }, 400);
        }
        return true;
    });

    /*
     *  Рейтинг
    */
    // Клик по кнопке, чтобы показать всю таблицу
    $(document).delegate('.raiting-list-form .raiting-list__item', 'click', function(){
        var $this = $(this);
        var id = $this.data('id');
        $('.raiting-list-form .raiting-list__item').removeClass('active');
        $this.addClass('active').prevAll(".raiting-list__item").addClass('active');
        $this.parent().addClass('no-hover');
        $('#Review_rating').val(id);
        return false;
    });
    
});
$(document).ready(function () {
    var cartWidgetSelector = '.js-shopping-cart-widget';

    /*страница продукта*/
    var priceElement = $('#result-price'); //итоговая цена на странице продукта
    var basePrice = parseFloat($('#base-price').val()); //базовая цена на странице продукта
    var quantityElement = $('#product-quantity');
    var quantityInputElement = $('#product-quantity-input');

    /*корзина*/

    var shippingCostElement = $('#cart-shipping-cost'); // Сумма доставки
    var cartFullCostElement = $('#cart-full-cost');  // сумма заказа без доставки со скидкой
    var cartFullCostWithShippingElement = $('#cart-full-cost-with-shipping'); //Итого сумма с доставкой

    /* Сумма заказа без доставки без скидки */
    var cartFullCostElement2 = $('#cart-full-cost2');
    var cartDiscountCost = $('#cart-discount-cost');

    miniCartListeners();
    refreshDeliveryTypes();
    checkFirstAvailableDeliveryType();
    updateAllCosts();

    // Галерея дополнительных изображений в карточке товара
    // $('.js-product-gallery').productGallery();

    // Табы в карточке товара
    // $('.js-tabs').tabs();

    // $(".js-select2").select2();

    $('#start-payment').on('click', function () {
        $('.payment-method-radio:checked').parents('.payment-method').find('form').submit();
    });

    $('body').on('click', '.clear-cart', function (e) {
        e.preventDefault();
        var data = {};
        data[yupeTokenName] = yupeToken;
        $.ajax({
            url: '/coupon/clear',
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data.result) {
                    updateCartWidget();
                }
            }
        });
    });

    $('#add-coupon-code').click(function (e) {
        e.preventDefault();
        var code = $('#coupon-code').val();
        var button = $(this);
        if (code) {
            var data = {'code': code};
            data[yupeTokenName] = yupeToken;
            $.ajax({
                url: '/coupon/add',
                type: 'post',
                data: data,
                dataType: 'json',
                success: function (data) {
                    if (data.result) {
                        window.location.reload();
                    }
                    showNotify(button, data.result ? 'success' : 'danger', data.data.join('; '));
                }
            });
            $('#coupon-code').val('');
        }
    });

    $('.coupon .close').click(function (e) {
        e.preventDefault();
        var code = $(this).siblings('input[type="hidden"]').data('code');
        var data = {'code': code};
        var el = $(this).closest('.coupon');
        data[yupeTokenName] = yupeToken;
        $.ajax({
            url: '/coupon/remove',
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                showNotify(this, data.result ? 'success' : 'danger', data.data);
                if (data.result) {
                    el.remove();
                    updateAllCosts();
                }
            }
        });
    });

    $('#coupon-code').keypress(function (e) {
        if (e.which == 13) {
            e.preventDefault();
            $('#add-coupon-code').click();
        }
    });

    $('.order-form').submit(function () {
        $(this).find("button[type='submit']").prop('disabled', true);
    });

    $('select[name="ProductVariant[]"]').change(function () {
        updatePrice();
    });

    $('.product-quantity-increase').on('click', function () {
        quantityInputElement.val(parseInt(quantityInputElement.val()) + 1).trigger('change');
    });

    $('.product-quantity-decrease').on('click', function () {
        if (parseInt(quantityInputElement.val()) > 1) {
            quantityInputElement.val(parseInt(quantityInputElement.val()) - 1).trigger('change');
        }
    });

    $('#product-quantity-input').change(function (event) {
        var el = $(this);
        quantity = parseInt(el.val());

        if (quantity <= 0 || isNaN(quantity)) {
            quantity = 1;
        }

        var quantityLimiterEl = el.parents('.spinput'),
            minQuantity = parseInt(quantityLimiterEl.data('min-value')),
            maxQuantity = parseInt(quantityLimiterEl.data('max-value'));

        if (quantity < minQuantity) {
            quantity = minQuantity;
        }
        else if (quantity > maxQuantity) {
            quantity = maxQuantity;
        }

        el.val(quantity);
        quantityElement.text(quantity);
        $('#product-total-price').text(parseFloat($('#result-price').text()) * quantity);
    });

    $('body').on('click', '#add-product-to-cart', function (e) {
        e.preventDefault();
        var button = $(this);
        var form = $(this).parents('form');
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: form.serialize(),
            url: form.attr('action'),
            success: function (data) {
                if (data.result) {
                    updateCartWidget();
                }
                showNotify(button, data.result ? 'success' : 'danger', data.data);
            }
        });
    });

    $('body').on('click', '.quick-add-product-to-cart', function (e) {
        e.preventDefault();
        var button = $(this);
        button.addClass('active');
        var form = $(this).parents('form');
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: form.serialize(),
            url: button.data('cart-add-url'),
            success: function (data) {
                if (data.result) {
                    updateCartWidget();
                    setTimeout(function(){
                        button.removeClass('active');
                        button.parents('.product__item').removeClass('active');
                        button.removeClass('quick-add-product-to-cart but-svg but-svg-left but-animation').addClass('but-go-cart').attr('href', '/cart').find('span').html("В корзине");
                    }, 600);
                }
                showNotify(button, data.result ? 'success' : 'danger', data.data);
            }
        });
    });

    /*$('body').on('click', '.quick-add-product-to-cart', function (e) {
        e.preventDefault();
        var el = $(this);
        var data = {'Product[id]': el.data('product-id')};
        el.addClass('active');
        el.parents('.js-product-item').addClass('active');
        data[yupeTokenName] = yupeToken;
        $.ajax({
            url: el.data('cart-add-url'),
            type: 'post',
            data: data,
            dataType: 'html',
            success: function (data) {
                // $('.js-addCartModal-body').html(data);
                // $('#addCartModal').modal('show');
                // if (data.result) {
                    updateCartWidget();
                    setTimeout(function(){
                        el.removeClass('active');
                        el.parents('.js-product-item').removeClass('active');
                        el.removeClass('quick-add-product-to-cart but-svg but-svg-left but-animation').addClass('but-go-cart').attr('href', '/cart').find('span').html("В корзине");
                    }, 600);
                    // el.off('click','.quick-add-product-to-cart');
                    // el.removeClass('btn_cart')
                    //     .addClass('btn_success')
                    //     .html('Оформить заказ')
                    //     .attr('href', '/cart');
                // }
                // showNotify(el, data.result ? 'success' : 'danger', data.data);
            }
        });
    });*/

    /* 
     * количество у продукта
    */
    // $('.product-box-quantity-increase').on('click', function () {
    $(document).delegate('.product-box-quantity-increase', 'click', function(){
        var quantityLimiterEl = $(this).parents('.spinput'),
            maxQuantity = parseInt(quantityLimiterEl.data('max-value'))
        var input = quantityLimiterEl.find('input');
        if(parseInt(input.val()) < maxQuantity){
            input.val(parseInt(input.val()) + 1).trigger('change');
        }
        // showNotify(input, 'success', "Успешно добавлено");
    });

    // $('.product-box-quantity-decrease').on('click', function () {
    $(document).delegate('.product-box-quantity-decrease', 'click', function(){
        var quantityLimiterEl = $(this).parents('.spinput');
        var input = quantityLimiterEl.find('input');
        if (parseInt(input.val()) > 1) {
            input.val(parseInt(input.val()) - 1).trigger('change');
            // showNotify(input, 'success', "Успешно удален");
        }
    });

    $('.product-box-quantity-input').bind("keyup", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }

        if (this.value <= 0 || isNaN(this.value)) {
            this.value = 1;
        }

        var quantityLimiterEl = $(this).parents('.spinput'),
            minQuantity = parseInt(quantityLimiterEl.data('min-value')),
            maxQuantity = parseInt(quantityLimiterEl.data('max-value'));

        if (this.value < minQuantity) {
            this.value = minQuantity;
        }
        else if (this.value > maxQuantity) {
            this.value = maxQuantity;
        }
    });

    $(document).delegate('.product-box-quantity-addcart', 'change', function(event){
        var el = $(this);
        quantity = parseInt(el.val());

        if (quantity <= 0 || isNaN(quantity)) {
            quantity = 1;
        }

        var quantityLimiterEl = el.parents('.spinput'),
            minQuantity = parseInt(quantityLimiterEl.data('min-value')),
            maxQuantity = parseInt(quantityLimiterEl.data('max-value'));

        if (quantity < minQuantity) {
            quantity = minQuantity;
        }
        else if (quantity > maxQuantity) {
            quantity = maxQuantity;
        }

        el.val(quantity);
        el.parents('.product__item').addClass('active').find('.js-product-but').addClass('active');

        changePositionQuantity('product_' + el.data('product-id') + '_', quantity);

        setTimeout(function(){
            el.parents('.product__item').removeClass('active').find('.js-product-but').removeClass('active');
        }, 600);
    });


    $('.cart-quantity-increase').on('click', function () {
        var target = $($(this).data('target'));
        target.val(parseInt(target.val()) + 1).trigger('change');
    });

    $('.cart-quantity-decrease').on('click', function () {
        var target = $($(this).data('target'));
        if (parseInt(target.val()) > 1) {
            target.val(parseInt(target.val()) - 1).trigger('change');
        }
    });

    $('.cart-delete-product').click(function (e) {
        e.preventDefault();
        var el = $(this);
        var data = {'id': el.data('position-id')};
        data[yupeTokenName] = yupeToken;
        $.ajax({
            url: yupeCartDeleteProductUrl,
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data.result) {
                    el.closest('.cart-list__item').remove();

                    if ($('.cart-list .cart-item').length == 0) {
                        $('#order-form').remove();
                        $('.empty-cart').addClass('active');
                    }
                    // $('#cart-total-product-count').text($('.cart-list .cart-item').length);
                    positionCountPr();
                    updateCartTotalCost();
                    updateCartWidget();
                }
            }
        });
    });

    $('.position-count').change(function () {
        var el = $(this).parents('.cart-list__item'),
            positionCountEl = el.find('.position-count');

        var quantity = parseInt(positionCountEl.val());
        var productId = el.find('.position-id').val();

        if (quantity <= 0 || isNaN(quantity)) {
            quantity = 1;
        }

        var quantityLimiterEl = el.find('.spinput'),
            minQuantity = parseInt(quantityLimiterEl.data('min-value')),
            maxQuantity = parseInt(quantityLimiterEl.data('max-value'));

        if (quantity < minQuantity) {
            quantity = minQuantity;
        }
        else if (quantity > maxQuantity) {
            quantity = maxQuantity;
        }

        positionCountEl.val(quantity);

        updatePositionSumPrice(el);
        changePositionQuantity(productId, quantity);
        positionCountPr();
    });

    $('input[name="Order[delivery_id]"]').change(function () {
        updateShippingCost();
    });

    function positionCountPr(){
        var quantityPr = 0;
        $(".cart-list .cart-list__item").each(function(){
            quantityPr = parseInt(quantityPr) + parseInt($(this).find('.position-count').val());
        });
        $('#cart-total-product-count').text(quantityPr);
    }

    function miniCartListeners() {
        $('.mini-cart-delete-product').click(function (e) {
            e.preventDefault();
            var el = $(this);
            var data = {'id': el.data('position-id')};
            data[yupeTokenName] = yupeToken;
            $.ajax({
                url: yupeCartDeleteProductUrl,
                type: 'post',
                data: data,
                dataType: 'json',
                success: function (data) {
                    if (data.result) {
                        updateCartWidget();
                    }
                }
            });
        });

        $('#cart-toggle-link').click(function (e) {
            e.preventDefault();
            $('#cart-mini').toggle();
        });
    }

    function getCartTotalCost() {
        var cost = 0;
        $.each($('.position-sum-price'), function (index, elem) {
            cost += parseFloat($(elem).text());
        });
        var delta = 0;
        var coupons = getCoupons();
        $.each(coupons, function (index, el) {
            if (cost >= el.min_order_price) {
                switch (el.type) {
                    case 0: // руб
                        delta += parseFloat(el.value);
                        break;
                    case 1: // %
                        delta += (parseFloat(el.value) / 100) * cost;
                        break;
                }
            }
        });

        return delta > cost ? 0 : cost - delta;
    }
    function getCartTotalNoDiscountCost() {
        var cost = 0;
        $.each($('.position-full-sum-price'), function (index, elem) {
            cost += parseFloat($(elem).text());
        });
        var delta = 0;
        var coupons = getCoupons();
        $.each(coupons, function (index, el) {
            if (cost >= el.min_order_price) {
                switch (el.type) {
                    case 0: // руб
                        delta += parseFloat(el.value);
                        break;
                    case 1: // %
                        delta += (parseFloat(el.value) / 100) * cost;
                        break;
                }
            }
        });

        return delta > cost ? 0 : cost - delta;
    }

    function getCartDiscountCost() {
        var cost = 0;
        $.each($('.product-price-discount'), function (index, elem) {
            cost += parseFloat($(elem).text());
        });

        return cost;
    }

    function updateCartTotalCost() {
        cartFullCostElement.html(getCartTotalCost());
        cartFullCostElement2.html(getCartTotalNoDiscountCost());
        cartDiscountCost.html(getCartDiscountCost());
        refreshDeliveryTypes();
        updateShippingCost();
        updateFullCostWithShipping();
    }

    function refreshDeliveryTypes() {
        var cartTotalCost = getCartTotalCost();
        $.each($('input[name="Order[delivery_id]"]'), function (index, el) {
            var elem = $(el);
            var availableFrom = elem.data('available-from');
            if (availableFrom.length && parseFloat(availableFrom) >= cartTotalCost) {
                if (elem.prop('checked')) {
                    checkFirstAvailableDeliveryType();
                }
                elem.prop('disabled', true);
            } else {
                elem.prop('disabled', false);
            }
        });
    }

    function checkFirstAvailableDeliveryType() {
        $('input[name="Order[delivery_id]"]:not(:disabled):first').prop('checked', true);
    }

    function getShippingCost() {
        var cartTotalCost = getCartTotalCost();
        var coupons = getCoupons();
        var freeShipping = false;
        $.each(coupons, function (index, el) {
            if (el.free_shipping && cartTotalCost >= el.min_order_price) {
                freeShipping = true;
            }
        });
        if (freeShipping) {
            return 0;
        }
        var selectedDeliveryType = $('input[name="Order[delivery_id]"]:checked');
        if (!selectedDeliveryType[0]) {
            return 0;
        }
        if (parseInt(selectedDeliveryType.data('separate-payment')) || parseFloat(selectedDeliveryType.data('free-from')) <= cartTotalCost) {
            return 0;
        } else {
            return parseFloat(selectedDeliveryType.data('price'));
        }
    }

    function updateShippingCost() {
        shippingCostElement.html(getShippingCost());
        updateFullCostWithShipping();
    }

    function updateFullCostWithShipping() {
        var costRes = getShippingCost() + getCartTotalCost();
        var costRes2 = getShippingCost() + getCartTotalNoDiscountCost();
        cartFullCostWithShippingElement.html(costRes.toFixed(2) * 1);
        cartFullCostElement2.html(costRes2.toFixed(2) * 1);
        cartDiscountCost.html(getCartDiscountCost());
    }

    function updateAllCosts() {
        updateCartTotalCost();
    }

    function updatePrice() {
        var _basePrice = basePrice;
        var variants = [];
        var varElements = $('select[name="ProductVariant[]"]');
        /* выбираем вариант, меняющий базовую цену максимально*/
        var hasBasePriceVariant = false;
        $.each(varElements, function (index, elem) {
            var varId = elem.value;
            if (varId) {
                var option = $(elem).find('option[value="' + varId + '"]');
                var variant = {amount: option.data('amount'), type: option.data('type')};
                switch (variant.type) {
                    case 2: // base price
                        // еще не было варианта
                        if (!hasBasePriceVariant) {
                            _basePrice = variant.amount;
                            hasBasePriceVariant = true;
                        }
                        else {
                            if (_basePrice < variant.amount) {
                                _basePrice = variant.amount;
                            }
                        }
                        break;
                }
            }
        });
        var newPrice = _basePrice;
        $.each(varElements, function (index, elem) {
            var varId = elem.value;
            if (varId) {
                var option = $(elem).find('option[value="' + varId + '"]');
                var variant = {amount: option.data('amount'), type: option.data('type')};
                variants.push(variant);
                switch (variant.type) {
                    case 0: // sum
                        newPrice += variant.amount;
                        break;
                    case 1: // percent
                        newPrice += _basePrice * ( variant.amount / 100);
                        break;
                }
            }
        });

        var price = parseFloat(newPrice.toFixed(2));
        priceElement.html(price);
        $('#product-result-price').text(price);
        $('#product-total-price').text(price * parseInt($('#product-quantity').text()));
    }

    function updateCartWidget() {
        $(cartWidgetSelector).load($('.js-cart-widget').data('cart-widget-url'), function () {
            miniCartListeners();
        });
    }

    function getCoupons() {
        var coupons = [];
        $.each($('.coupon-input'), function (index, elem) {
            var $elem = $(elem);
            coupons.push({
                code: $elem.data('code'),
                name: $elem.data('name'),
                value: $elem.data('value'),
                type: $elem.data('type'),
                min_order_price: $elem.data('min-order-price'),
                free_shipping: $elem.data('free-shipping')
            })
        });
        return coupons;
    }

    function updatePositionSumPrice(tr) {
        var count = parseInt(tr.find('.position-count').val());
        var price = parseFloat(tr.find('.position-price').text());
        var price_old = parseFloat(tr.find('.position-price').attr('data-old-price'));
        var price_discount = parseFloat(tr.find('.product-price-discount').attr('data-discount-price'));
        var sumprice = price * count;
        tr.find('.position-sum-price').html(sumprice.toFixed(2) * 1);
        tr.find('.position-full-sum-price').html(price_old * count);
        tr.find('.product-price-discount').html(price_discount * count);
        updateCartTotalCost();
    }

    function changePositionQuantity(productId, quantity) {
        var data = {'quantity': quantity, 'id': productId};
        data[yupeTokenName] = yupeToken;
        $.ajax({
            url: yupeCartUpdateUrl,
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data.result) {
                    updateCartWidget();
                }
                else {
                    showNotify(this, 'danger', data.data);
                }
            }
        });
    }

    /* анимация перемещения товара  в корзину */
    function moveCartProduct(elem){
        var product = elem.parents('.js-product-item').find(".js-product-image");
        var leftCart = $(".header-bot .js-shopping-cart-widget").offset().left;
        var topCart = $(".header-bot .js-shopping-cart-widget").offset().top;

        if($(".header-fix-content").hasClass('active')){
            leftCart = $(".header-fix .js-shopping-cart-widget").offset().left;
            topCart = $(".header-fix .js-shopping-cart-widget").offset().top;
        }

        $(product).clone().css({
            'position' : 'absolute',
            'z-index' : '9999',
            'opacity' : '0.5',
            top: $(product).offset().top,
            left:$(product).offset().left,
            width: 240
        }).appendTo("body").animate({
            opacity: 0.1,
            left: leftCart,
            top: topCart,
            width: 20}, 1000, function() {
            $(this).remove();
        });
    }
});
