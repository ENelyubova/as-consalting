<?php if($pages) : ?>
<div class="video-home">
    <div class="content fl fl-wr-w fl-al-it-c fl-ju-co-sp-b">
        <div class="video-home__info">
            <div class="box-style">
                <div class="box-style__header">
                    <div class="box-style__heading">
                        <?= $pages->title; ?>
                    </div>
                    <div class="box-style__desc">
                        <?= $pages->title_short; ?>
                    </div>
                </div>
                <div class="box-style__content">
                    <?= $pages->body; ?>
                    <div class="video-box__but">
                        <a href="#" class="but-link-svg but-link-svg-red but-link-svg-big">
                            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/svg/arrow-right-red.svg'); ?>
                            <span>О компании</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="video-home__media">
            <?php $this->widget('application.modules.video.widgets.VideoWidget', [
                'id' => 1,
                'view' => 'video-one'
            ]); ?>
        </div>
    </div>
</div>
<?php endif; ?>