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
    
    <div class=" arrows">
        <span class="prev-arrow prev-slider-arrow icon-next-9"></span><span class="next-arrow next-slider-arrow icon-next-9"></span>
    </div>
</div>
