<div class="video">
    <div class="content-site">
        <?php foreach ($models as $key => $model): ?>
            <div class="video-box">
                <div class="video-boxStyle"></div>
                    <div class="video-box-shadow fl fl-d-c fl-jc-sb">
                        <div class="video-box__title"><?= $model->name; ?></div>
                        <?php if(!empty($model->video)) : ?>
                            <a class="video-box__link fl fl-ai-c fl-jc-c"  data-fancybox="iframe" href="<?= $model->getVideoUrl() ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><path d="M22 13L2 3V23L22 13Z" stroke="white" stroke-width="3"/></svg>
                            </a>
                        <?php endif; ?>
                        <div class="video-box__info">
                            <?= $model->desc; ?> 
                        
                        </div>
                    </div>
                <div class="video-box__img">
                    <?php if ($model->image): ?>
                        <?= CHtml::image($model->getImageUrl(), '',['class' => 'absolute-img']); ?>
                    <?php else : ?>
                        <?= CHtml::image(Yii::app()->getTheme()->getAssetsUrl() . '/images/video.jpg','',['class' => 'absolute-img']); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
