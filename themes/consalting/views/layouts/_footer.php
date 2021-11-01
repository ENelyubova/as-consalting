<footer class="footer">
    <div class="content-site">
        <div class="footer-panel fl fl-jc-sb">
            <div class="footer-logo">
                <a href="/" class="logo fl fl-ai-c">
                    <img src="<?= $this->mainAssets . '/images/logo.svg' ?>" alt="АС-Консалтинг">
                </a>
            </div>
            <div class="footer-menu footer-menu-product footer-item">
                <div class="footer-heading">Направления</div>
                <?php $this->widget('application.modules.store.widgets.CategoryWidget', ['depth' => 1]); ?>
            </div>
            <div class="footer-menu footer-menu-all footer-item">
                <div class="footer-heading">Навигация</div>
                <?php if (Yii::app()->hasModule('menu')) : ?>
                    <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'top-menu', 'view' => 'menu']); ?>
                <?php endif; ?>
            </div>
            
            <div class="footer-contacts footer-item">
                <div class="footer-heading">Контакты</div>
                <div class="footer-contacts-item">
                    <?php if (Yii::app()->hasModule('contentblock')): ?>
                        <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'mode']); ?>
                    <?php endif; ?>
                    <?php if (Yii::app()->hasModule('contentblock')): ?>
                        <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'phone']); ?>
                    <?php endif; ?>
                </div>

                <div class="footer-contacts-item footer-contacts-address">
                    <?php if (Yii::app()->hasModule('contentblock')): ?>
                        <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'address']); ?>
                    <?php endif; ?>
                </div>

                <div class="footer-contacts-item footer-contacts-social social">
                    <?php if (Yii::app()->hasModule('contentblock')): ?>
                        <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'social']); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom fl fl-ai-c fl-jc-sb">
            <div class="footer-info"> 
                © 2008  — <?= date('Y'); ?>, ООО «ЮРЦЭО «АС-Консалтинг»
            </div>
            <div class="footer-legal">
                <ul>
                    <li>
                        <a href="/pravovaya-informaciya">Правовая информация</a>
                    </li>
                </ul>
            </div>
            <div class="footer-sitemap">
                <ul>
                    <li>
                        <a href="/sitemap">Карта сайта</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
