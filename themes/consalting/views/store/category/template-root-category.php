<div class="store-container category">
    <div class="content-site">
        <div class="breadcrumbs">
            <div class="row">
                <div class="col-xs-12">
                    <?php $this->widget(
                        'bootstrap.widgets.TbBreadcrumbs',
                        [
                          'links' => $this->breadcrumbs,
                        ]
                    );?>
                </div>
            </div>
        </div>

        <h1 class="heading heading-page heading-pb"><?= $category->getTitle(); ?></h1>

        <?php if($category->short_description) : ?>
            <div class="category__top">
                <div class="category__top-text fl fl-w">
                    <?= $category->short_description; ?>
                </div>
                <a href="#categoryModal" data-toggle="modal" class="btn btn-blue btn-svg btn-svg-right btn-hover">
                    <span>Оставить заявку</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#ffffff" stroke-width="2"/></svg>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php if($category->image) : ?>
        <div class="category__image fl pt">
            <img src="<?= $category->getImageNewUrl(0, 0, true, null,'image'); ?>" alt="Экспертиза">
        </div>
    <?php endif; ?>

    <?php $child = $category->children(); ?>
    <?php //if(!empty($child)) : ?>
        <div class="category__type category-type pt">
            <div class="content-site">
                <h2 class="heading heading-pb">Виды экспертиз</h2>
                <div class="category-type__list fl fl-w">
                    <?php $this->widget('application.modules.store.widgets.CatalogWidget', [
                        'view' => 'category',
                        'category_id' => $category->id,
                    ]); ?>
                    <?php $this->widget('application.modules.store.widgets.ProductsFromCategoryWidget', [
                        'view' => 'product-list-item',
                        'slug' => $category->slug,
                        'withChild' => false,
                    ]); ?>
                    
                </div>
            </div>
        </div>
    <?php //endif; ?>

    <div class="content-site">
        <?php if($category->getAttributeValue('box1')['name']) : ?>
            <div class="category__info category-info pt pb fl fl-w fl-jc-sb">
                <div class="category-info__title category-info__item">
                    <h2 class="category-info__heading heading heading-pb"><?= $category->getAttributeValue('box1')['name']; ?></h2>
                    <a href="#categoryModal" data-toggle="modal" class="btn btn-blue btn-svg btn-svg-right btn-hover">
                        <span>Оставить заявку</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#ffffff" stroke-width="2"/></svg>
                    </a>
                </div>
                <div class="category-info__body category-info__item">
                    <?= $category->getAttributeValue('box1')['value']; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if($category->getAttributeValue('advantages')['name']) : ?>
        <div class="advantages pt pb bg-blue-gradient">
            <div class="content-site">
                <div class="heading-block fl fl-w fl-ai-c fl-jc-sb">
                    <h2 class="heading heading-white"><?= $category->getAttributeValue('advantages')['name']; ?></h2>
                    <div class="advantages-nav">
                        <div class="arrows"></div>
                    </div>
                </div>
                <div class="advantages-slider">
                    <div class="advantages-list slick-slider">
                        <?= $category->getAttributeValue('advantages')['value']; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>