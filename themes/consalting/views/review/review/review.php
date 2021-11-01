
<?php
$this->title = Yii::app()->getModule('review')->metaTitle ?: Yii::t('ReviewModule.news', 'Отзывы');
$this->description = Yii::app()->getModule('review')->metaDescription ?: Yii::app()->getModule('yupe')->siteDescription;

$this->keywords = Yii::app()->getModule('review')->metaKeyWords ?: Yii::app()->getModule('yupe')->siteKeyWords;
// $this->breadcrumbs = $this->getBreadCrumbs();
$this->breadcrumbs = ["Отзывы"];

?>

<div class="page-in">
    <div class="content-site">
        <?php $this->widget(
            'bootstrap.widgets.TbBreadcrumbs',
            [
                'links' => $this->breadcrumbs,
            ]
        );?>
        <h2 class="heading title">Отзывы</h2>

    	<?php //$this->widget('application.components.FtListView', [
         $this->widget('bootstrap.widgets.TbListView', [
            'id' => 'review-box',
            'itemView' => '_item',
            'dataProvider' => $dataProvider,
            'itemsCssClass' => 'review-box',
            'template' => '{items}{pager}',
            'template'=>'
                {items}
                <div class="product-nav">
                    {pager}
                </div>
            ',
            'sorterHeader' => 'Сортировка',
            'htmlOptions' => [
                // "class" => "user-specialist"
            ],
            'pagerCssClass' => 'pagination-box',
            // 'emptyText' => '',
            'emptyTagName' => 'div',
            'emptyCssClass' => 'empty-form',
            'ajaxUpdate'=>true,
            'enableHistory' => false,
            // 'pager' => [
            //     'class' => 'application.components.ShowMorePager',
            //     'buttonText' => 'Читать все отзывы',
            //     'wrapTag' => 'div',
            //     'htmlOptions' => [
            //         'class' => 'but-link'
            //     ],
            //     'wrapOptions' => [
            //         'class' => 'review-pagination'
            //     ],
            // ]
            
            'pagerCssClass' => 'pagination-box',
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
            ]
        ]); ?>
    </div>
    <div class="review-form" id="review-form-more">
        <div class="content-site">
            <h2 class="title">Оставить отзыв о компании</h2>
            <?php $this->widget('application.modules.review.widgets.ReviewWidget'); ?>
            <iframe src="https://yandex.ru/sprav/widget/rating-badge/1325183010" width="150" height="50" frameborder="0"></iframe>
        </div>
    </div>
</div>