<?php if ($dataProvider->itemCount): ?>
    <div class="gallery">
        <div class="content-site">
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