<div class="news pt">
    <div class="content-site">
        <div class="heading-block fl fl-w fl-ai-c fl-jc-sb">
            <div>
                <h2 class="heading heading-pr"><?= Yii::t("NewsModule.news", "Пресс-центр"); ?></h2>
                <a href="/news" class="btn btn-link btn-link-blue">Все новости</a>
            </div>
            <div class="news-nav">
                <div class="arrows"></div>
            </div>
        </div>
        <div class="news-panel">
            <div class="news-block news-box fl fl-w">
                <?php foreach ($models as $key => $model): ?>
                    <?php Yii::app()->controller->renderPartial('//news/news/_item', ['data' => $model]) ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>