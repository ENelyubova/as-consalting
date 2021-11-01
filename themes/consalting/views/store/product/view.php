<?php

/* @var $product Product */

$this->title = $product->getMetaTitle();
$this->description = $product->getMetaDescription();
$this->keywords = $product->getMetaKeywords();
$this->canonical = $product->getMetaCanonical();

$mainAssets = Yii::app()->getModule( 'store' )->getAssetsUrl();
Yii::app()->getClientScript()->registerScriptFile( $mainAssets . '/js/jquery.simpleGal.js' );

Yii::app()->getClientScript()->registerCssFile( Yii::app()->getTheme()->getAssetsUrl() . '/css/store-frontend.css' );
Yii::app()->getClientScript()->registerScriptFile( Yii::app()->getTheme()->getAssetsUrl() . '/js/store.js' );

$this->breadcrumbs = array_merge(
    [ Yii::t( "StoreModule.store", 'Услуги' ) => [ '/store/product/index' ] ],
    $product->category ? $product->category->getBreadcrumbs( true ) : [], [ CHtml::encode( $product->name ) ]
);

?>

<div class="store-container product-container pb">
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
        
        <h1 class="heading heading-page heading-pb" itemprop="name"><?= CHtml::encode($product->getTitle()); ?></h1>
    </div>

    <div class="product-view js-load-chapche">
        <div class="content-site">
            <?php if ($product->description || $product->text_bold): ?>
                <div class="product-view__top product-top fl fl-w fl-jc-sb">
                    <?php if ($product->description): ?>
                        <div class="product-top__item normal">
                            <?= $product->description; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($product->text_bold): ?>
                        <div class="product-top__item bold">
                            <?= $product->text_bold; ?>
                        </div>
                     <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="product-view__informer product-informer fl fl-w fl-ai-c fl-jc-sb">
                <div class="product-informer__btn product-informer__item">
                    <a href="#productModal" data-toggle="modal" class="btn btn-blue btn-svg btn-svg-right btn-hover">
                        <span>Оставить заявку</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#ffffff" stroke-width="2"></path>
                        </svg>
                    </a>
                    <?php if($product->docs) : ?>
                        <a href="<?= $product->getDocumentUrl(); ?>" class="btn btn-gray btn-svg btn-svg-right btn-hover" target="_blank">
                            <span>Прайс-лист</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#38434E" stroke-width="2"></path></svg>
                        </a>
                    <?php endif; ?>
                </div>

                <?php if($product->price != 0 || $product->times) : ?>
                    <div class="product-informer__price product-informer__item">
                        <div class="price fl fl-w fl-ai-c">
                            <?php if($product->price != 0) : ?>
                                <div class="price-item fl fl-ai-bl">
                                    <div class="price__label">Цена</div>
                                    <div class="price__value bold">
                                        <?= str_replace('.00', '', number_format($product->getResultPrice(), 2, '.', ' ')); ?> <span class="ruble">₽</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($product->times) : ?>
                                <div class="price-item fl fl-ai-bl">
                                    <div class="price__label">Срок</div>
                                    <div class="price__value bold">
                                        <?= $product->times; ?> <span><?= $product->units; ?></span>
                                    </div>
                                </div>
                             <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php if($product->image) : ?>
                <div class="product-view__image pt">
                    <div class="product-img">
                        <picture>
                            <source srcset="<?= $product->getImageUrlWebp() ?>" type="image/webp">
                            <img src="<?= $product->getImageUrl(); ?>">
                        </picture>
                    </div>
                </div>
            <?php endif; ?> 

            <?php if($product->getAttributeValue('box1')['value']) : ?>
                <div class="product-view__text product-text fl fl-w fl-jc-sb pt pb">
                    <div class="product-text__item">
                        <h2 class="heading heading-pb"><?= $product->getAttributeValue('box1')['name']; ?></h2>
                    </div>
                    <div class="product-text__item">
                        <?= $product->getAttributeValue('box1')['value']; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if($product->getAttributeValue('image')['name']) : ?>
            <div class="product-view__wrap pt pb bg-body">
                <div class="content-site">
                    <div class="product-view__text product-text">
                        <div class="product-text__item">
                            <h2 class="heading heading-pb"><?= $product->getAttributeValue('image')['name']; ?></h2>
                        </div>
                        <?php $photos = $product->getAttributeValue('image')['gallery']; ?>
                        <div class="product-text__gallery">
                            <?php if($photos) : ?>
                                <?php foreach ($photos as $key => $photo): ?>
                                    <div class="wrap-item fl fl-w fl-jc-sb">
                                        <div class="wrap-item__text">
                                            <span><?= $photo['title']; ?></span>
                                            <p><?= $photo['alt']; ?></p>
                                        </div>
                                        <div class="wrap-item__img">
                                            <picture class="absolute-img-pictur">
                                                <source media="(min-width: 401px)" srcset="<?= $product->geFieldGalImageWebp(0, 0, false,  $photo['image']); ?>" type="image/webp">
                                                <source media="(min-width: 401px)" srcset="<?= $product->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>">
                                
                                                <source media="(min-width: 1px)" srcset="<?= $product->geFieldGalImageWebp(270, 530, true,  $photo['image']); ?>" type="image/webp">
                                                <source media="(min-width: 1px)" srcset="<?= $product->getFieldGalImageUrl(270, 530, true,  $photo['image']); ?>">
                                
                                                <img src="<?= $product->getFieldGalImageUrl(0, 0, false,  $photo['image']); ?>" alt="<?= $data->title; ?>">
                                            </picture>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            <?php else: ?>
                                <div class="wrap-item">
                                    <?= $product->getAttributeValue('image')['value']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
            
        <?php if($product->data): ?>
            <div class="content-site">
                <div class="product-view__text product-text category-info fl fl-w fl-jc-sb pt">
                    <?= $product->data; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="product__form pt pb">
    <div class="content-site">
        <div class="callback-form">
            <div class="callback-form__title">
                <h2 class="heading heading-pb">Хотите связаться с нами?</h2>
            </div>
        <?php $this->widget('application.modules.mail.widgets.GeneralFeedbackWidget', [
                'id' => 'contactModal',
                'view' => 'contact-form',
                'formClassName' => 'StandartForm',
                'buttonModal' => false,
                'titleModal' => 'Оставьте <span>заявку</span>',
                'subTitleModal' => 'и мы Вам перезвоним!',
                'showCloseButton' => false,
                'isRefresh' => true,
                'eventCode' => 'napisat-nam',
                'successKey' => 'napisat-nam',
                'showAttributeBody' => true,
                'showAttributeEmail' => true,
                'showAttributeCheck' => true,
                // 'required' => 'emailRequired',
                'modalHtmlOptions' => [
                    'class' => 'modal-my modal-my-xs',
                ],
                'formOptions' => [
                    'htmlOptions' => [
                        'class' => 'form-callback',
                    ]
                ],
                'modelAttributes' => [
                    'theme' => 'Написать нам',
                ],
            ]) ?>
        </div>
    </div>
</div>

<!-- Узнать стоимость -->
<?php $this->widget('application.modules.mail.widgets.GeneralFeedbackWidget', [
    'id' => 'productModal',
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
        'theme' => "Запрос со страницы {$product->name}",
    ],
]) ?>






