<?php if ($dataProvider->itemCount): ?>
    <div class="gallery pt pb bg-white">
        <div class="content-site">
            <div class="heading-block fl fl-w fl-ai-c fl-jc-sb">
                <h2 class="quantum__title">Медиа</h2>
                <div class="gallery-btn fl fl-ai-c fl-jc-sb">
                    <div class="top-link">
                        <a href="/galereya" class="btn btn-link btn-link-blue">Подробнее</a>
                    </div>
                    <div class="arrows"></div>
                </div>
            </div>

            <?php
            $this->widget(
                'application.components.FtListView', [
                'id' => 'gallery-block',
                'itemView' => '_image',
                'dataProvider' => $dataProvider,
                'itemsCssClass' => 'gallery-block',
                'template' => '{items}',
            ]); ?>
        </div>
    </div>
<?php endif; ?>