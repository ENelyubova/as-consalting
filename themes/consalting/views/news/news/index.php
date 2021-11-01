<?php
$this->title = Yii::t('NewsModule.news', 'News');
$this->breadcrumbs = [Yii::t('NewsModule.news', 'News')];
?>

<div class="page-news">
	<div class="content-site">
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', [
	            'links' => $this->breadcrumbs,
	    ]); ?>
		<h1 class="heading heading-page heading-pb">Новости</h1>
	</div>

	<?php if(!isset($_GET['customAuthor'])): ?>
		<div class="news-control">
			<div class="content-site">
				<form id="filter-news" method="get" class="news-control__main">
	                <input type="hidden"
	                       name="customYear"
	                       value="">
	                <input type="hidden"
	                       name="customMounthly"
	                       value="">
	                <input type="hidden"
	                       name="customCategory"
	                       value="">
				
					<div class="news-control-wrap fl fl-w fl-ai-c">
						<div class="news-control__col">
			                <div class="dropdown js-dropdown">
			                    <div class="dropdown__head">
			                        <span class="dropdown__val">Год публикации</span>
			                        <span class="dropdown__icon">
			                            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() .'/images/icon/down.svg'); ?>
			                        </span>
			                    </div>
			                    <div class="dropdown__body">
			                        <div class="dropdown__lists">
			                            <span class="dropdown__list js-cheked">
			                                <span data-value="" data-input="customYear">За все время</span>
			                            </span>

			                            <?php foreach (News::getYearLists() as $year): ?>
			                                <span class="dropdown__list js-cheked">
			                                    <span data-value="<?php echo $year; ?>" data-input="customYear">
			                                        <?php echo $year; ?>
			                                    </span>
			                                </span>
			                            <?php endforeach; ?>
			                        </div>
			                    </div>
			                </div>
			            </div>
			            <div class="news-control__col">
			                <div class="dropdown js-dropdown">
			                    <div class="dropdown__head">
			                        <span class="dropdown__val">Месяц публикации</span>
			                        <span class="dropdown__icon">
			                            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() .'/images/icon/down.svg'); ?>
			                        </span>
			                    </div>
			                    <div class="dropdown__body">
			                        <div class="dropdown__lists">
			                             <span class="dropdown__list js-cheked">
			                                <span data-value="" data-input="customMounthly">За все время</span>
			                             </span>
			                            <?php foreach (News::getMounthlyLists() as $key => $mount): ?>
			                                <span class="dropdown__list js-cheked">
			                                    <span data-value="<?php echo $key; ?>" data-input="customMounthly"><?php echo $mount; ?></span>
			                                </span>
			                            <?php endforeach; ?>
			                        </div>
			                    </div>
			                </div>
			            </div>
			            <div class="news-control__col">
			                <div class="dropdown js-dropdown">
			                    <div class="dropdown__head">
			                        <span class="dropdown__val">Все теги</span>
			                        <span class="dropdown__icon">
			                            <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() .'/images/icon/down.svg'); ?>
			                        </span>
			                    </div>
			                    <div class="dropdown__body">
			                        <div class="dropdown__lists">
			                             <span class="dropdown__list js-cheked">
			                                <span data-value="" data-input="customCategory">Все категории</span>
			                             </span>
			                            <?php foreach (News::getCategoryList() as $key => $category): ?>
			                                <span class="dropdown__list js-cheked">
			                                    <span  data-value="<?= $key; ?>" data-input="customCategory"><?= $category; ?></span>
			                                </span>
			                            <?php endforeach; ?>
			                        </div>
			                    </div>
			                </div>
			            </div>
					</div>
		          	<input type="submit" value="Submit" class="hidden">
	            </form>
			</div>
		</div>
	<?php endif; ?>

	<div class="news-panel bg-body pb">
		<div class="content-site">
			<?php $this->widget('bootstrap.widgets.TbListView', [
				'id'=> 'news-box',
			    'dataProvider' => $dataProvider,
		        'itemView' => '_item',
		        'summaryText' => '',
		        'template'=>'{items} {pager}',
		        'itemsCssClass' => 'news-block',
			    'htmlOptions' => [
			        // "class" => ""
			    ],
			    'pagerCssClass' => 'pagination-box',
			    'pager' => [
			    	'header' => '',
			    	'nextPageLabel'=> false,
                    'prevPageLabel'=> false,
                    'lastPageLabel'=> false,
                    'firstPageLabel'=> false,
					'selectedPageCssClass' => 'active',
                    'hiddenPageCssClass' => 'disabled',
				    'htmlOptions' => [
				    	'class' => 'pagination pagination-panel'
				    ]
			    ]
			]); ?>
		</div>
	</div>
</div>

<?php Yii::app()->clientScript->registerScript('news-script', "
	$(document).delegate('.js-cheked', 'click', function() {
		var value = $(this).find('span').data('value');
		var input = $(this).find('span').data('input');
		console.log(input);
		$('input[name='+input+']').val(value);
		updateNews();
		return false;
	})
	function updateNews() {
		var form = $('#filter-news'),
        data = form.serialize();

	    $('.ajax-loading').fadeIn(500);

	    $.fn.yiiListView.update('news-box', {
	        'data': data,
	        'url': '',
	        complete: function () {
	             $('.ajax-loading').delay(100).fadeOut(500);
	        }
	    });
	}
") ?>

