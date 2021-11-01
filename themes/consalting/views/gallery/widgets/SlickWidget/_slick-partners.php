<div>
	<div class="item-img">
		<?= CHtml::image($data->image->getImageUrl(160,110,true), $data->image->alt, ['href' => $data->image->getImageUrl(), 'data-fancybox' => "image", 'class' => 'gallery-image']); ?>
	</div>
</div>
