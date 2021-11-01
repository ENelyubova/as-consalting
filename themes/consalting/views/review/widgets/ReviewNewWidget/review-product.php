<?php //$this->widget('application.components.FtListView', [
     $this->widget('application.components.MyListView', [
    'id' => 'review-box',
    'itemView' => '../../review/_item',
    'dataProvider' => $dataProvider,
    'itemsCssClass' => 'review-box',
    'template' => '{items}{pager}',
    'template'=>'
        {sorter}
        {items}
        <div class="product-nav">
            {pager}
        </div>
    ',
    'sortableAttributes' => [
        'date_created' => 'По дате',
        'rating' => 'По оценке',
        'countImage' => 'С фотографией',
    ],

    'sorterHeader' => 'Сортировка',
    'htmlOptions' => [
        // "class" => "user-specialist"
    ],
    'pagerCssClass' => 'pagination-box',
    // 'emptyText' => '',
    'emptyTagName' => 'div',
    'emptyCssClass' => 'empty-form',
    'ajaxUpdate'=>true,
    'enableHistory' => false,
    // 'pager' => [
    //     'class' => 'application.components.ShowMorePager',
    //     'buttonText' => 'Читать все отзывы',
    //     'wrapTag' => 'div',
    //     'htmlOptions' => [
    //         'class' => 'but-link'
    //     ],
    //     'wrapOptions' => [
    //         'class' => 'review-pagination'
    //     ],
    // ]
    
    'pagerCssClass' => 'pagination-box',
    'pager' => [
        'header' => '',
        'lastPageLabel' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
        'firstPageLabel' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
        'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        'maxButtonCount' => 5,
        'htmlOptions' => [
            'class' => 'pagination'
        ],
    ]
]); ?>