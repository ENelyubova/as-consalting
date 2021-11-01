<?php if($pages) : ?>
	<?php $childs = $pages->childPages(['condition' => 'status=1', 'order' => 'childPages.order ASC']); ?>

	<div class="service">
		<div class="content-site">
			<h2 class="heading heading-pb">Выберите проблему с устройством</h2>

			<div class="tabs-desctop">
                <div class="filter">
                    <?php foreach ($childs as $key => $data) : ?>
                        <div class="service-tab__item">
                            <a href="#page-adress-<?= $data->id; ?>" data-tab="tab">
                                <div class="tab-item fl">
                                    <?= $data->title; ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
    
                <div class="tab-content filter-tab-content">
                    <?php foreach ($childs as $key => $data) : ?>
                        <div class="service-tab-content service-content" id="page-adress-<?= $data->id; ?>">
                            <div class="service-list service-content__item">
                                <?= $data->body; ?>
                            </div>
                            <div class="service-desc service-content__item">
                                <?= $data->body_short; ?>
                            </div>
                            <?php if($data->image): ?>
                                <div class="service-img service-content__item">
                                    <img src="<?= $data->getImageNewUrl(0, 0, true, null,'image'); ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Для мобильных -->
            <div class="panel panel-default">
                <?php foreach ($childs as $key => $data) : ?>
                    <div class="panel-heading">
                        <div class="service-tab__item">
                            <a data-toggle="collapse" data-parent="#accordion" href="#page<?= $key; ?>" >
                                <div class="tab-item fl">
                                    <?= $data->title; ?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="panel-content service-content">
                        <div id="page<?= $key; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="service-list service-content__item">
                                <?= $data->body; ?>
                                </div>
                                <div class="service-desc service-content__item">
                                    <?= $data->body_short; ?>
                                </div>
                                <?php if($data->image): ?>
                                    <div class="service-img service-content__item">
                                        <img src="<?= $data->getImageNewUrl(0, 0, true, null,'image'); ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
		</div>
	</div>

	<?php Yii::app()->getClientScript()->registerScript("filter-content", "
	    $('.filter .service-tab__item').first().find('a').addClass('active');$('.filter .service-tab__item').addClass('active');
	    $('.filter-tab-content .service-tab-content').first().addClass('active');

	    $(document).delegate('.filter a[data-tab=tab]', 'click', function (e) {
	        e.preventDefault();
	        if(!$(this).hasClass('active')){
	            $('.filter .service-tab__item a').removeClass('active');
	            $('.filter .service-tab__item').removeClass('active');
	            $('.filter-tab-content .service-tab-content').removeClass('active');
	            $(this).addClass('active');
	            var id = $(this).attr('href');
	            // $(this).parent().addClass('active');
	            $(id).addClass('active');
	        }
	        return false;
	    });
	"); ?>
<?php endif; ?>


