<?php
$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
// Yii::app()->getClientScript()->registerCssFile( $mainAssets . '/css/store-frontend.css' );
// Yii::app()->getClientScript()->registerScriptFile( $mainAssets . '/js/store.js' );
Yii::app()->getClientScript()->registerScriptFile( $mainAssets . '/js/index.js', CClientScript::POS_END);
/* @var $category StoreCategory */

$this->title = $category->getMetaTitle();
$this->description = $category->getMetaDescription();
$this->keywords = $category->getMetaKeywords();
$this->canonical = $category->getMetaCanonical();

$this->breadcrumbs = [ Yii::t( "StoreModule.store", "Услуги" ) => [ '/store/product/index' ] ];

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    $category->getBreadcrumbs( false )
);

?>
<!-- Конкретная категория -->
<?php $child = $category->children(['condition' => 'status=1']); ?>
<?php if($category->isRootCategory()) : ?>
    <?php $this->renderPartial('template-root-category', ['category'=> $category, 'dataProvider'=> $dataProvider]) ?>
<?php else : ?>
    <?php if($child) : ?>
        <?php $this->renderPartial('template-root-category', ['category'=> $category, 'dataProvider'=> $dataProvider]) ?>
    <?php else : ?>
        <div class="store-container subcategory bg-body pb">
            <div class="content-site">
                <div class="breadcrumbs">
                    <div class="row">
                        <div class="col-xs-12">
                            <?php $this->widget(
                                'bootstrap.widgets.TbBreadcrumbs',
                                [
                                  'links' => $this->breadcrumbs,
                                ]
                            );?>
                        </div>
                    </div>
                </div>

                <h1 class="heading heading-page heading-pb"><?= $category->getTitle(); ?></h1>
                <?php if($category->short_description) : ?>
                    <div class="subcategory__top heading-block fl fl-w fl-ai-fs fl-jc-sb">
                        <div class="subcategory__top-text"><?= $category->short_description; ?></div>
                        <?php if($category->price) : ?>
                            <a href="<?= $category->getDocumentUrl(); ?>" class="subcategory__top-btn btn btn-blue btn-svg btn-svg-right btn-hover" target="_blank">
                                <span>Прайс-лист на услуги</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#ffffff" stroke-width="2"></path></svg>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <div class="product-list">
                    <?php $this->widget(
                        'bootstrap.widgets.TbListView',
                        [
                            'dataProvider' => $dataProvider,
                            'id' => 'product-box',
                            'itemView' => '//store/product/_item',
                            'summaryText' => '',
                            'enableHistory' => true,
                            'cssFile' => false,
                            'itemsCssClass' => 'product-type-box',
                            'htmlOptions' => [
                              'class' => 'product-type fl-jc-sb'
                            ],
                            'viewData' => [
                                'isButton' => true
                            ],
                            'emptyText'=>'',
                            'template'=>'
                                {items}
                                {pager}
                            ',
                            'ajaxUpdate'=>true,
                            'enableHistory' => false,
                        ]
                    ); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php $this->widget("application.modules.page.widgets.PagesNewWidget", [
    'view' => 'contacts'
]); ?> 

<!-- Оставить заявку - категория -->
<?php $this->widget('application.modules.mail.widgets.GeneralFeedbackWidget', [
    'id' => 'categoryModal',
    'formClassName' => 'StandartForm',
    'buttonModal' => false,
    'titleModal' => 'Оставьте заявку',
    'subTitleModal' => 'и мы Вам перезвоним!',
    'showCloseButton' => false,
    'isRefresh' => true,
    'showAttributeEmail' => false,
    'showAttributeBody' => false,
    'eventCode' => 'ostavit-zayavku',
    'successKey' => 'ostavit-zayavku',
    'modalHtmlOptions' => [
        'class' => 'modal-my modal-my-xs',
    ],
    'formOptions' => [
        'htmlOptions' => [
            'class' => 'form-my',
        ]
    ],
    'modelAttributes' => [
        'theme' => "Запрос со страницы {$category->name}",
    ],
]) ?>


