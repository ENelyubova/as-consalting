<div class="product-list__item product-item directions-item">
	<div class="directions-boxStyle fl fl-jc-sb">
        <div class="product-item__name directions-item__name fl fl-d-c fl-jc-sb">
            <div class="product-item__title directions-item__title fl fl-w fl-ai-c">
                <a href="<?= ProductHelper::getUrl($data); ?>""><span><?= $data->name; ?></span></a>
            </div>
            <div>
            	<a href="#productModal" data-toggle="modal" class="btn btn-blue btn-svg btn-svg-right btn-hover js-modal-show" data-name="<?= $data->name ?>">
                    <span>Оставить заявку</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#ffffff" stroke-width="2"></path>
                    </svg>
                </a>
            	<a href="<?= ProductHelper::getUrl($data); ?>" class="btn btn-white btn-svg btn-svg-left fl fl-ai-c"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#38434E" stroke-width="2"/></svg><span>Подробнее</span></a>
            </div>
        </div>

        <?php if($data->short_description || $data->price != 0 || $data->times) : ?>
            <div class="product-item__body directions-item__subdirection fl fl-w fl-ai-c fl-jc-sb">
                <?php if($data->short_description) : ?>
                    <div class="product-item__body-text">
                        <?= $data->short_description; ?>
                    </div>
                <?php endif; ?>

                <?php if($data->price != 0 || $data->times) : ?>
                    <div class="product-item__body-price price">
                        <?php if($data->price != 0) : ?>
                        	<div class="price-item fl fl-ai-bl">
                        	 	<div class="price__label">Цена</div>
                        	 	<div class="price__value">
                        	 		<?= str_replace('.00', '', number_format($data->getResultPrice(), 2, '.', ' ')); ?> <span class="ruble">₽</span>
                        	 	</div>
                        	</div>
                        <?php endif; ?>
                        <?php if($data->times) : ?>
                        	<div class="price-item fl fl-ai-bl">
                        	 	<div class="price__label">Срок</div>
                        	 	<div class="price__value">
                        	 		<?= $data->times; ?> <span><?= $data->units; ?></span>
                        	 	</div>
                        	</div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>


