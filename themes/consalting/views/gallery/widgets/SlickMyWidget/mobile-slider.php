<div class="slider-block">
    <?php $this->widget(
        'bootstrap.widgets.TbListView',
        [
            'dataProvider'  => $dataProvider,
            'itemView'      => '_slick-mobile',
            'template'      => "{items}",
               'itemsCssClass' => $slickClass,
            'itemsTagName'  => 'div'
        ]
    ); ?>
</div>


