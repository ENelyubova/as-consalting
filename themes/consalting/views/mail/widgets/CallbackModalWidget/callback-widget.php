<div id="callbackModal" class="modal modal-my modal-my-xs fade" role="dialog">
    <div class="modal-dialog modal-call" role="document">
        <div class="modal-content">
            <div class="row">
            
                <div class="col-sm-12">
                    <div class="modal-header">
                        <div data-dismiss="modal" class="modal-close"><i class="fa fa-times" aria-hidden="true"></i><div></div></div>
                        <div class="modal-my-heading">
                            <h3>Оставьте <span>заявку</span></h3>
                            <p>и мы Вам перезвоним!</p>
                        </div>
                    </div>
                    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
                        'id'=>'callback-form-modal',
                        'type' => 'vertical',
                        'htmlOptions' => ['class' => 'form-my', 'data-type' => 'ajax-form'],
                    ]); ?>

                    <?php if (Yii::app()->user->hasFlash('callback-success')) : ?>
                        <script>
                            $('#callbackModal').modal('hide');
                            $('#messageModal').modal('show');
                            setTimeout(function(){
                                $('#messageModal').modal('hide');
                            }, 5000);
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
                        <div class="form-group">
                            <?= $form->labelEx($model, 'phone', ['class' => 'control-label']) ?>
                            <?php $this->widget('CMaskedTextFieldPhone', [
                                'model' => $model,
                                'attribute' => 'phone',
                                'mask' => '+7(999)999-99-99',
                                'htmlOptions'=>[
                                    'class' => 'data-mask form-control',
                                    'data-mask' => 'phone',
                                    'placeholder' => Yii::t('MailModule.mail', 'Телефон'),
                                    'autocomplete' => 'off'
                                ]
                            ]) ?>
                            <?php echo $form->error($model, 'phone'); ?>
                        </div>

                        <div class="form-row__right">
                            <?= $form->textAreaGroup($model, 'body', [
                                'widgetOptions'=>[
                                    'htmlOptions'=>[
                                        'class' => '',
                                        'autocomplete' => 'off'
                                    ]
                                ]
                            ]); ?>
                        </div>

                        <?= $form->hiddenField($model, 'verify'); ?>
                        <div class="form-bot">
                            <div class="form-captcha">
                                <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>">
                                </div>
                                <?= $form->error($model, 'verifyCode');?>
                            </div>
                            <div class="form-button">
                                <?= CHtml::submitButton(Yii::t('MailModule.mail', 'Отправить'), [
                                    'id' => 'callback-button', 
                                    'class' => 'btn btn-modal', 
                                    'data-send'=>'ajax'
                                ]) ?>
                            </div>
                        </div>
                        <!-- <div class="terms_of_use"> 
                            <?php if (Yii::app()->hasModule('contentblock')): ?>
                                <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'policy-form']); ?>
                            <?php endif; ?>
                         </div> -->
                    </div>
                <?php $this->endWidget(); ?>

                </div>
            </div>
        </div>
    </div>
</div>