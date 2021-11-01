<?php Yii::import('application.modules.news.NewsModule'); ?>
<div class="row">
	<?php if (isset($models) && $models != []): ?>
	<h4 class="title-block-news"><?= $category->name; ?></h4>
	
	<?php foreach ($models as $model): ?>
		<div class="col-sm-3 col-xs-12">
			<div class="item-block">
			
				<?php if($model->image): ?>
				<div class="image-block">
					<?= CHtml::link(CHtml::image($model->getImageUrl(350, 250)), ['/news/news/view/', 'slug' => $model->slug]
                        ); ?>
				</div>
				<?php endif; ?>
				
				<div class="title-block">
					<?= CHtml::link($model->title, ['/news/news/view/', 'slug' => $model->slug]); ?>
				</div>
				<div class="desc-block">
					<?= $model->short_text; ?>
				</div>
				<?= CHtml::link('Подробнее', ['/news/news/view/', 'slug' => $model->slug], ['class' => 'link-more']); ?>
			</div>
		</div>
	<?php endforeach; ?>
	
	<?php endif; ?>
</div>