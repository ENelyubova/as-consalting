<?php Yii::import('application.modules.news.NewsModule'); ?>
<div class="row">
	<?php if (isset($models) && $models != []): ?>
		<?php foreach ($models as $model): ?>
			<div class="col-sm-3 col-xs-12">
				<div class="item-block">
					<div class="image-block">
						<?= $model->short_text; ?>
					</div>
					<div class="title-block">
						<?= $model->title; ?>
					</div>
<!--					<div class="desc-block">
						<?= $model->full_text; ?>
					</div>-->
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>