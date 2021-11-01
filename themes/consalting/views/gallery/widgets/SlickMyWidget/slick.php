<?php $this->widget(
    'bootstrap.widgets.TbListView',
    [
        'dataProvider'  => $dataProvider,
        'itemView'      => '_slick-item',
        'template'      => "{items}",
           'itemsCssClass' => $slickClass,
        'itemsTagName'  => 'div'
    ]
); ?>
