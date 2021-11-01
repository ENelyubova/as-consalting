<?php
/* @var $this CartController */
/* @var $positions Product[] */
/* @var $order Order */
/* @var $coupons Coupon[] */

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();

Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/store.js');
Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/cart-frontend.css');

$this->title = Yii::t('CartModule.cart', 'Cart');
$this->breadcrumbs = [
    Yii::t("CartModule.cart", 'Catalog') => ['/store/product/index'],
    Yii::t("CartModule.cart", 'Cart')
];
?>

<script type="text/javascript">
    var yupeCartDeleteProductUrl = '<?= Yii::app()->createUrl('/cart/cart/delete/')?>';
    var yupeCartUpdateUrl = '<?= Yii::app()->createUrl('/cart/cart/update/')?>';
    var yupeCartWidgetUrl = '<?= Yii::app()->createUrl('/cart/cart/widget/')?>';
    var yupeCartEmptyMessage = '<h1 class="title-store"><?= Yii::t("CartModule.cart", "Cart is empty"); ?></h1><?= Yii::t("CartModule.cart", "There are no products in cart"); ?>';
</script>

<div class="store-container product-container" id="cart-body">
    <div class="content-site">
        <h1 class="title-store">Корзина товаров</h1>
        <?php if (Yii::app()->cart->isEmpty()): ?>
        <?= Yii::t("CartModule.cart", "There are no products in cart"); ?>
        <?php else: ?>
        <?php
            $form = $this->beginWidget(
                'bootstrap.widgets.TbActiveForm',
                [
                    'action' => ['/order/order/create'],
                    'id' => 'order-form',
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
                    'clientOptions' => [
                        'validateOnSubmit' => true,
                        'validateOnChange' => true,
                        'validateOnType' => false,
                        'beforeValidate' => 'js:function(form){$(form).find("button[type=\'submit\']").prop("disabled", true); return true;}',
                        'afterValidate' => 'js:function(form, data, hasError){$(form).find("button[type=\'submit\']").prop("disabled", false); return !hasError;}',
                    ],
                    'htmlOptions' => [
                        'hideErrorMessage' => false,
                        'class' => 'order-form',
                    ]
                ]
            ); ?>
        
        <div class="panel-shopcart">
            <div class="header-shopcart">
                <div class="col-flex cart-image"><label>Модель</label></div>
                <div class="col-flex cart-title"><label>Описание</label></div>
                <div class="col-flex cart-attribute hidden-xs"><label>Атрибуты товара</label></div>
                <div class="col-flex cart-price-item hidden-xs"><label>Цена</label></div>
                <div class="col-flex cart-count-item hidden-xs"><label>Количество</label></div>
                <div class="col-flex cart-sum-item hidden-xs"><label>Итого</label></div>
                <div class="col-flex cart-button"></div>
            </div>
            
            <div class="body-shopcart">
                <?php foreach ($positions as $position): ?>
                    <div class="shopcart-line-item cart-position cart-position-<?= $position->id; ?>">
                        <?php 
                            $productModel = $position->getProductModel();
                            if (is_null($productModel)) continue; 
                        ?>
                        <?php $positionId = $position->getId(); ?>
                        <?php $productUrl = ProductHelper::getUrl($position); ?>

                        <?= CHtml::hiddenField('OrderProduct[' . $positionId . '][product_id]', $position->id); ?>
                        <input type="hidden" class="position-id" value="<?= $positionId; ?>"/>

                        <div class="col-flex cart-image">
                            <?= CHtml::link(CHtml::image(StoreImage::product($productModel, 100, 120)), ProductHelper::getUrl($position)); ?>
                        </div>

                        <div class="col-flex cart-title">
                            <span><?= $position->sku; ?></span>
                            <h4 class="shopcart-title-product">
                                <?= CHtml::link($position->name, $productUrl); ?>
                            </h4>
                        </div>
        
                        <div class="col-flex cart-attribute hidden-xs">
                            <?php foreach ($position->selectedVariants as $variant): ?>
                                <label><?= $variant->attribute->title; ?>: <span><?= $variant->getOptionValue(); ?></span></label>
                                <?= CHtml::hiddenField('OrderProduct[' . $positionId . '][variant_ids][]', $variant->id); ?>
                            <?php endforeach; ?>
                        </div>

                        <div class="col-flex cart-price-item hidden-xs">
                            <div class="position-price price-cart"><?= $position->getResultPrice(); ?><i class="fa fa-rub" aria-hidden="true"></i></div>
                        </div>

                        <div class="col-flex cart-count-item hidden-xs">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button class="btn btn-default cart-quantity-decrease" type="button" data-target="#cart_<?= $positionId; ?>">-</button>
                                </div>
                                <?= CHtml::textField('OrderProduct[' . $positionId . '][quantity]',$position->getQuantity(),['id' => 'cart_' . $positionId, 'class' => 'form-control text-center position-count']); ?>
                                <div class="input-group-btn">
                                    <button class="btn btn-default cart-quantity-increase" type="button" data-target="#cart_<?= $positionId; ?>">+</button>
                                </div>
                            </div>
                        </div>
        
                        <div class="col-flex cart-sum-item hidden-xs">
                            <span class="position-sum-price"><?= $position->getSumPrice(); ?></span>
                        </div>
        
                        <div class="col-flex cart-button"> 
                            <button type="button" class="btn btn-danger cart-delete-product" data-position-id="<?= $positionId; ?>" data-product-id="<?= $position->id; ?>">
                                <i class="glyphicon glyphicon-remove"></i>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
                
            </div>
            <div class="footer-shopcart">
                 Итого: <span id="cart-total-product-count">
                <?= Yii::app()->cart->getItemsCount(); ?></span> товар(ов) на сумму <span id="cart-full-cost-with-shipping">0</span>
                <span class="ruble"> <?= Yii::t("CartModule.cart", Yii::app()->getModule('store')->currency); ?></span>
            </div>
        </div>
        <div class="panel-shopcart-delivery">
            <div class="row">
                <div class="col-sm-6 co-xs-12">
                    <div class="panel-delivery">
                        <h4>Выберите способ доставки</h4>
                         <?php if(!empty($deliveryTypes)):?>
                            <fieldset class="block-delivery">
                                <?php foreach ($deliveryTypes as $key => $delivery): ?>
                                    <label class="radio" for="delivery-<?= $delivery->id; ?>">
                                        <input type="radio" name="Order[delivery_id]" id="delivery-<?= $delivery->id; ?>"
                                               value="<?= $delivery->id; ?>"
                                               data-price="<?= $delivery->price; ?>"
                                               data-free-from="<?= $delivery->free_from; ?>"
                                               data-available-from="<?= $delivery->available_from; ?>"
                                               data-separate-payment="<?= $delivery->separate_payment; ?>">
                                        <?= $delivery->name; ?>
                                    </label>
                                    <div class="delivery-description">
                                        <?= $delivery->description; ?>
                                    </div>
                                <?php endforeach; ?>
                            </fieldset>
                        <?php else: ?>
                            <?= Yii::t("CartModule.cart", "Delivery method aren't selected! The ordering is impossible!") ?>
                        <?php endif;?>
                    </div>
                </div>
                <div class="col-sm-6 co-xs-12">
                    <div class="panel-order">
                        <?= $form->textFieldGroup($order, 'name'); ?>
                        <?= $form->textFieldGroup($order, 'email'); ?>
                        <?= $form->maskedTextFieldGroup($order, 'phone', [
                            'widgetOptions' => [
                                'mask' => Yii::app()->getModule('user')->phoneMask,
                                'htmlOptions'=>['placeholder'=> '+7(***)***-**-**']
                            ]
                        ]); ?>
                        <?= $form->textFieldGroup($order, 'address', 	
                        [							
                            'widgetOptions' => [
                                'htmlOptions'=>['placeholder'=>'Введите адрес. Пример, Оренбург, ул. 9 Января, 62']
                            ]
                        ]); ?>
                        <button type="submit" class="btn btn-brown">Оформить заказ</button>
                    </div>
                </div>
            </div>
            
        </div>
        <?php $this->endWidget(); ?>
        <?php endif; ?>
    </div>
</div>