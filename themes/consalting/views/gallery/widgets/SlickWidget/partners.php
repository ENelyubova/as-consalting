<div class="gallery-block">
    <?php $this->widget(
        'bootstrap.widgets.TbListView',
        [
            'dataProvider'  => $dataProvider,
            'itemView'      => '_slick-partners',
            'template'      => "{items}",
               'itemsCssClass' => $this->slickClass,
            'itemsTagName'  => 'div'
        ]
    ); ?>
    
    <div class="arrows">
        <span class="prev-arrow prev-arrow-partners icon-left"></span>
        <span class="next-arrow next-arrow-partners icon-right"></span>
    </div>
</div>
