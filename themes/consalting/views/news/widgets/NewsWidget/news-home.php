<div class="news-block fl fl-w" data-aos="fade-up" data-aos-once="true">
    <?php $this->widget('application.components.FtListView', [
		// 'id'=> 'news-box',
	    'itemView' => '../../news/_item',
	    'itemsCssClass' => 'news-box fl fl-w',
	    'dataProvider' => $dataProvider,
	    'template' => '{items}',
	    'htmlOptions' => [
	        // "class" => ""
	    ],
	    'pagerCssClass' => 'pagination-box',
	    // 'emptyText' => '',
	    // 'emptyTagName' => 'div',
	    'pager' => [
	        'class' => 'application.components.ShowMorePager',
	        'buttonText' => $this->buttonText,
	        'wrapTag' => 'div',
	        'htmlOptions' => [
	            'class' => 'btn btn-link'
	        ],
	        'wrapOptions' => [
	            'class' => 'news-box-btn'
	        ],
	    ]
	]); ?>
</div>


