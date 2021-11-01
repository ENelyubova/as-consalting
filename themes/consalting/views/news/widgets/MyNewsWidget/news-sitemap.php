<?php if($models): ?>
	<ul>
		<li>
			<a href="/news">Новости</a>
		</li>
	</ul>
	<ul>
	    <?php foreach ($models as $key => $model): ?>
	        <?php Yii::app()->controller->renderPartial('//news/news/_item-sitemap', ['data' => $model]) ?>
	    <?php endforeach; ?>
	</ul>
<?php endif; ?>


