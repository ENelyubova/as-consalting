<?php $hasFlash = Yii::app()->user->hasFlash($this->successKey) ?>

<?php if ($this->buttonModal) : ?>
    <?= CHtml::link($this->buttonModal, "#{$this->id}", [
        'data-toggle' => 'modal',
        'data-target' => "#{$this->id}",
    ])  ?>
<?php endif; ?>
<?= CHtml::openTag('div', $this->modalHtmlOptions) ?>
    <div class="modal-wrap fl fl-jc-c fl-ai-c">
        <div class="modal-dialog fl fl-jc-c">
            <div class="modal-content">
                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', $this->formOptions) ?>
                    <div class="modal-header">
                        <div data-dismiss="modal" class="modal-close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 20" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.5607 2.56066C20.1464 1.97487 20.1464 1.02513 19.5607 0.43934C18.9749 -0.146447 18.0251 -0.146447 17.4393 0.43934L10 7.87868L2.56066 0.43934C1.97487 -0.146447 1.02513 -0.146447 0.43934 0.43934C-0.146447 1.02513 -0.146447 1.97487 0.43934 2.56066L7.87868 10L0.43934 17.4393C-0.146447 18.0251 -0.146447 18.9749 0.43934 19.5607C1.02513 20.1464 1.97487 20.1464 2.56066 19.5607L10 12.1213L17.4393 19.5607C18.0251 20.1464 18.9749 20.1464 19.5607 19.5607C20.1464 18.9749 20.1464 18.0251 19.5607 17.4393L12.1213 10L19.5607 2.56066Z" fill="black"/></svg>
                        </div>
                        <div class="modal-heading" id="myModalLabel">
                            <h3><?= $this->titleModal; ?></h3>
                        </div>
                    </div>
                    <div class="modal-body">
                        <p><?= $this->subTitleModal ?></p>
                        <?php if ($hasFlash) : ?>
                            <script>

                                $("#<?= $this->id; ?>").modal('hide');
                                $("#messageModal").modal('show');
                                setTimeout(function(){
                                    $("#messageModal").modal('hide');
                                }, 4000);
                            </script>
                            
                        <?php endif ?>
                            
                        <?= $form->hiddenField($model, 'key', ['value' => $this->id]) ?>
                        <?php if ($this->showAttributeName) : ?>
                            <?= $form->textFieldGroup($model, 'name', [
                                'widgetOptions'=>[
                                    'htmlOptions'=>[
                                        'class' => '',
                                        'autocomplete' => 'off'
                                    ]
                                ]
                            ]); ?>
                        <?php endif ?>

                        <?php if ($this->showAttributePhone) : ?>
                            <?= $form->maskedTextFieldGroup($model, 'phone', [
                                'widgetOptions' => [
                                    'mask' => '+7(999)999-99-99',
                                    'id' => 'phone-'.$this->id,
                                    'htmlOptions'=>[
                                        'class' => 'data-mask',
                                        'data-mask' => 'phone',
                                        'placeholder' => Yii::t('MailModule.mail', 'Ваш телефон'),
                                        'autocomplete' => 'off'
                                    ]
                                ]
                            ]); ?>
                        <?php endif ?>

                        <?php if ($this->showAttributeEmail) : ?>
                            <?= $form->textFieldGroup($model, 'email') ?>
                        <?php endif ?>

                        <?php if ($this->showAttributeBody) : ?>
                            <?= $form->textAreaGroup($model, 'body') ?>
                        <?php endif ?>

                        <?= $form->hiddenField($model, 'product') ?>

                        <div class="form-bot">
                            <div class="form-captcha">
                                <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>"></div>
                                <?= $form->error($model, 'verify');?>
                            </div>
                            <div class="form-button">
                                <?php if ($this->showCloseButton) : ?>
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t("mailModule.mail", "Close"); ?></button>
                                <?php endif ?>
                                    <button id="<?= $this->sendButtonId ?>" type="submit" class="btn btn-blue btn-hover">
                                        <?= $this->sendButtonText ?>
                                    </button>
                            </div>
                        </div>
                        <div class="terms_of_use">
                            * Оставляя заявку Вы соглашаетесь с 
                            <a target="_blank" href="/pravovaya-informaciya"><?= Yii::t("mailModule.mail", "Политикой конфиденциальности"); ?></a>
                        </div>
                    </div>
                <?php $this->endWidget() ?>
            </div>
            <div class="modal-img">
                <button data-dismiss="modal" class="modal-close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 20" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.5607 2.56066C20.1464 1.97487 20.1464 1.02513 19.5607 0.43934C18.9749 -0.146447 18.0251 -0.146447 17.4393 0.43934L10 7.87868L2.56066 0.43934C1.97487 -0.146447 1.02513 -0.146447 0.43934 0.43934C-0.146447 1.02513 -0.146447 1.97487 0.43934 2.56066L7.87868 10L0.43934 17.4393C-0.146447 18.0251 -0.146447 18.9749 0.43934 19.5607C1.02513 20.1464 1.97487 20.1464 2.56066 19.5607L10 12.1213L17.4393 19.5607C18.0251 20.1464 18.9749 20.1464 19.5607 19.5607C20.1464 18.9749 20.1464 18.0251 19.5607 17.4393L12.1213 10L19.5607 2.56066Z" fill="black"/></svg>
                </button>
            </div>
        </div>
    </div>
<?= CHtml::closeTag('div') ?>

<?php Yii::app()->clientScript->registerScript($this->id.'-script', "
$('#{$this->modalHtmlOptions['id']}').on('show.bs.modal', function (e) {
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    $.getScript('https://www.google.com/recaptcha/api.js', function () {});
    head.appendChild(script);
});

$(document).delegate('.js-modal-show', 'click', function() {
    var theme = $(this).data('name');
    $('#{$this->formOptions['id']}').find('#LightForm_product').val(theme);
    $($(this).data('modal')).modal('show');
    return false;
});

$(document).delegate('#{$this->formOptions['id']}', 'submit', function() {
    var form = $(this);
    var data = form.serialize();
    var url = form.attr('action');
    var type = form.attr('method');
    var selectorForm = '#{$this->formOptions['id']}';
    $.ajax({
        url: url,
        type: type,
        data: data,
        dataType: 'html',
        success: function(data) {
            $(selectorForm).html($(data).find(selectorForm).html());
            // var mask = $('.js-code-phone option:selected').data('mask');
            // if (mask !== undefined) {
            // }
            $('[data-mask=phone]').mask('+7(999)999-99-99', {
                'placeholder':'_',
                'completed':function() {
                    //console.log('ok');
                }
            });
            $.getScript('https://www.google.com/recaptcha/api.js', function () {});
        }
    })
    return false;
})
") ?>