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

<div class="page-txt pb">
    <div class="content-site">
        <?php $this->widget(
            'bootstrap.widgets.TbBreadcrumbs',
            [
                'links' => $this->breadcrumbs,
            ]
        );?>
    
        <h1 class="heading heading-page heading-pb"><?= $model->title; ?></h1>

        <?php $images = $model->photos(['order' => 'photos.position DESC']); ?>
        <?php if($images): ?>
            <div class="sertificate-carousel">
                <?php foreach ($images as $key => $image) : ?>
                    <div class="item">
                         <a href="<?= $image->getImageUrl(); ?>">
                            <img src="<?= $image->getImageUrl(); ?>" class="image-preview" data-fancybox="image" href="<?= $image->getImageUrl(); ?>">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

