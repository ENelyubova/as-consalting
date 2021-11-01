<div>
    <div>
		<?= CHtml::image($data->image->getImageUrl(), $data->image->alt,
						   ['title' => $data->image->alt, 'href' => $data->image->getImageUrl(), 'class' => 'gallery-image']); ?>
    </div>
</div>
