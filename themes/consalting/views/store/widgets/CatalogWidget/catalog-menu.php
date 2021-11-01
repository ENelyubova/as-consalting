<?php if($category) : ?>
    <div class="header-catalog__container-wrap fl">
        <div class="header-catalog__categories">
            <?php foreach ($category as $key => $data) : ?>
                <a href="<?= $data->getCategoryUrl(); ?>" class="catalog-menu__item fl fl-ai-c">
                    <div class="categories__name">
                        <?= $data->name; ?>
                    </div>
                    <?php $child = $data->children(); ?>
                    <?php if($child) : ?>
                        <div class="header-catalog__subcategories">
                            <?php foreach ($child as $key => $item) : ?>
                                <a href="<?= $item->getCategoryUrl(); ?>" class="catalog-menu__item fl fl-ai-c">
                                    <div class="categories__name">
                                        <?= $item->name; ?>
                                    </div>
                                </a>  
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>  
                </a>  
                
            <?php endforeach; ?>
        </div>

    </div>
<?php endif; ?>    