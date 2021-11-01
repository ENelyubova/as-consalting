<div class="gallery-block">
    <?php $this->widget(
        'bootstrap.widgets.TbListView',
        [
            'dataProvider'  => $dataProvider,
            'itemView'      => '_slick-gallery',
            'template'      => "{items}",
               'itemsCssClass' => $this->slickClass,
            'itemsTagName'  => 'div'
        ]
    ); ?>
    
    <div class="arrows">
        <span class="prev-arrow prev-arrow-gallery icon-left"></span>
        <span class="next-arrow next-arrow-gallery icon-right"></span>
    </div>
</div>
