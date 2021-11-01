<div class="contacts pt pb">
    <div class="content-site">
        <div class="contacts-block fl fl-w fl-jc-sb">
            <div class="contacts-block__item contacts-item">
                <div class="contacts-item__elem">
                    <p>Оперативно отвечаем на все сообщения</p>
                </div>
                <div class="contacts-item__email contacts-item__elem">
                    <?php if (Yii::app()->hasModule('contentblock')): ?>
                        <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'email']); ?>
                    <?php endif; ?>
                </div>
                <div class="contacts-item__address contacts-item__elem">
                    <span>г. Ростов-на-Дону</span>
                    <?php if (Yii::app()->hasModule('contentblock')): ?>
                        <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'address']); ?>
                    <?php endif; ?>
                </div>
                <a class="btn btn-link btn-link-blue" data-fancybox="" data-type="iframe" data-src="https://yandex.ru/map-widget/v1/?um=constructor%3A84065e870cb2bea2cbf8b575234431ad87bb6c101d494faadd95f2d2b692e921&amp;source=constructor"  href="javascript:;">Показать на карте</a>
            </div>
            <div class="contacts-block__item contacts-item">
                <div class="contacts-item__elem">
                    <?php if (Yii::app()->hasModule('contentblock')): ?>
                        <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'mode']); ?>
                    <?php endif; ?>
                </div>
                <div class="contacts-item__phone contacts-item__elem">
                    <?php if (Yii::app()->hasModule('contentblock')): ?>
                        <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'phone']); ?>
                    <?php endif; ?>
                </div>
                <a href="/kontakty" class="btn btn-blue btn-svg btn-svg-right btn-hover"><span>Контакты и реквизиты</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#ffffff" stroke-width="2"/></svg></a>
            </div>
        </div>
    </div>
</div>