<?php
/**
 * News основная моделька для новостей
 *
 * @author yupe team <team@yupe.ru>
 * @link https://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.news.models
 * @since 0.1
 *
 */

/**
 * This is the model class for table "News".
 *
 * The followings are the available columns in table 'News':
 * @property integer $id
 * @property string $create_time
 * @property string $update_time
 * @property string $date
 * @property string $title
 * @property string $slug
 * @property string $short_text
 * @property string $full_text
 * @property integer $user_id
 * @property integer $status
 * @property integer $is_protected
 * @property string $link
 * @property string $image
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $visit
 */

use yupe\components\Event;
use yupe\widgets\YPurifier;
Yii::import('application.modules.category.models.*');
/**
 * Class News
 */
class News extends yupe\models\YModel
{
    /**
     *
     */
    const STATUS_DRAFT = 0;
    /**
     *
     */
    const STATUS_PUBLISHED = 1;
    /**
     *
     */
    const STATUS_MODERATION = 2;

    /**
     *
     */
    const PROTECTED_NO = 0;
    /**
     *
     */
    const PROTECTED_YES = 1;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{news_news}}';
    }

    /**
     * Returns the static model of the specified AR class.
     * @param  string $className
     * @return News   the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['title, slug, short_text, full_text, meta_title, meta_keywords, meta_description', 'filter', 'filter' => 'trim'],
            ['title, slug, meta_title, meta_keywords, meta_description', 'filter', 'filter' => [new YPurifier(), 'purify']],
            ['date, title, slug, full_text', 'required', 'on' => ['update', 'insert']],
            ['status, is_protected, category_id, visit', 'numerical', 'integerOnly' => true],
            ['title, slug', 'length', 'max' => 150],
            ['lang', 'length', 'max' => 2],
            ['lang', 'default', 'value' => Yii::app()->sourceLanguage],
            ['lang', 'in', 'range' => array_keys(Yii::app()->getModule('yupe')->getLanguagesList())],
            ['status', 'in', 'range' => array_keys($this->getStatusList())],
            ['slug', 'yupe\components\validators\YUniqueSlugValidator'],
            ['meta_title, meta_keywords, meta_description', 'length', 'max' => 250],
            ['link', 'length', 'max' => 250],
            ['link', 'yupe\components\validators\YUrlValidator'],
            [
                'slug',
                'yupe\components\validators\YSLugValidator',
                'message' => Yii::t('NewsModule.news', 'Bad characters in {attribute} field')
            ],
            ['category_id', 'default', 'setOnEmpty' => true, 'value' => null],
            [
                'id, meta_title, meta_keywords, meta_description, create_time, update_time, date, title, slug, short_text, full_text, user_id, status, is_protected, lang',
                'safe',
                'on' => 'search'
            ],
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        $module = Yii::app()->getModule('news');

        return [
            'imageUpload' => [
                'class' => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'minSize' => $module->minSize,
                'maxSize' => $module->maxSize,
                'types' => $module->allowedExtensions,
                'uploadPath' => $module->uploadPath,
            ],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return [
            'category' => [self::BELONGS_TO, 'Category', 'category_id'],
            'user' => [self::BELONGS_TO, 'User', 'user_id'],
        ];
    }

    /**
     * @return array
     */
    public function scopes()
    {
        return [
            'published' => [
                'condition' => 't.status = :status',
                'params' => [':status' => self::STATUS_PUBLISHED],
            ],
            'protected' => [
                'condition' => 't.is_protected = :is_protected',
                'params' => [':is_protected' => self::PROTECTED_YES],
            ],
            'public' => [
                'condition' => 't.is_protected = :is_protected',
                'params' => [':is_protected' => self::PROTECTED_NO],
            ],
            'recent' => [
                'order' => 'create_time DESC',
                'limit' => 5,
            ]
        ];
    }

    /**
     * @param $num
     * @return $this
     */
    public function last($num)
    {
        $this->getDbCriteria()->mergeWith(
            [
                'order' => 'date DESC',
                'limit' => $num,
            ]
        );

        return $this;
    }

    /**
     * @param $lang
     * @return $this
     */
    public function language($lang)
    {
        $this->getDbCriteria()->mergeWith(
            [
                'condition' => 'lang = :lang',
                'params' => [':lang' => $lang],
            ]
        );

        return $this;
    }

    /**
     * @param $category_id
     * @return $this
     */
    public function category($category_id)
    {
        $this->getDbCriteria()->mergeWith(
            [
                'condition' => 'category_id = :category_id',
                'params' => [':category_id' => $category_id],
            ]
        );

        return $this;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('NewsModule.news', 'Id'),
            'category_id' => Yii::t('NewsModule.news', 'Category'),
            'create_time' => Yii::t('NewsModule.news', 'Created at'),
            'update_time' => Yii::t('NewsModule.news', 'Updated at'),
            'date' => Yii::t('NewsModule.news', 'Date'),
            'title' => Yii::t('NewsModule.news', 'Title'),
            'slug' => Yii::t('NewsModule.news', 'Alias'),
            'image' => Yii::t('NewsModule.news', 'Image'),
            'link' => Yii::t('NewsModule.news', 'Link'),
            'lang' => Yii::t('NewsModule.news', 'Language'),
            'short_text' => Yii::t('NewsModule.news', 'Short text'),
            'full_text' => Yii::t('NewsModule.news', 'Full text'),
            'user_id' => Yii::t('NewsModule.news', 'Author'),
            'status' => Yii::t('NewsModule.news', 'Status'),
            'is_protected' => Yii::t('NewsModule.news', 'Access only for authorized'),
            'meta_title' => Yii::t('NewsModule.news', 'Page title (SEO)'),
            'meta_keywords' => Yii::t('NewsModule.news', 'Keywords (SEO)'),
            'meta_description' => Yii::t('NewsModule.news', 'Description (SEO)'),
            'visit' => Yii::t('NewsModule.news', 'Просмотры'),
        ];
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        if (!$this->slug) {
            $this->slug = yupe\helpers\YText::translit($this->title);
        }

        if (!$this->lang) {
            $this->lang = Yii::app()->getLanguage();
        }

        return parent::beforeValidate();
    }

    /**
     * @return bool
     */
    public function beforeSave()
    {
        $this->update_time = new CDbExpression('NOW()');
        $this->date = date('Y-m-d', strtotime($this->date));

        if ($this->getIsNewRecord()) {
            $this->create_time = $this->update_time;
            $this->user_id = Yii::app()->getUser()->getId();
        }

        return parent::beforeSave();
    }

    /**
     *
     */
    public function afterSave()
    {
        Yii::app()->eventManager->fire(NewsEvents::NEWS_AFTER_SAVE, new Event($this));

        return parent::afterSave();
    }

    /**
     *
     */
    public function afterDelete()
    {
        Yii::app()->eventManager->fire(NewsEvents::NEWS_AFTER_DELETE, new Event($this));

        parent::afterDelete();
    }

    /**
     *
     */
    public function afterFind()
    {
        $this->date = date('d-m-Y', strtotime($this->date));

        return parent::afterFind();
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria();

        $criteria->compare('t.id', $this->id);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('update_time', $this->update_time, true);
        if ($this->date) {
            $criteria->compare('date', date('Y-m-d', strtotime($this->date)));
        }
        $criteria->compare('title', $this->title, true);
        $criteria->compare('t.slug', $this->slug, true);
        $criteria->compare('short_text', $this->short_text, true);
        $criteria->compare('full_text', $this->full_text, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('category_id', $this->category_id, true);
        $criteria->compare('is_protected', $this->is_protected);
        $criteria->compare('t.lang', $this->lang);
        $criteria->compare('t.visit', $this->visit);
        $criteria->with = ['category'];

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'sort' => ['defaultOrder' => 'date DESC'],
        ]);
    }

    /**
     * @return array
     */
    public function getStatusList()
    {
        return [
            self::STATUS_DRAFT => Yii::t('NewsModule.news', 'Draft'),
            self::STATUS_PUBLISHED => Yii::t('NewsModule.news', 'Published'),
            self::STATUS_MODERATION => Yii::t('NewsModule.news', 'On moderation'),
        ];
    }

    /**
     * @return mixed|string
     */
    public function getStatus()
    {
        $data = $this->getStatusList();

        return isset($data[$this->status]) ? $data[$this->status] : Yii::t('NewsModule.news', '*unknown*');
    }

    /**
     * @return array
     */
    public function getProtectedStatusList()
    {
        return [
            self::PROTECTED_NO => Yii::t('NewsModule.news', 'no'),
            self::PROTECTED_YES => Yii::t('NewsModule.news', 'yes'),
        ];
    }

    /**
     * @return mixed|string
     */
    public function getProtectedStatus()
    {
        $data = $this->getProtectedStatusList();

        return isset($data[$this->is_protected]) ? $data[$this->is_protected] : Yii::t('NewsModule.news', '*unknown*');
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        return ($this->category === null) ? '---' : $this->category->name;
    }

    /**
     * @return string
     */
    public function getFlag()
    {
        return yupe\helpers\YText::langToflag($this->lang);
    }

    /**
     * @return bool
     */
    public function isProtected()
    {
        return $this->is_protected == self::PROTECTED_YES;
    }

    // Справочник доступных годов
    function getYearLists() {
        $criteria = new CDbCriteria();
        $news = self::model()->published()->findAll($criteria);
        $years = [];
        foreach($news as $key => $item){
            $years[] = date('Y', strtotime($item->date));
        }
        $years = array_unique($years);
        rsort($years);

        return $years;
    }

    // Справочник месяцев
    function getMounthlyLists($lang = 'ru') {
        return array (
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12=> 'Декабрь'
        );
    }

    function getCategoryList(){
        return CHtml::listData(Category::model()->published()->findAll(), 'id', 'name');
    }

    // Получаю список записей из рубрики "Новости"
    function getNewsPosts() {
        $cat = get_category_by_slug('news');

        if(!$cat){
            return [];
        }

        $filterParams = array (
            'year' => isset($_GET['customYear']) ? $_GET['customYear'] : '',
            'monthnum' => isset($_GET['customMounthly']) ? $_GET['customMounthly'] : ''
        );

        $search = isset($_GET['customS']) ? $_GET['customS'] : '';
        $customAuthor = isset($_GET['customAuthor']) ? $_GET['customAuthor'] : '';

        $posts = get_posts( array(
            'numberposts' => 100,
            'date_query' => [
                'year' => (int)$filterParams['year'],
                'monthnum' => $filterParams['monthnum']
            ],
            'author' => $customAuthor,
            's' => $search,
            'category'    => $cat->term_id,
            'orderby'     => 'date',
            'order'       => isset($_GET['customYear']) ? $_GET['customYear'] : 'DESC',
            'include'     => array(),
            'exclude'     => array(),
            'meta_key'    => '',
            'meta_value'  =>'',
            'post_type'   => 'post',
            'suppress_filters' => true,
        ) );

        return $posts;
    }
}
