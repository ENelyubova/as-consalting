<div id="cart-widget" data-cart-widget-url="<?= Yii::app()->createUrl('/cart/cart/widget');?>">
    <a href="<?= Yii::app()->createUrl('cart/cart/index'); ?>">
        <i class="icon--4 count"></i>Корзина
        <div class="count-product-cart"><?= Yii::app()->cart->getCount(); ?></div>
    </a>
</div>