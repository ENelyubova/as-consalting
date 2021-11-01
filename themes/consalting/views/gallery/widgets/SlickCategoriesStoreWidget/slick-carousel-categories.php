<?php $this->widget(
    'bootstrap.widgets.TbListView',
    [
        'dataProvider'  => $dataProvider,
        'itemView'      => '_category-item',
        'template'      => "{items}",
       	'itemsCssClass' => $this->slickClass,
        'itemsTagName'  => 'div'
    ]
);
?>
<div class="arrows">
    <span class="prev-arrow prev-store-arrow icon-double-angle-pointing-to-right"></span>
    <span class="next-arrow next-store-arrow icon-double-angle-pointing-to-right"></span>
</div>