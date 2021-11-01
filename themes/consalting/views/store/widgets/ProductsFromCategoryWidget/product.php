<?php if($products->itemCount): ?>
    <?php foreach ($products->getData() as $i => $product): ?>
        <?php $this->render('../../product/_subcategory', ['data' => $product]) ?>
    <?php endforeach; ?>
<?php endif; ?>