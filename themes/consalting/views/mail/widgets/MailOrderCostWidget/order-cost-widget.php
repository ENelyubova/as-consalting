<div id="orderCostModal" class="modal modal-my modal-order-cost fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header box-style">
                <div data-dismiss="modal" class="modal-close"><i class="fa fa-times" aria-hidden="true"></i><div></div></div>
                <div class="modal-my-heading" id="myModalLabel">
                    <h3>Запросить <span>расчет стоимости</span></h3>
                    <!-- <p>Оставьте заявку и мы Вам перезвоним!</p> -->
                </div>
            </div>

                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
                    'id'=>'order-cost-form-modal',
                    'type' => 'vertical',
                    'htmlOptions' => [
                        'class'     => 'form-my form-order-cost', 
                        'data-typeorder' => 'ajax-order-cost-form',
                        'enctype'   => 'multipart/form-data', 
                    ],
                ]); ?>

                <?php if (Yii::app()->user->hasFlash('order-cost-success')): ?>
                    <script>
                        $('#orderCostModal').modal('hide');
                        $('#messageModal').modal('show');
                        setTimeout(function(){
                            $('#messageModal').modal('hide');
                        }, 4000);
                    </script>
                <?php endif ?>

                <div class="modal-body">
                    <?= $form->textFieldGroup($model, 'name', [
                        'widgetOptions'=>[
                            'htmlOptions'=>[
                                'class' => '',
                                'autocomplete' => 'off'
                            ]
                        ]
                    ]); ?>
                    <?= $form->maskedTextFieldGroup($model, 'phone', [
                        'widgetOptions' => [
                            'mask' => '+7(999)999-99-99',
                            'htmlOptions'=>[
                                'class' => 'data-mask',
                                'data-mask' => 'phone',
                                'placeholder' => Yii::t('MailModule.mail', 'Ваш телефон'),
                                'autocomplete' => 'off'
                            ]
                        ]
                    ]); ?>
                    <?= $form->textFieldGroup($model, 'email', [
                        'widgetOptions'=>[
                            'htmlOptions'=>[
                                'class' => '',
                                'autocomplete' => 'off'
                            ]
                        ]
                    ]); ?>
                    <div class="form-group">
                        <div class="file-upload">
                            <label for="MailOrderCost_image">
                                <?= $form->fileField($model, 'image'); ?>
                                <span class="fl fl-al-it-c">
                                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                                    <div id="count_file">Прикрепить файл</div>
                                </span>
                            </label>
                        </div>
                        <label>Прикрепите фото помещения (jpg, png, zip, rar): </label>
                        <?= $form->error($model, 'image');?>
                    </div>
                   
                    <?= $form->textAreaGroup($model, 'comment', [
                        'widgetOptions'=>[
                            'htmlOptions'=>[
                                'class' => '',
                            ]
                        ]
                    ]); ?>

                    <?= $form->hiddenField($model, 'verify'); ?>

                    <div class="form-bot">                     
                        <div class="form-button">
                            <?= CHtml::submitButton(Yii::t('MailModule.mail', 'Отправить'), [
                                'id' => 'order-cost-button', 
                                'class' => 'btn btn-blue', 
                                'data-sendorder'=>'ajax-order-cost-btn'
                            ]) ?> 
                        </div>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<?php Yii::app()->clientScript->registerScript('logo-Laying-modal', "
    /*$(document).delegate('.file-upload input[type=file]', 'change', function(){
        var inputFile = document.getElementById('MailOrderCost_image').files;
        if(inputFile.length > 0){
            $('#count_file').text('Выбрано файлов ' + inputFile.length);
        }else{
            $('#count_file').text('Прикрепить логотип');
        }
    });*/
    $(document).delegate('.file-upload input[type=file]', 'change', function(){
        var inputFile = document.getElementById('MailOrderCost_image').files;
        var s = inputFile[0].name;
        var ext = s.substr(s.lastIndexOf('.') + 1);
        if(ext == 'jpg' || ext == 'png' || ext == 'jpeg' || ext == 'zip' || ext == 'rar'){
            $('#count_file').text('Выбрано файлов ' + inputFile.length);
        }else{
            alert('Разрешено загружать только форматы: jpg, png, zip, rar');
            $('#count_file').text('Файл не выбран');
        }
    });
    $(document).on('click', '[data-sendorder=ajax-order-cost-btn]', function(event) {
        var
            button   = $(this),
            form     = button.parents('form'),
            type     = form.attr('method'),
            formId   = form.attr('id');
        var data = new FormData(form.get(0));

        $.ajax({
            type: type,
            data: data,
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            async: false,
            cache: false,
            success: function (html) {
                var newForm = $(html)
                    .find('#'+formId);

                $('#'+formId).html(newForm.html());
                
                if($('#'+formId).find('input[data-mask=phone]').is('.data-mask')){
                    $('#'+formId).find('input[data-mask=phone]')
                        .mask('+7(999)999-99-99', {
                            'placeholder':'_',
                            'completed':function() {
                                //console.log('ok');
                            }
                        });
                }
                
                $.getScript('https://www.google.com/recaptcha/api.js', function () {});
            }
        });

        return false;
    });
") ?>