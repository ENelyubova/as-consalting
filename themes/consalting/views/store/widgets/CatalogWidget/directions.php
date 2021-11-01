<?php if($category) : ?>
    <div class="directions-list">
        <?php foreach ($category as $key => $data) : ?>
            <div class="directions-list__item directions-item">
                <div class="directions-boxStyle fl fl-jc-sb">
                    <div class="directions-item__name fl fl-d-c fl-jc-sb">
                        <div class="directions-item__title fl fl-w fl-ai-c">
                            <?= $data->svg; ?>
                            <a href="<?= $data->getCategoryUrl(); ?>"><span><?= $data->name; ?></span></a>
                        </div>
                        <a href="<?= $data->getCategoryUrl(); ?>" class="directions-item__btn btn btn-white btn-svg btn-svg-left fl fl-ai-c"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#38434E" stroke-width="2"/></svg><span>Подробнее</span></a>
                    </div>
                    
                    <?php $children = $data->children(['condition' => 'status=1', 'order' => 'children.sort ASC']); ?>
                    <?php //if($children) : ?>
                        <div class="directions-item__subdirection subdirection">
                            <ul>
                                <?php foreach ($children as $key => $item) : ?>
                                    <li>
                                        <a href="<?= $item->getCategoryUrl(); ?>" class="subdirection__name"><?= $item->name; ?></a>
                                    </li> 
                                <?php endforeach; ?>
                                <?php $this->widget('application.modules.store.widgets.ProductsFromCategoryWidget', [
                                    'view' => 'directions-list-item',
                                    'slug' => $data->slug,
                                    'withChild' => false,
                                ]); ?>
                            </ul>
                        </div>
                    <?php //endif; ?>
                </div>
            </div>   
        <?php endforeach; ?>
    </div>
<?php endif; ?>    
