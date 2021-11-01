<div class="news-block fl fl-w">
    <?php foreach ($models as $key => $model): ?>
        <?php Yii::app()->controller->renderPartial('//news/news/_item', ['data' => $model]) ?>
    <?php endforeach; ?>
</div>


