<?php if ($models): ?>
    <div class="works-carousel">
        <?php foreach ($models as $gallery): ?>
            <div class="works-carousel__item">
                <?php $images = $gallery->images(['limit' => 4, 'order' => 'position DESC']) ?>
                <div class="left-panel">
                    <div id="myCarousel-main-<?= $gallery->id; ?>" class="myCarousel-main">
                        <?php foreach ($images as $key=>$image): ?>
                            <?php if($key == 0) : ?>
                                <img src="<?= $image->getImageUrl(430,428, true); ?>" class="image-preview" data-fancybox href="<?= $image->getImageUrl(); ?>">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="right-panel">
                    <h4><?= $gallery->name; ?></h4>
                    <label><?= $gallery->description; ?> </label>                   
                    <div id="myCarousel-nav-<?= $gallery->id; ?>" class="myCarousel-nav">
                        <?php foreach ($images as $image): ?>
                            <div>
                                <?= CHtml::image(
                                    $image->getImageUrl(100, 100),
                                    $image->alt,
                                    [
                                        'width' => 100,
                                        'height' => 100,
                                        'data-src' => $image->getImageUrl(430,428, true),
                                        'href' => $image->getImageUrl(),
                                        // 'data-fancybox' => 'image',
                                        'class' => 'image-thumb'
                                    ]
                                ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php Yii::app()->getClientScript()->registerScript(
    "works-home-all", "
    $(document).delegate('.image-thumb', 'click', function(){
        var parent = $(this).parents('.works-carousel__item');
        var src = $(this).data('src');
        var href = $(this).attr('href');
        parent.find('img.image-preview').attr('src', src);
        parent.find('img.image-preview').attr('href', href);
        return false;
    });
"); ?>

<?php //foreach ($models as $gallery): ?>
    <?php /*Yii::app()->getClientScript()->registerScript(
        "works-home{$gallery->id}", "
        $('#myCarousel-nav-{$gallery->id}').slick({
            fade: false,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows:false,
            dots:false,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                       slidesToShow: 2,
                        slidesToScroll: 1,
                        adaptiveHeight: true,
                    }
                },
            ]
        });
    ");*/ ?>
<?php //endforeach; ?>
<?php endif; ?>


