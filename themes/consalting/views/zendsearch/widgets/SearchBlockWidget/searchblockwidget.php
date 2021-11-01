<?php Yii::import('application.modules.zendsearch.ZendSearchModule'); ?>
<?= CHtml::beginForm(['/zendsearch/search/search'], 'get', ['class' => 'form-inline']); ?>
	<div class="search-group">
		<?= CHtml::textField(
		    'q',
		    '',
		    ['placeholder' => Yii::t('ZendSearchModule.zendsearch', 'Search'), 'class' => 'form-control']
		); ?>
	    <span class="icon-search"></span>
	</div>
<?= CHtml::endForm(); ?>





