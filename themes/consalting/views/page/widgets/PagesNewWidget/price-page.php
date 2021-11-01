<?php if($pages) : ?>
	<?php $childs = $pages->childPages(['condition' => 'status=1', 'order' => 'childPages.order ASC']); ?>

	<div class="tabs-desctop">
        <div class="filter fl fl-w fl-ai-c">
            <?php foreach ($childs as $key => $data) : ?>
                <div class="filter__tab">
                    <a href="#page-adress-<?= $data->id; ?>" data-tab="tab" class="filter__tab-link">
                        <div class="tab-item fl">
                            <?= $data->title; ?>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="tab-content filter-tab-content">
            <?php foreach ($childs as $key => $data) : ?>
                <div class="price-tab-content price-content" id="page-adress-<?= $data->id; ?>">
                    <?php $children = $data->childPages(['condition' => 'status=1', 'order' => 'childPages.order ASC']); ?>
                    
                    <?php foreach ($children as $key => $item) : ?>
                    <?php $children2 = $item->childPages(['condition' => 'status=1', 'order' => 'childPages.order ASC']); ?>
                        <div class="price-content__wrapper fl fl-w fl-jc-sb">
                            <div class="price-content__parent">
                                <?= $item->title; ?>
                            </div>
                            <div class="price-content__children price-children">
                                <div class="price-children__item panel panel-default fl fl-w fl-ai-c fl-jc-sb">
                                    <?php foreach ($children2 as $key => $elem) : ?>
                                        <div class="panel-heading">
                                            <div class="panel-heading__item">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#page<?= $elem->id; ?>" class="fl fl-w fl-ai-c fl-jc-sb">
                                                    <span class="panel-heading__name"><?= $elem->title; ?></span>
                                                    <?php if($elem->price): ?>
                                                        <span class="panel-heading__price">
                                                            от <?= $elem->price; ?> ₽
                                                        </span>
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="panel-content">
                                            <div id="page<?= $elem->id; ?>" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                     <?php if($elem->body): ?>
                                                        <div class="panel-body__content">
                                                            <?= $elem->body; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <a href="#priceModal" data-toggle="modal" class="btn btn-blue btn-svg btn-svg-right btn-hover">
                                                        <span>Оставить заявку</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#ffffff" stroke-width="2"></path></svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

	<?php Yii::app()->getClientScript()->registerScript("filter-content", "
	    $('.filter .filter__tab').first().find('a').addClass('active');$('.filter .filter__tab').addClass('active');
	    $('.filter-tab-content .price-tab-content').first().addClass('active');

	    $(document).delegate('.filter a[data-tab=tab]', 'click', function (e) {
	        e.preventDefault();
	        if(!$(this).hasClass('active')){
	            $('.filter .filter__tab a').removeClass('active');
	            $('.filter .filter__tab').removeClass('active');
	            $('.filter-tab-content .price-tab-content').removeClass('active');
	            $(this).addClass('active');
	            var id = $(this).attr('href');
	            // $(this).parent().addClass('active');
	            $(id).addClass('active');
	        }
	        return false;
	    });
	"); ?>
<?php endif; ?>

<!-- Узнать стоимость -->
<?php $this->widget('application.modules.mail.widgets.GeneralFeedbackWidget', [
    'id' => 'priceModal',
    'formClassName' => 'StandartForm',
    'buttonModal' => false,
    'titleModal' => 'Оставьте заявку',
    'subTitleModal' => 'и мы Вам перезвоним!',
    'showCloseButton' => false,
    'isRefresh' => true,
    'showAttributeEmail' => false,
    'showAttributeBody' => true,
    'eventCode' => 'zayavka-na-prays',
    'successKey' => 'zayavka-na-prays',
    'modalHtmlOptions' => [
        'class' => 'modal-my modal-my-xs',
    ],
    'formOptions' => [
        'htmlOptions' => [
            'class' => 'form-my',
        ]
    ],
    'modelAttributes' => [
        'theme' => "Запрос прайса на услугу: {$elem->title}",
    ],
]) ?>


