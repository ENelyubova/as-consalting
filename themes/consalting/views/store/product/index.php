<?php

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
// Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/store-frontend.css');
// Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/store.js');

/* @var $category StoreCategory */

$this->title = Yii::app()->getModule('store')->metaTitle ?: Yii::t('StoreModule.store', 'Catalog');
$this->description = Yii::app()->getModule('store')->metaDescription;
$this->keywords = Yii::app()->getModule('store')->metaKeyWords;

$this->breadcrumbs = [Yii::t("StoreModule.store", "Услуги")];
?>

<!-- Каталог -->
<div class="store-container catalog-view pb">
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

    <h1 class="heading heading-pb"><?= Yii::t("StoreModule.store", "Услуги"); ?></h1>
    <?php $this->widget('application.modules.store.widgets.CatalogWidget', [
        'view' => 'directions'
    ]); ?>
  </div>
</div>


