<div class="carouselSlider slick-slider">
	<?php foreach ($models as $key => $data): ?>
	    <div class="slider-block__item">
			<div class="slider-block__img">
				<picture class="absolute-img-picture">
	            	<source media="(min-width: 400px)" srcset="<?= $data->getImageUrlWebp(0, 0, true, null, 'image'); ?>" type="image/webp">
		            <source media="(min-width: 400px)" srcset="<?= $data->getImageNewUrl(0, 0, true, null, 'image'); ?>">
		            <source media="(min-width: 1px)" srcset="<?= $data->getImageUrlWebp(400, 430, true, null, 'image'); ?>" type="image/webp">
		            <source media="(min-width: 1px)" srcset="<?= $data->getImageNewUrl(400, 430, true, null, 'image'); ?>">
	
		            <img src="<?= $data->getImageNewUrl(0, 0, true, null, 'image'); ?>" alt="">
		        </picture>
			</div>
			<div class="slider-shadow"></div>
			<div class="slider-block__content">
				<div class="content-site fl fl-w fl-jc-sb">
					<div class="slider-block__name">
						<span class="slider-block__subtitle"><?= Yii::t("PageModule.page", "Manufacturing company"); ?></span>
						<h1 class="slider-block__title"><?= Yii::t("PageModule.page", "ECOservice NEFTEGAZ"); ?></h1>
						<div class="slider-block__btn fl fl-w fl-ai-c">
							<a href="/store" class="btn btn-green"><?= Yii::t("PageModule.page", "Products"); ?></a>
							<a href="/o-kompanii" class="btn btn-blur"><?= Yii::t("PageModule.page", "About company"); ?></a>
						</div>
					</div>
					<div class="slider-block__info">
						<?= $data->description; ?>
					</div>
				</div>
		    </div>
	    </div>
	<?php endforeach ?>
</div>
<div class="slider-nav">
    <div class="content-site fl fl-jc-e">
    	<div class="slider-nav-wrap fl fl-ai-c">
    		<div class="arrows"></div>
    		<div class="counter"></div>
    	</div>
    </div>
</div>



