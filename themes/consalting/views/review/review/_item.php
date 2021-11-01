<div class="review-box__item">
    <!-- <div class="review-box__header fl fl-wr-w fl-al-it-c">
       <div class="review-box__name">
            <span><?= CHtml::encode( $data->username); ?></span>
        </div>
        <div class="review-box__date">
            <?= date("d.m.Y", strtotime($data->date_created)); ?>
        </div>
    </div>
    <div class="review-box__description">
        <?= $data->text; ?>
    </div> -->
    <img src="<?= $data->getImageUrl(); ?>"  href="<?= $data->getImageUrl(); ?>">
</div>
