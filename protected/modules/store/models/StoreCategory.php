<?php
use yupe\components\Event;
use yupe\widgets\YPurifier;

/**
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $slug
 * @property integer $status
 * @property integer $parent_id
 * @property integer $sort
 * @property string $external_id
 * @property string $title
 * @property string $meta_canonical
 * @property string $image_alt
 * @property string $image_title
 * @property string $view
 * @property string $svg
 * @property string $price
 *
 * @property-read StoreCategory $parent
 * @property-read StoreCategory[] $children
 *
 * @method StoreCategory published
 * @method StoreCategory roots
 * @method getImageUrl
 *
 */
class StoreCategory extends \yupe\models\YModel
{
    public $uploadCustomfield = 'customfield';
    public $uploadCustomfieldGallery = 'customfield/category';
    /**
     *
     */
    const STATUS_DRAFT = 0;
    /**
     *
     */
    const STATUS_PUBLISHED = 1;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{store_category}}';
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className
     * @return StoreCategory the static model class
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
            [
                'name, title, description, short_description, slug, meta_title, meta_keywords, meta_description, svg',
                'filter',
                'filter' => 'trim',
            ],
            ['name, slug', 'filter', 'filter' => [$obj = new YPurifier(), 'purify']],
            ['name, slug', 'required'],
            ['parent_id, status, sort', 'numerical', 'integerOnly' => true],
            ['parent_id, status', 'length', 'max' => 11],
            ['parent_id', 'default', 'setOnEmpty' => true, 'value' => null],
            ['status', 'numerical', 'integerOnly' => true],
            ['status', 'length', 'max' => 11],
            ['name, title, image, image_alt, image_title, meta_title, meta_keywords, meta_description, meta_canonical', 'length', 'max' => 250],
            ['slug', 'length', 'max' => 150],
            ['external_id, view', 'length', 'max' => 100],
            [
                'slug',
                'yupe\components\validators\YSLugValidator',
                'message' => Yii::t('StoreModule.store', 'Bad characters in {attribute} field'),
            ],
            ['slug', 'unique'],
            ['status', 'in', 'range' => array_keys($this->getStatusList())],
            ['meta_canonical', 'url'],
            ['id, parent_id, name, description, sort, short_description, slug, status, svg, price', 'safe', 'on' => 'search'],
        ];
    }


    /**
     * @return array
     */
    public function behaviors()
    {
        $module = Yii::app()->getModule('store');

        return [
            'imageUpload' => [
                'class' => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'minSize' => $module->minSize,
                'maxSize' => $module->maxSize,
                'types' => $module->allowedExtensions,
                'uploadPath' => $module !== null ? $module->uploadPath.'/category' : null,
            ],
            'fileUpload' => [
                'class'         => 'yupe\components\behaviors\FileUploadBehavior',
                'attributeName' => 'price',
                'minSize'       => $module->minSize,
                'maxSize'       => $module->maxSize,
                'types'         => 'docx, doc, pdf, xlsx',
                'uploadPath'    => $module->uploadPathPrice,
                'deleteFileKey'     => 'delete-file3'
            ],
            'tree' => [
                'class' => 'store\components\behaviors\DCategoryTreeBehavior',
                'aliasAttribute' => 'slug',
                'requestPathAttribute' => 'path',
                'parentAttribute' => 'parent_id',
                'parentRelation' => 'parent',
                'statAttribute' => 'productCount',
                'defaultCriteria' => [
                    'order' => 't.sort',
                    'with' => 'productCount',
                ],
                'titleAttribute' => 'name',
                'iconAttribute' => function(StoreCategory $item){
                    return $item->getImageUrl(150, 150);
                },
                'iconAltAttribute' => function(StoreCategory $item){
                    return $item->getImageAlt();
                },
                'iconTitleAttribute' => function(StoreCategory $item){
                    return $item->getImageTitle();
                },
                'useCache' => true,
            ],
            'sortable' => [
                'class' => 'yupe\components\behaviors\SortableBehavior',
                'attributeName' => 'sort',
            ],
        ];
    }

    /**
     * @return array
     */
    public function relations()
    {
        return [
            'parent' => [self::BELONGS_TO, 'StoreCategory', 'parent_id'],
            'children' => [self::HAS_MANY, 'StoreCategory', 'parent_id'],
            'productCount' => [self::STAT, 'Product', 'category_id'],
        ];
    }

    /**
     * @return array
     */
    public function scopes()
    {
        return [
            'published' => [
                'condition' => 'status = :status',
                'params' => [':status' => self::STATUS_PUBLISHED],
            ],
            'roots' => [
                'condition' => 'parent_id IS NULL',
            ],
            'child' => [
                'condition' => 'parent_id = :id',
                'params' => [':id' => $this->id],
            ]
        ];
    }

    /**
     * @return bool
     */
    public function beforeSave()
    {
        /* Произвольные поля */
        $myfield = Yii::app()->getRequest()->getPost('MyCustomField');
        $myfieldDelete = Yii::app()->getRequest()->getPost('MyCustomFieldDelete');

        if(!empty($myfield)){
            ksort($myfield);

            $newmyfield = [];
            $count = 1;
            foreach ($myfield as $key => $value) {
                $newmyfield[$count] = $value;
                $newmyfield[$count]['image'] = $this->updateMyCustomFieldImage($count, $value['image']);
                $newmyfield[$count]['gallery'] = $this->updateMyCustomFieldGallery($count, $value['gallery']);
                $count++;
            }

            $this->data = serialize($newmyfield);
        } else if(is_array($this->data)) {
            $this->data = serialize($this->data);
            if(!empty($myfieldDelete)){
                $this->data = null;
            }
        }
        /*==================*/

        return parent::beforeSave();
    }


    /**
     *
     */
    public function afterSave()
    {
        Yii::app()->eventManager->fire(StoreEvents::CATEGORY_AFTER_SAVE, new Event($this));

        return parent::afterSave();
    }
     /**
     * @return bool
     */
     public function afterFind()
    {
        /* Произвольные поля */
        if(!empty($this->data)){
            $this->data = unserialize($this->data);
        }
        /*==================*/

        return parent::afterFind();
    }


    /**
     *
     */
    public function afterDelete()
    {
        Yii::app()->eventManager->fire(StoreEvents::CATEGORY_AFTER_DELETE, new Event($this));

        parent::afterDelete();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('StoreModule.store', 'Id'),
            'parent_id' => Yii::t('StoreModule.store', 'Parent'),
            'name' => Yii::t('StoreModule.store', 'Name'),
            'image' => Yii::t('StoreModule.store', 'Image'),
            'short_description' => Yii::t('StoreModule.store', 'Short description'),
            'description' => Yii::t('StoreModule.store', 'Description'),
            'slug' => Yii::t('StoreModule.store', 'Alias'),
            'meta_title' => Yii::t('StoreModule.store', 'Meta title'),
            'meta_keywords' => Yii::t('StoreModule.store', 'Meta keywords'),
            'meta_description' => Yii::t('StoreModule.store', 'Meta description'),
            'status' => Yii::t('StoreModule.store', 'Status'),
            'sort' => Yii::t('StoreModule.store', 'Order'),
            'external_id' => Yii::t('StoreModule.store', 'External id'),
            'title' => Yii::t('StoreModule.store', 'SEO_title'),
            'meta_canonical' => Yii::t('StoreModule.store', 'Canonical'),
            'image_alt' => Yii::t('StoreModule.store', 'Image alt'),
            'image_title' => Yii::t('StoreModule.store', 'Image title'),
            'view' => Yii::t('StoreModule.store', 'Template'),
            'svg' => Yii::t('StoreModule.store', 'svg'),
            'price' => Yii::t('StoreModule.store', 'Документ'),
        ];
    }

    /**
     * @return array customized attribute descriptions (name=>description)
     */
    public function attributeDescriptions()
    {
        return [
            'id' => Yii::t('StoreModule.store', 'Id'),
            'parent_id' => Yii::t('StoreModule.store', 'Parent'),
            'name' => Yii::t('StoreModule.store', 'Title'),
            'image' => Yii::t('StoreModule.store', 'Image'),
            'short_description' => Yii::t('StoreModule.store', 'Short description'),
            'description' => Yii::t('StoreModule.store', 'Description'),
            'slug' => Yii::t('StoreModule.store', 'Alias'),
            'meta_title' => Yii::t('StoreModule.store', 'Meta title'),
            'meta_keywords' => Yii::t('StoreModule.store', 'Meta keywords'),
            'meta_description' => Yii::t('StoreModule.store', 'Meta description'),
            'status' => Yii::t('StoreModule.store', 'Status'),
            'sort' => Yii::t('StoreModule.store', 'Order'),
            'title' => Yii::t('StoreModule.store', 'SEO_title'),
            'meta_canonical' => Yii::t('StoreModule.store', 'Canonical'),
            'image_alt' => Yii::t('StoreModule.store', 'Image alt'),
            'image_title' => Yii::t('StoreModule.store', 'Image title'),
            'view' => Yii::t('StoreModule.store', 'Template'),
            'svg' => Yii::t('StoreModule.store', 'svg'),
            'price' => Yii::t('StoreModule.store', 'Документ'),
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('meta_title', $this->meta_title, true);
        $criteria->compare('meta_keywords', $this->meta_keywords, true);
        $criteria->compare('meta_description', $this->meta_description, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('sort', $this->sort);
        $criteria->compare('svg', $this->svg);
        $criteria->compare('price', $this->price);

        return new CActiveDataProvider(
            StoreCategory::_CLASS_(),
            [
                'criteria' => $criteria,
                'sort' => ['defaultOrder' => 't.sort'],
            ]
        );
    }

    /**
     * @return array
     */
    public function getStatusList()
    {
        return [
            self::STATUS_DRAFT => Yii::t('StoreModule.store', 'Draft'),
            self::STATUS_PUBLISHED => Yii::t('StoreModule.store', 'Published'),
        ];
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        $data = $this->getStatusList();

        return isset($data[$this->status]) ? $data[$this->status] : Yii::t('StoreModule.store', '*unknown*');
    }

    /**
     * @return string
     */
    public function getParentName()
    {
        return $this->parent ? $this->parent->name : '---';
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title ?: $this->name;
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->meta_title ?: $this->name;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->meta_keywords;
    }

    /**
     * Get canonical url
     *
     * @return string
     */
    public function getMetaCanonical()
    {
        return $this->meta_canonical;
    }

    /**
     * Get image alt tag text
     *
     * @return string
     */
    public function getImageAlt()
    {
        return $this->image_alt ?: $this->getTitle();
    }

    /**
     * Get image title tag text
     *
     * @return string
     */
    public function getImageTitle()
    {
        return $this->image_title ?: $this->getTitle();
    }

    public function getCategoryUrl()
    {
        $slug = $this->slug;
        $parent = $this->parent;

        while ($parent) {
            $slug = $parent->slug . '/' . $slug;
            $parent = $parent->parent;
        }

        return Yii::app()->createUrl('store/category/view', ['path' => $slug]);
    }

    public function getDocumentUrl()
    {
        $module = Yii::app()->getModule('store');
        return '/uploads/'.$module->uploadPathPrice.'/'.$this->price;
    }

    public function isRootCategory(){
        if(!empty($this->parent_id)){
            return false;
        }
        return true;
    }

    /*******************************
    ////////////////////////////////
    ------ Произвольные поля -------
    ////////////////////////////////
    ****************************** */
    /*
     * Фунция загрузки изображения
    */
    public function updateMyCustomFieldImage($count, $name)
    {
        $delete = Yii::app()->getRequest()->getPost('myCustomField-delete-image-'.$count);
        $new_image = CUploadedFile::getInstancesByName('MyCustomField_'.$count);
        $path = Yii::getPathOfAlias("webroot.uploads.{$this->uploadCustomfield}").DIRECTORY_SEPARATOR;
        if (!empty($new_image) || !empty($delete)) {
            $del = @unlink($path.$name);
            if($del == true && empty($new_image)){
                return '';
            }
       
            foreach($new_image as $key => $item) {
                $filename = substr(md5(microtime() . rand(0, 9999)), 0, 20) . '.' . $item->getExtensionName();
                $item->saveAs($path.$filename);
                return $filename;
            }
        }
        return $name;
    }
    /*
     * Фунция загрузки галереи для произвольного поля
    */
    public function updateMyCustomFieldGallery($count, $gallery = [])
    {
        $images = [];
        $new_images = CUploadedFile::getInstancesByName('MyCustomFieldGallery_'.$count);
        $path = Yii::getPathOfAlias("webroot.uploads.{$this->uploadCustomfieldGallery}").DIRECTORY_SEPARATOR;

        $newgallery = [];
        $new_pos = 1;
        if(empty($gallery)){
            $gallery = [];
        }
        foreach ($gallery as $key => $item) {
            $delete = Yii::app()->getRequest()->getPost('myCustomField-delete-galImage-'.$count.'_'.$key);
            if (!empty($delete)) {
                unlink($path.$item['image']);   
            } else {
                $newgallery[$key] = $item;
                $newgallery[$key]['position'] = $new_pos;
                $new_pos++;
            }
        }

        if (!empty($new_images)) {
            $pos = 1;
            if(count($newgallery) > 0){
                $pos = count($newgallery) + 1;  
            }
            foreach($new_images as $key => $item) {
                $filename = substr(md5(microtime() . rand(0, 9999)), 0, 20) . '.' . $item->getExtensionName();
                $item->saveAs($path.$filename);
                $images[$key]['image'] = $filename;
                $images[$key]['position'] = $pos;
                $pos++;
            }
        }

        if(!empty($newgallery)){
            $images = array_merge($newgallery, $images);
        }

        return $images;
    }

    /*
     * Функция получения значения произвольного поля
    */
    public function getAttributeValue($code)
    {
        $data = [];
        foreach ($this->data as $key => $value) {
            $data[$value['code']] = $value;
        }
        return (!empty($data[$code])) ? $data[$code] : false;
    }

    /*
     * Фунция получения url изображения
    */
    public function getFieldImageUrl($width = 0, $height = 0, $crop = true, $name)
    {
        $file = Yii::getPathOfAlias('webroot')."/uploads/{$this->uploadCustomfield}/{$name}";
        if(file_exists($file)){
            if ($width || $height) {
                return Yii::app()->thumbnailer->thumbnail(
                    $file,
                    $this->uploadCustomfield,
                    $width,
                    $height,
                    $crop
                );
            }

            return "/uploads/{$this->uploadCustomfield}/{$name}";
        }
        return false;
    }
    /*
     * Фунция получения url изображения
    */
    public function getFieldGalImageUrl($width = 0, $height = 0, $crop = true, $name)
    {
        $file = Yii::getPathOfAlias('webroot')."/uploads/{$this->uploadCustomfieldGallery}/{$name}";
        if(file_exists($file)){
            if ($width || $height) {
                return Yii::app()->thumbnailer->thumbnail(
                    $file,
                    $this->uploadCustomfieldGallery,
                    $width,
                    $height,
                    $crop
                );
            }

            return "/uploads/{$this->uploadCustomfieldGallery}/{$name}";
        }
        return false;
    }
    
    /* Преобразование изображения в webp и вовзрат пути до него */
    public function geFieldImageWebp($width = 0, $height = 0, $crop = true, $name)
    {
        // Получаем изображение
        $file = $this->getFieldImageUrl($width, $height, $crop, $name);
        // Получаем массив, где есть путь до папки, имя файла и расширение
        $pathinfo = pathinfo($file);
        // Получаем относительный путь к изображению
        $relativefile = str_replace(Yii::app()->request->getHostInfo(), '', $file);
        // Получаем абсолютный путь до изображения
        $fullpathfile = Yii::getPathOfAlias('webroot').$relativefile;
        // Задаем путь к изображению webp
        $webppath = dirname($fullpathfile).'/'.$pathinfo['filename'].'.webp';

        // В зависимости от расширения, преобразуем изображение в webp
        switch ($pathinfo['extension']) {
            case 'jpeg':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'jpg':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'png':
                $img = imagecreatefrompng($fullpathfile);
                break;
            case 'gif':
                $img = imagecreatefromgif($fullpathfile);
                break;
            case 'JPEG':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'JPG':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'PNG':
                $img = imagecreatefrompng($fullpathfile);
                break;
            case 'gif':
                $img = imagecreatefromgif($fullpathfile);
                break;
        }

        // Проверяем наличие файла, и если его нет - преобразуем в webp
        if(!file_exists($webppath)){
            imagepalettetotruecolor($img);
            imagewebp($img, $webppath, 100);
            //imagedestroy($img);
        }

        // Возвращаем путь к webp изображению
        return dirname($file).'/'.basename($webppath);
    }

    public function geFieldGalImageWebp($width = 0, $height = 0, $crop = true, $name)
    {
        // Получаем изображение
        $file = $this->getFieldGalImageUrl($width, $height, $crop, $name);
        // Получаем массив, где есть путь до папки, имя файла и расширение
        $pathinfo = pathinfo($file);
        // Получаем относительный путь к изображению
        $relativefile = str_replace(Yii::app()->request->getHostInfo(), '', $file);
        // Получаем абсолютный путь до изображения
        $fullpathfile = Yii::getPathOfAlias('webroot').$relativefile;
        // Задаем путь к изображению webp
        $webppath = dirname($fullpathfile).'/'.$pathinfo['filename'].'.webp';

        // В зависимости от расширения, преобразуем изображение в webp
        switch ($pathinfo['extension']) {
            case 'jpeg':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'jpg':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'png':
                $img = imagecreatefrompng($fullpathfile);
                break;
            case 'gif':
                $img = imagecreatefromgif($fullpathfile);
                break;
            case 'JPEG':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'JPG':
                $img = imagecreatefromjpeg($fullpathfile);
                break;
            case 'PNG':
                $img = imagecreatefrompng($fullpathfile);
                break;
            case 'gif':
                $img = imagecreatefromgif($fullpathfile);
                break;
        }

        // Проверяем наличие файла, и если его нет - преобразуем в webp
        if(!file_exists($webppath)){
            imagepalettetotruecolor($img);
            imagewebp($img, $webppath, 100);
            //imagedestroy($img);
        }

        // Возвращаем путь к webp изображению
        return dirname($file).'/'.basename($webppath);
    }
    /*********************************
    *************** END **************
    *********************************/
}
