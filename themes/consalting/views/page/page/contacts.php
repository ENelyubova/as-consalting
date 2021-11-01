<?php
/* @var $model Page */
/* @var $this PageController */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title;
$this->breadcrumbs = $this->getBreadCrumbs();
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: Yii::app()->getModule('yupe')->siteKeyWords;
?>

<div class="page-contacts js-load-chapche pb">
    <div class="content-site">
        <?php $this->widget(
            'bootstrap.widgets.TbBreadcrumbs',
            [
                'links' => $this->breadcrumbs,
            ]
        );?>
        <h1 class="page-contacts__heading heading heading-page">Контактная <br>информация</h1>
    </div>
    <div class="page-contacts__body">
        <div class="content-site">
            <div class="contacts-panel">
                <div class="contacts-panel__item fl fl-w fl-ai-c">
                    <div class="contacts-panel__label contacts-panel__box">Единый многоканальный номер телефона для связи с нами. <br>
                    Мы работаем с 9:00 до 18:00. Оперативно отвечаем на все вопросы</div>
                    <div class="contacts-panel__data contacts-panel__box fl fl-w fl-ai-c fl-jc-sb">
                        <?php if (Yii::app()->hasModule('contentblock')) : ?>
                            <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'phone']); ?>
                        <?php endif; ?>
                        <a href="#callbackModal" data-toggle="modal" class="btn btn-blue btn-svg btn-svg-right btn-hover" href="/o-kompanii">
                            <span>Перезвоните мне</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#ffffff" stroke-width="2"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="contacts-panel__item fl fl-w fl-ai-c">
                    <div class="contacts-panel__label contacts-panel__box">Все вопросы, пожелания, предложения вы можете направить на почту <br>компании</div>
                    <div class="contacts-panel__data contacts-panel__box fl fl-w fl-ai-c">
                        <?php if (Yii::app()->hasModule('contentblock')) : ?>
                            <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'email']); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="contacts-panel__item fl fl-w fl-ai-c">
                    <div class="contacts-panel__label contacts-panel__box">Следите за обновлениями и новостями в социальных сетях</div>
                    <div class="contacts-panel__data contacts-panel__box social">
                        <?php if (Yii::app()->hasModule('contentblock')) : ?>
                            <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'social']); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="contacts-panel__item fl fl-w fl-ai-c">
                    <div class="contacts-panel__label contacts-panel__box">Мы находимся по адресу</div>
                    <div class="contacts-panel__data contacts-panel__box">
                        <p>
                            <?php if (Yii::app()->hasModule('contentblock')) : ?>
                                <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'address']); ?>
                            <?php endif; ?>
                        </p>
                        <a class="btn btn-link btn-link-blue" data-fancybox="" data-type="iframe" data-src="https://yandex.ru/map-widget/v1/?um=constructor%3A84065e870cb2bea2cbf8b575234431ad87bb6c101d494faadd95f2d2b692e921&amp;source=constructor"  href="javascript:;">Показать на карте</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-contacts__form pt">
        <div class="content-site">
            <div class="callback-form">
                <div class="callback-form__title">
                    <h2 class="heading heading-pb">Есть вопросы? <br>Задайте их нашим <br>специалистам</h2>
                </div>
                <?php $this->widget('application.modules.mail.widgets.GeneralFeedbackWidget', [
                    'id' => 'contactModal',
                    'view' => 'contact-form',
                    'formClassName' => 'StandartForm',
                    'buttonModal' => false,
                    'titleModal' => 'Оставьте <span>заявку</span>',
                    'subTitleModal' => 'и мы Вам перезвоним!',
                    'showCloseButton' => false,
                    'isRefresh' => true,
                    'eventCode' => 'napisat-nam',
                    'successKey' => 'napisat-nam',
                    'showAttributeBody' => true,
                    'showAttributeEmail' => true,
                    'showAttributeCheck' => true,
                    // 'required' => 'emailRequired',
                    'modalHtmlOptions' => [
                        'class' => 'modal-my modal-my-xs',
                    ],
                    'formOptions' => [
                        'htmlOptions' => [
                            'class' => 'form-callback',
                        ]
                    ],
                    'modelAttributes' => [
                        'theme' => 'Написать нам',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
