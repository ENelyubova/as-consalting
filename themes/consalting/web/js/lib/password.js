$(document).ready(function () {
    /*Показать/скрыть пароль в форме*/
    $('.password-input-show').on('click', function(){
        $('.password-form-group').toggleClass('active')
        if($('.password-form-group').hasClass('active') == true){
            $('.password-form-group .form-control').attr('type', 'text');
        }
        else{
            $('.password-form-group .form-control').attr('type', 'password');
        }
    });
});