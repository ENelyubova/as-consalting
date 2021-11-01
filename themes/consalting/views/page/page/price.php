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

<div class="page-price pb">
    <div class="content-site">
        <?php $this->widget(
            'bootstrap.widgets.TbBreadcrumbs',
            [
                'links' => $this->breadcrumbs,
            ]
        );?>
        <div class="heading-block fl fl-w fl-ai-c fl-jc-sb">
            <h1 class="heading heading-page"><?= $model->title; ?></h1>
            <?php if($model->document) : ?>
                <a href="<?= $model->getDocumentUrl(); ?>" class="page-price__download btn" target="_blank">
                    Скачать прайс-лист
                </a>
            <?php endif; ?>
        </div>
        <div class="price-content">
            <?php $this->widget("application.modules.page.widgets.PagesNewWidget", [
                'id'=> 4,
                'view' => 'price-page'
            ]); ?>
        </div>
    </div>
</div>
