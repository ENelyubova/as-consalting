<?php if($pages) : ?>
	<div class="company-home">
		<div class="content">
			<div class="company-box box-style fl fl-wr-w fl-ju-co-sp-b">
				<div class="company-box__info box-style__content">
					<?= $pages->body_short; ?>
					<div class="company-box__but">
					  	<a href="#" class="but-link-svg but-link-svg-red but-link-svg-big">
					  		<?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/arrow-right-red.svg'); ?>
					  		<span>О компании</span>
					  	</a>
					</div>
				</div>
				<div class="company-box__img">
					<?php $this->widget('application.modules.gallery.widgets.CompanyGalleryWidget', ['id' => $pages->gallery_id]); ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>