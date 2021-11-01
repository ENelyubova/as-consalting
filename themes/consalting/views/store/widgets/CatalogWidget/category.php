<?php if($category) : ?>
	<?php foreach ($category as $key => $data) : ?>
        <div class="category-type__item fl fl-ai-c fl-jc-sb">
    	    <a href="<?= $data->getCategoryUrl(); ?>" class="category-type__name"><?= $data->name; ?></a>
    	    <a href="<?= $data->getCategoryUrl(); ?>" class="category-type__btn btn btn-link btn-link-blue">Подробнее</a>
        </div>
	<?php endforeach; ?>
<?php endif; ?>