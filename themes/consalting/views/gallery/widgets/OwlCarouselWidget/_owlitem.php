<div>
    <div class="block-image-slide">
		<?= CHtml::image($data->image->getImageUrl(), $data->image->alt,
						   ['title' => $data->image->alt, 'href' => $data->image->getImageUrl(), 'class' => 'gallery-image']); ?>
						   
		<div class="caption-slide">
			<span><?= $data->image->name; ?></span>
			<label><?= $data->image->description; ?></label>
		</div>
    </div>
</div>

