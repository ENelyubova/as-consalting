<?php if($models): ?>
	<div class="heading-block fl fl-w fl-ai-c">
	    <h2 class="heading news-heading"><?= Yii::t("NewsModule.news", "Читайте также"); ?></h2>
	    <div class="news-nav">
	        <div class="arrows"></div>
	    </div>
	</div>
	<div class="news-block news-box fl fl-w">
	    <?php foreach ($models as $key => $model): ?>
	        <?php Yii::app()->controller->renderPartial('//news/news/_item', ['data' => $model]) ?>
	    <?php endforeach; ?>
	</div>
<?php endif; ?>


