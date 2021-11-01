<?php $photos = $product->getAttributeValue('image')['gallery']; ?>
<?php if($photos) : ?>
	<?php foreach ($photos as $key => $photo): ?>
		<div class="wrap-item fl fl-w fl-jc-sb">
			<div class="wrap-item__text">
				<span></span>
				<p></p>
			</div>
        	<div class="wrap-item__img">
        		<picture class="absolute-img-pictur">
        			<source media="(min-width: 401px)" srcset="<?= $product->geFieldGalImageWebp(0, 0, false,  $photo['image']); ?>" type="image/webp">
		            <source media="(min-width: 401px)" srcset="<?= $product->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>">

		            <source media="(min-width: 1px)" srcset="<?= $product->geFieldGalImageWebp(270, 530, true,  $photo['image']); ?>" type="image/webp">
		            <source media="(min-width: 1px)" srcset="<?= $product->getFieldGalImageUrl(270, 530, true,  $photo['image']); ?>">

		            <img src="<?= $product->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>" alt="<?= $data->title; ?>">
		        </picture>
        	</div>
    	</div>
    <?php endforeach ?>
<?php endif; ?>