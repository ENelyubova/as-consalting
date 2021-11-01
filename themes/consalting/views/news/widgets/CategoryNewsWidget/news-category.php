<div class="heading">
    <h2><?=  $category->name; ?></h2>
</div>
<?php if (isset($models) && $models != []): ?>
    <?php foreach ($models as $model): ?>
        <div class="reviews-item">
            <div class="face">
                <?= CHtml::image($model->getImageUrl(70, 70)); ?>
            </div>
            <div class="comment">
                <label><?= $model->title; ?></label>
                <span><?= Yii::app()->dateFormatter->format("dd.MM.yyyyг.", $model->date); ?></span>
                <div class="comment-text"><?= $model->short_text; ?></div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="reviews-btn">
        <button class="btn btn-white">
            <?= CHtml::link('Читать далее', Yii::app()->createUrl('/news/newsCategory/view', ['slug' => $category->slug]));?>
        </button>
    </div>
<?php else: ?>
    <h2>Отзывов пока нет</h2>
<?php endif; ?>