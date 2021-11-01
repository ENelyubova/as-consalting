<div class="aboutSlider slick-slider">
	<?php foreach ($models as $key => $data): ?>
	    <div class="slick-slide">
			<picture class="absolute-img-picture">
            	<source media="(min-width: 641px)" srcset="<?= $data->getImageUrlWebp(0, 0, true, null, 'image'); ?>" type="image/webp">
	            <source media="(min-width: 641px)" srcset="<?= $data->getImageNewUrl(0, 0, true, null, 'image'); ?>">
	            <source media="(min-width: 1px)" srcset="<?= $data->getImageUrlWebp(400, 370, false, null, 'image'); ?>" type="image/webp">
	            <source media="(min-width: 1px)" srcset="<?= $data->getImageNewUrl(400, 370, false, null, 'image'); ?>">

	            <img src="<?= $data->getImageNewUrl(0, 0, true, null, 'image'); ?>" alt="">
	        </picture>
	    </div>
	<?php endforeach ?>
</div>
<div class="img-style"></div>

<div class="about-thumb1">
    <div class="about-thumb-carousel1">
        <?php foreach ($models as $key => $data): ?>
            <div class="about-thumb-block__item">
                <picture class="absolute-img-picture">
	            	<source media="(min-width: 641px)" srcset="<?= $data->getImageUrlWebp(0, 0, true, null, 'image_xs'); ?>" type="image/webp">
		            <source media="(min-width: 641px)" srcset="<?= $data->getImageNewUrl(0, 0, true, null, 'image_xs'); ?>">
		            <source media="(min-width: 1px)" srcset="<?= $data->getImageUrlWebp(400, 370, false, null, 'image_xs'); ?>" type="image/webp">
		            <source media="(min-width: 1px)" srcset="<?= $data->getImageNewUrl(400, 370, false, null, 'image_xs'); ?>">
	
		            <img src="<?= $data->getImageNewUrl(0, 0, true, null, 'image_xs'); ?>" alt="">
		        </picture>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="about-thumb2">
    <div class="about-thumb-carousel2">
        <?php foreach ($models as $key => $data): ?>
            <div class="about-thumb-block__item">
                <picture class="absolute-img-picture">
	            	<source media="(min-width: 641px)" srcset="<?= $data->getImageUrlWebp(0, 0, true, null, 'image_big'); ?>" type="image/webp">
		            <source media="(min-width: 641px)" srcset="<?= $data->getImageNewUrl(0, 0, true, null, 'image_big'); ?>">
		            <source media="(min-width: 1px)" srcset="<?= $data->getImageUrlWebp(400, 370, false, null, 'image_big'); ?>" type="image/webp">
		            <source media="(min-width: 1px)" srcset="<?= $data->getImageNewUrl(400, 370, false, null, 'image_big'); ?>">
	
		            <img src="<?= $data->getImageNewUrl(0, 0, true, null, 'image_big'); ?>" alt="">
		        </picture>
            </div>
        <?php endforeach; ?>
    </div>
</div>

