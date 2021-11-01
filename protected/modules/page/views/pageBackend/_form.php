<?php
/**
 * @category YupeView
 * @package  yupe
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     https://yupe.ru
 *
 * @var $this PageBackendController
 * @var $model Page
 * @var $form \yupe\widgets\ActiveForm
 */
?>
<script type='text/javascript'>
    $(document).ready(function () {
        $('#menu_id').change(function () {
            var menuId = parseInt($(this).val());
            if (menuId) {
                $.post('<?= Yii::app()->createUrl('/menu/menuitemBackend/getjsonitems/') ?>', {
                    '<?= Yii::app()->getRequest()->csrfTokenName;?>': '<?= Yii::app()->getRequest()->csrfToken;?>',
                    'menuId': menuId
                }, function (response) {
                    if (response.result) {
                        var option = false;
                        var current = <?= (int)$menuParentId; ?>;
                        $.each(response.data, function (index, element) {
                            if (index == current) {
                                option = true;
                            } else {
                                option = false;
                            }
                            $('#parent_id').append(new Option(element, index, option));
                        })
                        if (current) {
                            $('#parent_id').val(current);
                        }
                        $('#parent_id').removeAttr('disabled');
                        $('#pareData').show();
                    }
                });
            }
        });

        if ($('#menu_id').val() > 0) {
            $('#menu_id').trigger('change');
        }
    })
</script>

<ul class="nav nav-tabs">
    <li class="active"><a href="#common" data-toggle="tab"><?= Yii::t("PageModule.page", "General"); ?></a></li>
    <li><a href="#options" data-toggle="tab"><?= Yii::t("PageModule.page", "More options"); ?></a></li>
    <li><a href="#seo" data-toggle="tab"><?= Yii::t("PageModule.page", "Data for SEO"); ?></a></li>
    <li><a href="#photos" data-toggle="tab"><?= Yii::t("PageModule.page", "Галерея"); ?></a></li>
    <li><a href="#setting" data-toggle="tab"><?= Yii::t("PageModule.page", "Произвольные поля"); ?></a></li>
</ul>

<?php

$form = $this->beginWidget(
    'yupe\widgets\ActiveForm',
    [
        'id' => 'page-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'htmlOptions' => ['class' => 'well', 'enctype' => 'multipart/form-data'],
    ]
); ?>
<div class="alert alert-info">
    <?= Yii::t('PageModule.page', 'Fields with'); ?>
    <span class="required">*</span>
    <?= Yii::t('PageModule.page', 'are required.'); ?>
</div>

<?= $form->errorSummary($model); ?>

<div class="tab-content">
    <div class="tab-pane active" id="common">

        <?php if (Yii::app()->hasModule('menu')): { ?>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <?= CHtml::label(Yii::t('PageModule.page', 'Menu'), 'menu_id'); ?>
                        <?= CHtml::dropDownList(
                            'menu_id',
                            $menuId,
                            CHtml::listData(Menu::model()->active()->findAll(['order' => 'name DESC']), 'id', 'name'),
                            ['empty' => Yii::t('PageModule.page', '-choose-'), 'class' => 'form-control']
                        ); ?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div id="pareData" style='display:none;'>
                            <?= CHtml::label(Yii::t('PageModule.page', 'Parent menu item'), 'parent_id'); ?>
                            <?= CHtml::dropDownList(
                                'parent_id',
                                $menuParentId,
                                ['0' => Yii::t('PageModule.page', 'Root')],
                                [
                                    'disabled' => true,
                                    'empty' => Yii::t('PageModule.page', '-choose-'),
                                    'class' => 'form-control'
                                ]
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } endif ?>

        <div class="row">
            <div class="col-sm-3">
                <?= $form->dropDownListGroup(
                    $model,
                    'category_id',
                    [
                        'widgetOptions' => [
                            'data' => Yii::app()->getComponent('categoriesRepository')->getFormattedList($this->getModule()->mainCategory),
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'empty' => Yii::t('PageModule.page', '--choose--'),
                                'data-original-title' => $model->getAttributeLabel('category_id'),
                                'data-content' => $model->getAttributeDescription('category_id'),
                                'encode' => false
                            ],
                        ],
                    ]
                ); ?>
            </div>
            <?php if (count($languages) > 1) : { ?>
                <div class="col-sm-4">
                    <?= $form->dropDownListGroup(
                        $model,
                        'lang',
                        [
                            'widgetOptions' => [
                                'data' => $languages,
                                'htmlOptions' => [
                                    'class' => 'popover-help',
                                    'empty' => Yii::t('PageModule.page', '--choose--')
                                ],
                            ],
                        ]
                    ); ?>
                </div>
                <div class="col-sm-4">
                    <br/>
                    <?php if (!$model->isNewRecord) : { ?>
                        <?php foreach ($languages as $k => $v) : { ?>
                            <?php if ($k !== $model->lang) : { ?>
                                <?php if (empty($langModels[$k])) : { ?>
                                    <a href="<?= $this->createUrl(
                                        '/page/pageBackend/create',
                                        ['id' => $model->id, 'lang' => $k]
                                    ); ?>"><i class="iconflags iconflags-<?= $k; ?>"
                                              title="<?= Yii::t(
                                                  'PageModule.page',
                                                  'Add translation for {lang}',
                                                  ['{lang}' => $v]
                                              ); ?>"></i></a>
                                <?php } else : { ?>
                                    <a href="<?= $this->createUrl(
                                        '/page/pageBackend/update',
                                        ['id' => $langModels[$k]]
                                    ); ?>"><i class="iconflags iconflags-<?= $k; ?>"
                                              title="<?= Yii::t(
                                                  'PageModule.page',
                                                  'Edit translation for {lang} language',
                                                  ['{lang}' => $v]
                                              ); ?>"></i></a>
                                <?php } endif; ?>
                            <?php } endif; ?>
                        <?php } endforeach; ?>
                    <?php } endif; ?>
                </div>
            <?php } else : { ?>
                <?= $form->hiddenField($model, 'lang'); ?>
            <?php } endif; ?>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <?= $form->dropDownListGroup(
                    $model,
                    'status',
                    [
                        'widgetOptions' => [
                            'data' => $model->statusList,
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'empty' => Yii::t('PageModule.page', '--choose--'),
                                'data-original-title' => $model->getAttributeLabel('status'),
                                'data-content' => $model->getAttributeDescription('status'),
                                'data-container' => 'body',
                            ],
                        ],
                    ]
                ); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->dropDownListGroup(
                    $model,
                    'parent_id',
                    [
                        'widgetOptions' => [
                            'data' => $pages,
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'empty' => Yii::t('PageModule.page', '--choose--'),
                                'data-original-title' => $model->getAttributeLabel('parent_id'),
                                'data-content' => $model->getAttributeDescription('parent_id'),
                                'encode' => false,
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup(
                    $model,
                    'title_short',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'data-original-title' => $model->getAttributeLabel('title_short'),
                                'data-content' => $model->getAttributeDescription('title_short')
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup(
                    $model,
                    'title',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'data-original-title' => $model->getAttributeLabel('title'),
                                'data-content' => $model->getAttributeDescription('title')
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?= $form->slugFieldGroup(
                    $model,
                    'slug',
                    [
                        'sourceAttribute' => 'title',
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'data-original-title' => $model->getAttributeLabel('slug'),
                                'data-content' => $model->getAttributeDescription('slug'),
                                'placeholder' => Yii::t(
                                    'PageModule.page',
                                    'For automatic generation leave this field empty'
                                ),
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?= $form->checkBoxGroup(
                    $model,
                    'is_protected',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'data-original-title' => $model->getAttributeLabel('is_protected'),
                                'data-content' => $model->getAttributeDescription('is_protected')
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <?= $form->textFieldGroup(
                    $model,
                    'price',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'data-original-price' => $model->getAttributeLabel('price'),
                                'data-content' => $model->getAttributeDescription('price')
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 popover-help" data-original-title='<?= $model->getAttributeLabel('body_short'); ?>'
                 data-content='<?= $model->getAttributeDescription('body_short'); ?>'>
                <?= $form->labelEx($model, 'body_short'); ?>
                <?php
                $this->widget(
                    $this->module->getVisualEditor(),
                    [
                        'model' => $model,
                        'attribute' => 'body_short',
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 popover-help" data-original-title='<?= $model->getAttributeLabel('body'); ?>'
                 data-content='<?= $model->getAttributeDescription('body'); ?>'>
                <?= $form->labelEx($model, 'body'); ?>
                <?php
                $this->widget(
                    $this->module->getVisualEditor(),
                    [
                        'model' => $model,
                        'attribute' => 'body',
                    ]
                ); ?>
        </div>
        <div class='row'>
            <div class="col-sm-5">
                <?php
                echo CHtml::image(
                    !$model->isNewRecord && $model->image ? $model->getImageUrl(100, 100) : '#',
                    '',
                    [
                        'class' => 'preview-image',
                        'style' => !$model->isNewRecord && $model->image ? '' : 'display:none',
                    ]
                ); ?>

                <?php if (!$model->isNewRecord && $model->image): ?>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="delete-file1"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                        </label>
                    </div>
                <?php endif; ?>

                <?= $form->fileFieldGroup($model, 'image'); ?>

            </div>
        </div>

        <div class='row'>
            <div class="col-sm-7">
                <?= (!$model->isNewRecord && $model->document) ? $model->document : ''; ?>
                <?php if (!$model->isNewRecord && $model->document): ?>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="delete-file3"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                        </label>
                    </div>
                <?php endif; ?>

                <?= $form->fileFieldGroup($model, 'document'); ?>

            </div>
        </div>

            <!-- <div class='row'>
                <div class="col-sm-7">
                    <?php
                    echo CHtml::image(
                        !$model->isNewRecord && $model->icon ? $model->getIconUrl(100, 100) : '#',
                        '',
                        [
                            'class' => 'preview-image',
                            'style' => !$model->isNewRecord && $model->icon ? '' : 'display:none',
                        ]
                    ); ?>

                    <?php if (!$model->isNewRecord && $model->icon): ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="delete-file2"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                            </label>
                        </div>
                    <?php endif; ?>

                    <?= $form->fileFieldGroup($model, 'icon'); ?>

                </div>
            </div> -->
        </div>

        <br/>
    </div>

    <div class="tab-pane" id="options">

        <div class="row">
            <div class="col-sm-3">
                <?= $form->dropDownListGroup(
                    $model,
                    'layout',
                    [
                        'widgetOptions' => [
                            'data' => Yii::app()->getModule('yupe')->getLayoutsList(),
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'empty' => Yii::t('PageModule.page', '--choose--'),
                                'data-original-title' => $model->getAttributeLabel('layout'),
                                'data-content' => $model->getAttributeDescription('layout'),
                            ],
                        ],
                    ]
                ); ?>
            </div>
            <div class="col-sm-3">
                <?= $form->textFieldGroup(
                    $model,
                    'view',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'data-original-title' => $model->getAttributeLabel('view'),
                                'data-content' => $model->getAttributeDescription('view'),
                            ],
                        ],
                    ]
                ); ?>
            </div>

            <div class="col-sm-3">
                <?= $form->textFieldGroup(
                    $model,
                    'order',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'data-original-title' => $model->getAttributeLabel('order'),
                                'data-content' => $model->getAttributeDescription('order'),
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="seo">

        <div class="row">
            <div class="col-xs-7">
                <?= $form->textFieldGroup(
                    $model,
                    'meta_title',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'data-original-title' => $model->getAttributeLabel('meta_title'),
                                'data-content' => $model->getAttributeDescription('meta_title'),
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-7">
                <?= $form->textFieldGroup(
                    $model,
                    'meta_keywords',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'class' => 'popover-help',
                                'data-original-title' => $model->getAttributeLabel('meta_keywords'),
                                'data-content' => $model->getAttributeDescription('meta_keywords'),
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-7">
                <?= $form->textAreaGroup(
                    $model,
                    'meta_description',
                    [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'rows' => 8,
                                'class' => 'popover-help',
                                'data-original-title' => $model->getAttributeLabel('meta_description'),
                                'data-content' => $model->getAttributeDescription('meta_description'),
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="photos">
        <div id="photos">
            <style type="text/css">
                .image-wrapper{
                    border: 1px solid #cecece;
                }
                .gallery-thumbnail .move-sign{
                    left: 50%;
                    top: 50%;
                    transform: translate(-50%, -50%);
                }
                #page-photos{
                    width:  auto;
                    text-align: center
                }
                .page-photo{
                    display: block;
                    float: left;
                    margin: 5px;
                    position: relative;
                }
                .page-photo .form-group label{
                    font-size: 12px;
                }
                .page-photo__img{
                    position: relative;
                    padding: 0 0 10px;
                }
                .page-delete-photo{
                    position: absolute;
                    top:  5px;
                    right:  5px;
                }
                .page-delete-photo .fa-fw {
                    color: #fff;
                    font-size: 1.5em;
                    padding: 3px;
                    background: rgba(0, 0, 0, 0.3);
                }
            </style>
           <?php 
               Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
               $mainAssets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('gallery.views.assets'));
                Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/gallery.css');
                Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/gallery-sortable.js', CClientScript::POS_END);
                
                $this->widget('gallery.extensions.colorbox.ColorBox', [
                    'target' => '.gallery-image',
                    'config' => [ // тут конфиги плагина, подробнее http://www.jacklmoore.com/colorbox
                    ],
                ]);
                $keys = [];
                ?>
    
    
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Добавить изображения</label>
                            <?php echo CHtml::fileField("PageImage[][image]",'', ['multiple'=>true]); ?><br/>
                        </div>
                    </div>
                </div>
                <?php if (!$model->getIsNewRecord()): ?>
                    <div id="gallery-wrapper">
                        <div class="row gallery-thumbnails thumbnails">
                            <?php foreach ($model->photos(['order' => 'position DESC']) as $image): ?>
                                <?php $keys[] = sprintf('<span data-order="%d">%d</span>', $image->position, $image->id); ?>
                                <div class="image-wrapper">
                                    <div class="gallery-thumbnail">
                                        <div class="page-photo">
                                            <div class="page-photo__img">
                                                <div class="move-sign">
                                                    <span class="fa fa-4x fa-arrows"></span>
                                                </div>
                                                <a data-id="<?= $image->id; ?>" href="<?= Yii::app()->createUrl(
                                                    '/page/pageBackend/deletePhoto',
                                                    ['id' => $image->id]
                                                ); ?>" class="pull-right page-delete-photo"><i class="fa fa-fw fa-times"></i></a>
                                                <img src="<?= $image->getImageUrl(170, 170); ?>" alt=""/>
                                            </div>
                                            <div class="form-group">
                                                <?= CHtml::textField('PageImage['.$image->id.'][title]', $image->title,['class' => 'form-control', 'placeholder' => 'Title']) ?>
                                            </div>
                                            <div class="form-group">
                                                <?= CHtml::textField('PageImage['.$image->id.'][alt]', $image->alt,['class' => 'form-control', 'placeholder' => 'Alt']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <div class="sortOrder hidden"
                data-token-name="<?= Yii::app()->getRequest()->csrfTokenName; ?>"
                data-token="<?= Yii::app()->getRequest()->getCsrfToken(); ?>"
                data-action="<?= Yii::app()->createUrl('/page/pageBackend/sortablephoto') ?>"
                >
                <?= implode('', $keys) ?>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="setting">
        <?php $this->renderPartial('_my-custom-field', ['model' => $model]) ?>
    </div>
</div>

<br/><br/>

<?php
$this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $model->isNewRecord ? Yii::t('PageModule.page', 'Create page and continue') : Yii::t(
            'PageModule.page',
            'Save page and continue'
        ),
    ]
); ?>

<?php
$this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label' => $model->isNewRecord ? Yii::t('PageModule.page', 'Create page and close') : Yii::t(
            'PageModule.page',
            'Save page and close'
        ),
    ]
); ?>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(function () {
        $('.page-delete-photo').on('click', function (event) {
            event.preventDefault();
            var blockForDelete = $(this).closest('.image-wrapper');
            $.ajax({
                type: "POST",
                data: {
                    'id': $(this).data('id'),
                    '<?= Yii::app()->getRequest()->csrfTokenName;?>': '<?= Yii::app()->getRequest()->csrfToken;?>'
                },
                url: '<?= Yii::app()->createUrl('/page/pageBackend/deleteImage');?>',
                success: function () {
                    blockForDelete.remove();
                }
            });
        });
    });
    $(this).closest('.page-image').remove();
    $('#page-images').on('click', '.button-delete-image', function () {
        $(this).closest('.row').remove();
    });
</script>
