<div>
	<div class="main-slider">
		<div class="slider-info">
			<div class="slider-info__text">
				<label class="header-before">Добро пожаловать!</label>
				<h1><?=$data->image->name ?></h1>
	        	<p><?=$data->image->alt ?></p>
	        	<div class="btn-main">
	        		<button class="btn btn-request" data-toggle="modal" data-target="#callbackModal">+</button>
	        		<span>Оставить заявку</span>
	        	</div>
			</div>
	    
	    </div>
	    
	<?= CHtml::image($data->image->getImageUrl(1920,850), $data->image->alt, ['href' => $data->image->getImageUrl(), 'class' => 'gallery-image']); ?>
	</div>
</div>
