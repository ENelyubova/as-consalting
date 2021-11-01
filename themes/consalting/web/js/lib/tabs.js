$(document).delegate('.panel-heading a', 'click', function(){
    var el = $(this);
    el.toggleClass('active');
    el.siblings('.active').removeClass('active');
});
