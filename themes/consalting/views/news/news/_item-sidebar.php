<div class="news-block__item">
    <div class="news-block__body">
        <div class="news-block__date fl fl-ai-c">
            <?= date("d.m.Y", strtotime($data->date)); ?>  
        </div>
        <a href="<?= Yii::app()->createUrl('/news/news/view', ['slug' => $data->slug]); ?>">
            <div class="news-block__title">
                <?= $data->title; ?>
            </div>
        </a>
    </div>
</div>





