<?php if($products->itemCount) : ?>
    <?php foreach ($products->getData() as $key => $data) : ?>
        <li>
            <a href="<?= ProductHelper::getUrl($data); ?>" class="subdirection__name"><?= $data->name; ?></a>
        </li> 
	<?php endforeach; ?>
<?php endif; ?>