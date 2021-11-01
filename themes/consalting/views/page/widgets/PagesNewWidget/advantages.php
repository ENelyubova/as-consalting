<?php if($pages) : ?>
	<?php $childs = $pages->childPages(['condition' => 'status=1', 'order' => 'childPages.order ASC']); ?>

    <?php if($pages->getAttributeValue('advantages')['name']) : ?>
        <div class="advantages-slider">
            <div class="advantages-list slick-slider">
                <?= $pages->getAttributeValue('advantages')['value']; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>


