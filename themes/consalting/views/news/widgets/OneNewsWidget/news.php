<div class="news-block-item">
	<?php if (count($model)>0): ?>
	<h3><?= $model->title; ?></h3>
	<?= CHtml::image($model->getImageUrl()); ?>
	<?php endif; ?>
</div>