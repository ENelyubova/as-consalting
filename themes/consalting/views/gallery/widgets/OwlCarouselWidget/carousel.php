<?php
/**
 * Отображение для GalleryWidget/gallerywidget:
 *
 * @category YupeView
 * @package  YupeCMS
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 **/
$url = Yii::app()->getTheme()->getAssetsUrl();

Yii::app()->getClientScript()->registerScriptFile($url . '/js/owl.carousel.min.js', CClientScript::POS_END);

?>

<?php $this->widget(
    'bootstrap.widgets.TbListView',
    array(
        'dataProvider'  => $dataProvider,
        'itemView'      => '_carouselitem',
        'template'      => "{items}",
       	'itemsCssClass' => 'owl-carousel-'.$id,
        'itemsTagName'  => 'div'
    )
); ?>
