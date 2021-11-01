<div class="category-item">
    <div class="inner-item">
        <div class="image-category">
            <?= CHtml::link(CHtml::image($data->getImageUrl(350, 350), '', ['alt' => CHtml::encode($data->description), 'title' => CHtml::encode($data->title) ]), Yii::app()->createUrl('/store/category/view', ['path' => $data->path])); ?>
            <div class="item-hover"><?= $data->short_description; ?></div>
        </div>
        <label><?= CHtml::link($data->name, Yii::app()->createUrl('/store/category/view', ['path' => $data->path])); ?></label>
        <p><?= CHtml::link('Подробнее', Yii::app()->createUrl('/store/category/view', ['path' => $data->path])); ?></p>
    </div>
</div>