<?php

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/store-frontend.css');
Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/store.js');

/* @var $category StoreCategory */
$this->title = Yii::t("StoreModule.store", "Search");
$this->breadcrumbs = [
    Yii::t("StoreModule.store", "Catalog") => ['/store/product/index'],
    Yii::t("StoreModule.store", "Search"),
];
?>

<div class="store-container store-container-catalog pb">
    <div class="content-site">

        <div class="breadcrumbs">
            <div class="row">
                <div class="col-xs-12">
                    <?php $this->widget(
                        'bootstrap.widgets.TbBreadcrumbs',
                        [
                          'links' => $this->breadcrumbs,
                        ]
                    );?>
                </div>
            </div>        
        </div>

        <h1 class="heading heading-block"><?= Yii::t("StoreModule.store", "Categories"); ?></h1>

        <div class="product-block fl fl-w">
          <?php $this->widget(
              'bootstrap.widgets.TbListView',
              [
                  'dataProvider' => $dataProvider,
                  'id' => 'product-box',
                  'itemView' => '//store/product/_item',
                  'summaryText' => '',
                  'enableHistory' => true,
                  'cssFile' => false,
                  'itemsCssClass' => 'product-type-box',
                  // 'summaryText'=>"Товаров на странице: <span>{start} - {end} из {count}</span>",
                  'htmlOptions' => [
                    'class' => 'product-type fl-jc-sb'
                  ],
                  'viewData' => [
                      'isButton' => true
                  ],
                  'emptyText'=>'По вашему запросу ничего не найдено',
                  // 'summaryText'=>"Товары <span>{start} - {end} из {count}</span>",
                  'template'=>'
                      {items}
                      {pager}
                  ',
                  'ajaxUpdate'=>true,
                  'enableHistory' => false,
                  /*
                  'sortableAttributes' => [
                      'name',
                      'price',
                  ],*/
              ]
          ); ?>
      </div>
    </div>
</div>

