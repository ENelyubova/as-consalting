<?php
/**
* Отображение для video/index
*
* @category YupeView
* @package  yupe
* @author   Yupe Team <team@yupe.ru>
* @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
* @link     http://yupe.ru
**/
$this->title = Yii::t('VideoModule.video', 'video');
$this->description = Yii::t('VideoModule.video', 'video');
$this->keywords = Yii::t('VideoModule.video', 'video');

$this->breadcrumbs = [
	Yii::t('VideoModule.video', 'video')
]; ?>

<div class="page-content">
    <div class="content">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
                'links' => $this->breadcrumbs,
        ]); ?>

        <h1><?= Yii::app()->getModule('video')->title; ?></h1>

        <?php 
            $this->widget('bootstrap.widgets.TbListView', [
                'dataProvider' => $dataProvider,
                // 'id' => 'catalog-box__product',
                'itemView' => '_video',
                'template'=>"
                    {items}
                    {pager}",
                'summaryText' => '',
                'enableHistory' => true,
                'cssFile' => false,
                'itemsCssClass' => 'video-box video-page',
                'sortableAttributes' => [
                    'name' => 'Название',
                    'price',
                ],
                'sorterHeader' => '<div class="sorter__description">Сортировать по: </div>',
                'htmlOptions' => [
                    // 'class' => 'catalog-box__product'
                ],
                'pagerCssClass' => 'pagination-box',
                'ajaxUpdate' => true,
                'pager' => [
                    'header' => '',
                    'lastPageLabel' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    'firstPageLabel' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                    'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                    'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                    'maxButtonCount' => 5,
                    'htmlOptions' => [
                        'class' => 'pagination'
                    ],
                ],
            ]); ?>
    </div>
</div>

<?php $fancybox = $this->widget(
        'gallery.extensions.fancybox3.AlFancybox', [
            'target' => '[data-fancybox]',
            'lang'   => 'ru',
            'config' => [
                'animationEffect' => "fade",
                'buttons' => [
                    "zoom",
                    "close",
                ]
            ],
        ]
    ); ?>
