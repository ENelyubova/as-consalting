<div class="slider-block">
    <?php $this->widget(
        'bootstrap.widgets.TbListView',
        [
            'dataProvider'  => $dataProvider,
            'itemView'      => '_slick-item',
            'template'      => "{items}",
            'itemsCssClass' => $this->slickClass,
            'itemsTagName'  => 'div'
        ]
    ); ?>
    
    <div class="arrows">
        <span class="prev-arrow prev-arrow-slide slide icon-left"></span>
        <span class="next-arrow next-arrow-slide slide icon-right"></span>
    </div>
</div>
