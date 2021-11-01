<?php if($products->itemCount) : ?>
    <?php foreach ($products->getData() as $key => $data) : ?>
        <div class="category-type__item fl fl-ai-c fl-jc-sb">
            <a href="<?= ProductHelper::getUrl($data); ?>" class="category-type__name"><?= $data->name; ?></a>
            <a href="<?= ProductHelper::getUrl($data); ?>" class="category-type__btn btn btn-link btn-link-blue">Подробнее</a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>