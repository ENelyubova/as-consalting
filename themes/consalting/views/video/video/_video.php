<div class="video-box__item">
    <div class="video-box-play">
        <a data-fancybox="iframe" href="<?= $data->code; ?>">
            <div class="video-box-play__icon anim-play-mini">
                <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/youtube-logo.svg'); ?>
            </div>
        </a>
    </div>
    <div class="video-box__img">
        <?php if ($data->image): ?>
            <?= CHtml::image($data->getImageUrl(), ''); ?>
        <?php else : ?>
            <?= CHtml::image(Yii::app()->getTheme()->getAssetsUrl() . '/images/news-nophoto.jpg',''); ?>
        <?php endif; ?>
    </div>
    <div class="video-box__name">
        <?= $data->name; ?>
    </div>
</div>