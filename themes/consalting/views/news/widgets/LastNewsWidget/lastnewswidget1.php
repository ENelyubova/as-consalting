<?php if (isset($models) && $models != []): ?>
    <ul class="cl_news">
        <?php foreach ($models as $model): ?>
            <li>
                <?php if ($model->image):
                    echo "<a href='".Yii::app()->createUrl('/news/news/view',['slug'=>$model->slug])."'>".CHtml::image($model->getImageUrl(),'',array('style'=>'cursor: pointer;', 'href'=>$model->getImageUrl(), 'class'=>'img-responsive gallery-image cboxElement')).'</a>';  
                endif;
                echo '<span id="date">'.Yii::app()->getDateFormatter()->formatDateTime(
                                $model->date,
                                "long",
                                ""
                            ).'</span>';
                echo "<h5><a href='".Yii::app()->createUrl('/news/news/view',['slug'=>$model->slug])."'>".CHtml::encode($model->title)."</a></h5>"; 
                echo '<div class="line_hr"></div>';
                ?>
                <?= strip_tags($model->short_text).'...<br>'; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<div class="clearfix"></div>