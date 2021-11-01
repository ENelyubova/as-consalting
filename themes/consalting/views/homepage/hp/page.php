 <?php
/** @var Page $page */

if ($page->layout) {
    $this->layout = "//layouts/{$page->layout}";
}

$this->title = $page->title;
$this->breadcrumbs = [
    Yii::t('HomepageModule.homepage', 'Pages'),
    $page->title
];
$this->description = !empty($page->meta_description) ? $page->meta_description : Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = !empty($page->meta_keywords) ? $page->meta_keywords : Yii::app()->getModule('yupe')->siteKeyWords
?>

<?php if($page->getAttributeValue('main')['name']) : ?>
    <div class="main">
        <div class="content-site">
            <div class="main__block fl fl-w fl-jc-sb">
                <div class="main__text fl fl-d-c">
                    <h1 class="heading heading-page heading-pb"><?= $page->getAttributeValue('main')['name']; ?></h2>
                    <?= $page->getAttributeValue('main')['value']; ?>
                    <div class="main__btn fl fl-w fl-ai-c">
                        <a href="#" class="btn btn-blue btn-svg btn-svg-right btn-hover">
                            <span>Калькулятор</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none"><rect width="10" height="10" rx="2" fill="white"/><rect y="12" width="10" height="10" rx="2" fill="white"/><rect x="12" width="10" height="10" rx="2" fill="white"/><rect x="12" y="12" width="10" height="10" rx="2" fill="white"/><path d="M14 5.12109H17.1201H20.2402" stroke="#5B9CDD" stroke-width="2"/><path fill-rule="evenodd" clip-rule="evenodd" d="M14 16.5V15L20 15V16.5L14 16.5Z" fill="#5B9CDD"/><path fill-rule="evenodd" clip-rule="evenodd" d="M14 19V17.5L20 17.5V19L14 19Z" fill="#5B9CDD"/><path d="M2 5.12109H5.12012M8.24023 5.12109H5.12012M5.12012 5.12109V2.00098M5.12012 5.12109V8.24121" stroke="#5B9CDD" stroke-width="2"/><path d="M2.91406 14.9141L5.12032 17.1203M7.32657 19.3266L5.12032 17.1203M5.12032 17.1203L7.32657 14.9141M5.12032 17.1203L2.91406 19.3266" stroke="#5B9CDD" stroke-width="2"/>
                            </svg>
                        </a>
                        <a href="#callbackModal" data-toggle="modal" class="btn btn-gray btn-svg btn-svg-right btn-hover">
                            <span>Связаться с нами</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#38434E" stroke-width="2"></path></svg>
                        </a>
                    </div>
                    <div class="scroll-label fl fl-ai-c">
                        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                                <g clip-path="url(#clipmouse)">
                                <path d="M14.168 5.34668C14.4 5.34668 14.6226 5.43887 14.7867 5.60296C14.9508 5.76706 15.043 5.98962 15.043 6.22168V9.72168C15.043 9.95374 14.9508 10.1763 14.7867 10.3404C14.6226 10.5045 14.4 10.5967 14.168 10.5967C13.9359 10.5967 13.7133 10.5045 13.5493 10.3404C13.3852 10.1763 13.293 9.95374 13.293 9.72168V6.22168C13.293 5.98962 13.3852 5.76706 13.5493 5.60296C13.7133 5.43887 13.9359 5.34668 14.168 5.34668ZM21.168 19.3467C21.168 21.2032 20.4305 22.9837 19.1177 24.2964C17.805 25.6092 16.0245 26.3467 14.168 26.3467C12.3115 26.3467 10.531 25.6092 9.21822 24.2964C7.90547 22.9837 7.16797 21.2032 7.16797 19.3467V8.84668C7.16797 6.99016 7.90547 5.20969 9.21822 3.89693C10.531 2.58418 12.3115 1.84668 14.168 1.84668C16.0245 1.84668 17.805 2.58418 19.1177 3.89693C20.4305 5.20969 21.168 6.99016 21.168 8.84668V19.3467ZM14.168 0.0966797C11.8473 0.0966797 9.62173 1.01855 7.98078 2.6595C6.33984 4.30044 5.41797 6.52604 5.41797 8.84668V19.3467C5.41797 21.6673 6.33984 23.8929 7.98078 25.5339C9.62173 27.1748 11.8473 28.0967 14.168 28.0967C16.4886 28.0967 18.7142 27.1748 20.3552 25.5339C21.9961 23.8929 22.918 21.6673 22.918 19.3467V8.84668C22.918 6.52604 21.9961 4.30044 20.3552 2.6595C18.7142 1.01855 16.4886 0.0966797 14.168 0.0966797V0.0966797Z" fill="#73808C"></path>
                                </g>
                                <defs>
                                <clipPath id="clipmouse">
                                <rect width="28" height="28" fill="white" transform="translate(0.167969 0.0966797)"></rect>
                                </clipPath>
                                </defs>
                            </svg>
                        <span>Скрольте для продолжения</span>
                    </div>
                </div>
                <div class="main__video">
                    <video preload="auto" autoplay="true" loop="true" muted="muted" playsinline>
                        <source src="/uploads/АС.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="directions pt">
    <div class="content-site">
        <h2 class="heading heading-pb">Направления</h2>
        <?php $this->widget('application.modules.store.widgets.CatalogWidget', [
            'view' => 'directions'
        ]); ?>
    </div>
</div>

<?php if($page->getAttributeValue('about')['name']) : ?>
    <div class="about pt">
        <div class="content-site">
            <div class="about-block fl fl-w fl-jc-sb">
                <div class="about-title">
                    <h2 class="heading heading-pb"><?= $page->getAttributeValue('about')['name']; ?></h2>
                    <?php 
                        $companyButName = $page->getAttributeValue('about')['butName'];
                        $companyButLink = $page->getAttributeValue('about')['butLink'];
                     ?>
                    <?php if($companyButLink) : ?>
                        <a class="btn btn-blue btn-svg btn-svg-right btn-hover" href="<?= $companyButLink; ?>">
                            <span><?= ($companyButName) ?: 'О компании'; ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#ffffff" stroke-width="2"/>
                            </svg>
                        </a>
                    <?php else : ?>
                        <a href="/o-kompanii" class="btn btn-blue btn-svg btn-svg-right btn-hover"><span>О компании</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#ffffff" stroke-width="2"/>
                            </svg></a>
                    <?php endif; ?>
                </div>
                <div class="about-desc">
                    <?= $page->getAttributeValue('about')['value']; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php $this->widget('application.modules.video.widgets.VideoWidget', [
    'view' => 'video-home'
]); ?>


<?php if($page->getAttributeValue('map')['name']) : ?>
    <div class="map">
        <div class="content-site">
            <div class="map-block fl fl-w fl-jc-sb">
                <div class="map__text">
                    <h2 class="heading heading-pb"><?= $page->getAttributeValue('map')['name']; ?></h2>
                    <?= $page->getAttributeValue('map')['value']; ?>
                    <?php 
                        $companyButName = $page->getAttributeValue('map')['butName'];
                        $companyButLink = $page->getAttributeValue('map')['butLink'];
                     ?>
                    <?php if($companyButLink) : ?>
                        <a class="btn btn-blue btn-svg btn-svg-right btn-hover" href="<?= $companyButLink; ?>">
                            <span><?= ($companyButName) ?: 'О компании'; ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#ffffff" stroke-width="2"/>
                            </svg>
                        </a>
                    <?php else : ?>
                        <a href="/o-kompanii" class="btn btn-blue btn-svg btn-svg-right btn-hover"><span>О компании</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M7.7782 0V7.77817M7.7782 15.5563V7.77817M7.7782 7.77817L15.5564 7.77817M7.7782 7.77817H2.3561e-05" stroke="#ffffff" stroke-width="2"/>
                            </svg></a>
                    <?php endif; ?>
                </div>
                <div class="map__img">
                    <img src="<?= $this->mainAssets . '/images/map.png' ?>" alt="Карта офисов АС-Консалтинг">
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php $this->widget("application.modules.news.widgets.MyNewsWidget", [
    'view' => 'news-home',
]); ?>

<?php $this->widget("application.modules.page.widgets.PagesNewWidget", [
    'view' => 'contacts'
]); ?> 



