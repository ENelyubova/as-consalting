<?php Yii::import('application.modules.news.NewsModule'); ?>

<div class="row">
	<?php if (isset($models) && $models != []): ?>
    <div class="carousel-news-left">
        <?php foreach ($models as $model): ?>
            <div class="col-xs-12">
                <div class="item-block">
                    <?php if($model->image): ?>
                    <div class="image-block">
                        <?= CHtml::link(CHtml::image($model->getImageUrl(570, 210)), ['/news/news/view/', 'slug' => $model->slug]
                            ); ?>
                    </div>
                    <?php endif; ?>
                    <div class="title-block">
                        <?= CHtml::link($model->title, ['/news/news/view/', 'slug' => $model->slug]); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
	<?php endif; ?>
</div>