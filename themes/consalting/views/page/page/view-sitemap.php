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

<div class="page-sitemap pb">
	<div class="content-site">
        <?php $this->widget(
            'bootstrap.widgets.TbBreadcrumbs',
            [
                'links' => $this->breadcrumbs,
            ]
        );?>
    
        <h1 class="heading heading-page heading-pb"><?= $model->title; ?></h1>
        
        <div class="sitemap-block">
            <?php $this->widget('application.modules.store.widgets.CategoryWidget', [
                'view' => 'category-widget'
            ]); ?>
            <?php if (Yii::app()->hasModule('menu')) : ?>
                <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'top-menu', 'view' => 'menu']); ?>
            <?php endif; ?>  
            <?php $this->widget("application.modules.news.widgets.MyNewsWidget", [
                'view' => 'news-sitemap',
            ]); ?>
        </div>
    </div>
</div>

