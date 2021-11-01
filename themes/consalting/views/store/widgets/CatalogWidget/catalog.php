<?php if($category) : ?>
	<div class="catalog-view-top heading-block fl fl-w fl-jc-sb">
		<div class="catalog-view__desc">Предприятие выпускает продукцию более 50 наименований: боновые заграждения, нефтесборные системы (скиммеры), емкости для временного хранения нефти, установки для утилизации (сжигания) нефтесодержащих отходов, насосное оборудование, силовые установки, сорбирующий материал «Экосорб» и изделия из него, а также много другой продукции природоохранного назначения.</div>
		<div class="catalog-view__docs panel-docs panel-docs-black">
		  <?php if (Yii::app()->hasModule('contentblock')): ?>
		      <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'document']); ?>
		  <?php endif; ?>
		</div>
	</div>
	<div class="catalog-list">
		<?php foreach ($category as $key => $data) : ?>
			<div class="catalog-list__item fl fl-w fl-jc-sb">
				<div class="catalog-list__text">
                	<a href="<?= $data->getCategoryUrl(); ?>" class="catalog-list__name"><?= $data->name; ?></a>
                	<div class="catalog-list__subname"><?= $data->subtitle; ?></div>

            		<?php $children = $data->children(); ?>
            		<?php if($children) : ?>
                		<div class="catalog-list__subcategory subcategory js-subcategory">
                			<?php $count = 0; ?>
							<?php foreach ($children as $key => $item) : ?>
								<div class="subcategory__item js-subcategory-item <?= ($count > 4) ? 'hidden' : ''; ?>" href="<?= $item->getCategoryUrl(); ?>">
									<a href="<?= $item->getCategoryUrl(); ?>" class="subcategory__name"><?= $item->name; ?></a>
								</div> 
								<?php $count++; ?>
				            <?php endforeach; ?>

				            <?php if($count > 5) : ?>
	                            <a class="subcategory__more js-subcategory-more" data-text="Свернуть" href="#">
	                                <span><?= Yii::t("StoreModule.store", "Show more"); ?></span>
	                            </a>
	                        <?php endif; ?>
                		</div>
					<?php endif; ?>
                	<a href="<?= $data->getCategoryUrl(); ?>" class="catalog-list__btn btn btn-link"><?= Yii::t("StoreModule.store", "More details"); ?></a>
				</div>

				<?php $images = $data->photos; ?>
				<?php if($images) : ?>
					<div class="catalog-list__img">
						<div class="carousel-wrapper">
							<div class="catalog-carousel catalog-slider slick-slider">
	                            <?php foreach ($images as $key => $image) : ?>
	                                <div class="catalog-carousel__item">
	                                	<!-- <a data-fancybox="image" href="<?= $image->getImageNewUrl(0, 0, true, null,'image'); ?>"> -->
		                                    <picture class="absolute-img-picture">
		                                        <source media="(min-width: 401px)" srcset="<?= $image->getImageUrlWebp(0, 0, true, null,'image'); ?>" type="image/webp">
		                                        <source media="(min-width: 401px)" srcset="<?= $image->getImageNewUrl(0, 0, true, null,'image'); ?>">
	
		                                        <source media="(min-width: 1px)" srcset="<?= $image->getImageUrlWebp(363, 276, true, null,'image'); ?>" type="image/webp">
		                                        <source media="(min-width: 1px)" srcset="<?= $image->getImageNewUrl(363, 276, true, null,'image'); ?>">
	
		                                        <img src="<?= $image->getImageNewUrl(0, 0, true, null,'image'); ?>" alt="">
		                                    </picture>
		                                <!-- </a> -->
	                                </div>
	                            <?php endforeach; ?>
							</div>
						</div>
					</div>
                <?php endif; ?>
			</div> 
		<?php endforeach; ?>
	</div>
<?php endif; ?>