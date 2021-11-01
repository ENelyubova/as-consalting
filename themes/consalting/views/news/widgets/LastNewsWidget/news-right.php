<?php Yii::import('application.modules.news.NewsModule'); ?>

<div class="row">
	<?php if (isset($models) && $models != []): ?>
	<?php foreach ($models as $model): ?>
		<div class="col-sm-3 col-xs-12">
			<div class="item-block">
				<?php if($model->image): ?>
				<div class="image-block">
					<?= CHtml::link(CHtml::image($model->getImageUrl(270, 210)), ['/news/news/view/', 'slug' => $model->slug]
                        ); ?>
				</div>
				<?php endif; ?>
				<div class="title-block">
					<?= CHtml::link($model->title, ['/news/news/view/', 'slug' => $model->slug]); ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
	
	<?php endif; ?>
</div>