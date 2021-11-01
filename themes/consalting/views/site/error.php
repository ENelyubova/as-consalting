<?php 
$this->title = Yii::t('default', 'Error') . ' ' . $error['code']; 
?>

<div class="page-error">
    <div class="content-site">
        <?php $this->widget(
            'bootstrap.widgets.TbBreadcrumbs',
            [
                'links' => $this->breadcrumbs,
            ]
        );?>
        <div id="notfound">
            <div class="notfound">
                <div class="notfound-404">
                <h3>Страница не найдена</h3>
                <h1><span>4</span><span>0</span><span>4</span></h1>
                </div>
                <h2>Извините, но заправшиваемая страница не найдена</h2>
                <a href="/" class="btn btn-blue btn-hover notfound-btn">На главную</a>
            </div>
        </div>
    </div>
</div>