<div class="review-box__item">
	<div class="review-box__header fl fl-wr-w fl-al-it-c">
	   <div class="review-box__name">
			<span><?= CHtml::encode( $data->username); ?></span>
		</div>
        <div class="review-box__date">
    		<?= date("d.m.Y", strtotime($data->date_created)); ?>
    	</div>
    </div>
	<div class="review-box__raiting review-raiting">
		<div class="raiting-list">
            <?php for ($i=1; $i <= 5; $i++) : ?>
                <div class="raiting-list__item <?= ($i <= $data->rating) ? 'active' : ''; ?>"></div>
            <?php endfor; ?>
                <?php
                    /*$this->widget('CStarRating', [
                        'name' => "review-input-rating[{$data->id}]",
                        'minRating' => 1,
                        'maxRating' => 5,
                        'value' => $data->rating, // mark 1...5
                        'starWidth'=> 16,
                        'readOnly'=> true,
                        'ratingStepSize' => 1
                    ]);*/
                    ?>
        </div>
	</div>
    <div class="review-box__description">
        <?= $data->text; ?>
    </div>
    <div class="review-box-image fl fl-wr-w">
        <?php foreach ($data->images(['order' => 'position DESC']) as $image): ?>
            <div class="review-box-image__item box-style-img">
                <img src="<?= $image->getImageUrl(156, 119, false); ?>" alt="" data-fancybox="image" href="<?= $image->getImageUrl(); ?>"/>
            </div>
        <?php endforeach; ?>
    </div>
</div>
