<?php
/**
 * Отображение для ./themes/default/views/news/news/news.php:
 *
 * @category YupeView
 * @package  YupeCMS
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 *
 * @var $this NewsController
 * @var $model News
 **/
?>
<?php
$this->title = ($model->meta_title) ? $model->meta_title : $model->title;
$this->description = $model->meta_description;
$this->keywords = $model->meta_keywords;
?>

<?php
$this->breadcrumbs = [
    Yii::t('NewsModule.news', 'News') => ['/news/news/index'],
    $model->title
];
?>

<div class="page-news-view pb">
    <div class="content-site">
        <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', [
                'links' => $this->breadcrumbs,
        ]); ?>
        <h1 class="heading heading-block"><?= CHtml::encode($model->title); ?></h1>
        
        <div class="news-view fl fl-jc-sb">
            <div class="news-view-content">
                <div class="news-view-content__link fl fl-w fl-ai-c fl-jc-sb">
                    <div class="news-box__date fl fl-ai-c">
                        <div><?= date("d.m.Y", strtotime($model->date)); ?></div>
                        <div class="news-block__visit fl fl-ai-c">
                            <img class="" src="<?= $this->mainAssets . '/images/icon/eye.svg' ?>" alt="Кол-во просмотров">
                            <span><?= $model->visit; ?></span>
                        </div>  
                    </div>
                    <div class="news-box__share fl fl-w fl-ai-c">
                        <p>Поделиться</p> 
                        <div class="share-wrap fl fl-ai-c">
                            <script src="https://yastatic.net/share2/share.js"></script>
                            <div class="ya-share2" data-curtain data-shape="round" data-services="vkontakte,facebook,odnoklassniki,twitter"></div>
                            <a class="social-share-more js-sharemore fl fl-ai-bl fl-jc-c" href="#">
                                ...
                            </a> 
                            <div class="social-share-tooltip">
                                <script src="https://yastatic.net/share2/share.js"></script>
                                <div class="ya-share2" data-curtain data-shape="round" data-services="telegram,viber,whatsapp"></div>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="news-view-content__body">
                    <?php if ($model->image): ?>
                        <div class="news-img">
                            <img src="<?= $model->getImageUrl(); ?>">
                        </div>
                    <?php endif; ?>
                    <?= $model->full_text; ?>
                </div>
                <div class="news-view-content__link news-view-content__link-bottom fl fl-w fl-ai-c fl-jc-sb">
                    <div class="news-box__date fl fl-ai-c">
                        <div><?= date("d.m.Y", strtotime($model->date)); ?></div>
                        <div class="news-block__visit fl fl-ai-c">
                            <img class="" src="<?= $this->mainAssets . '/images/icon/eye.svg' ?>" alt="Кол-во просмотров">
                            <span><?= $model->visit; ?></span>
                        </div>  
                    </div>
                    <div class="news-box__share fl fl-w fl-ai-c">
                        <p>Поделиться</p> 
                        <div class="share-wrap fl fl-ai-c">
                            <script src="https://yastatic.net/share2/share.js"></script>
                            <div class="ya-share2" data-curtain data-shape="round" data-services="vkontakte,facebook,odnoklassniki,twitter"></div>
                            <a class="social-share-more js-sharemore fl fl-ai-bl fl-jc-c" href="#">
                                ...
                            </a> 
                            <div class="social-share-tooltip">
                                <script src="https://yastatic.net/share2/share.js"></script>
                                <div class="ya-share2" data-curtain data-shape="round" data-services="telegram,viber,whatsapp"></div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
            <div class="news-view-panel">
                <div class="panel-div fl">
                    <p class="panel-p">Читайте также</p>
                </div>
                <?php $this->widget("application.modules.news.widgets.MyNewsWidget", [
                    'view' => 'news-sidebar',
                    'notIds' => "{$model->id},13",
                    'limit' => 6,
                ]); ?>
            </div>
        </div>
    </div>
</div>


