<div>
    <div class="carousel-img">
        <?php echo CHtml::image(
            $data->image->getImageUrl(),
            $data->image->alt,
            array('title' => $data->image->alt, 'href' => $data->image->getImageUrl(), 'class' => 'gallery-image')
        ); ?>
    </div>
</div>

