<?php
/**
* Отображение для video/index
*
* @category YupeView
* @package  yupe
* @author   Yupe Team <team@yupe.ru>
* @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
* @link     http://yupe.ru
**/
$this->title = Yii::t('VideoModule.video', 'video');
$this->description = Yii::t('VideoModule.video', 'video');
$this->keywords = Yii::t('VideoModule.video', 'video');
$this->layout = "//layouts/padding";
$this->breadcrumbs = [
	'Галерея событий',
	Yii::t('VideoModule.video', 'video')
]; ?>

<h1><?= Yii::t('VideoModule.video', 'video'); ?></h1>
<?php
$this->widget(
    'bootstrap.widgets.TbListView',
    [
        'dataProvider' => $dataProvider,
        'itemView'     => '_video',
        'template'     => "{items}\n{pager}",
        'itemsCssClass' => 'video_ul',
        'separator'    => '',
    ]
); ?>