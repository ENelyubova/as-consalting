<?php

/**
 * This is the model class for table "{{video}}".
 *
 * The followings are the available columns in table '{{video}}':
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $status
 * @property string $desc
 */

// Yii::import('application.modules.page.models.*');

class Video extends \yupe\models\YModel
{
	const STATUS_PUBLIC = 1;
	const STATUS_MODERATE = 0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{video}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('video', 'required'),
			array('status, position, category_id', 'numerical', 'integerOnly'=>true),
			array('name, image, video', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, code, image, status, position, category_id, video, desc', 'safe', 'on'=>'search'),
			array('id, name, code, image, status, position, category_id, video, desc', 'safe'),
		);
	}

	public function behaviors()
    {
        $module = Yii::app()->getModule('video');
		return [
			'imageUpload' => [
                'class'         => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'minSize'       => $module->minSize,
                'maxSize'       => $module->maxSize,
                'types'         => $module->allowedExtensions,
                'uploadPath'    => $module->uploadPath,
            ],
            'videoUpload' => [
                'class'         => 'yupe\components\behaviors\FileUploadBehavior',
                'attributeName' => 'video',
                'minSize'       => $module->minSize,
                'maxSize'       => $module->maxSize,
                'types'         => 'mp4',
                'uploadPath'    => $module->uploadPath,
                'deleteFileKey' => 'delete-file2'
            ],
			'sortable' => [
                'class' => 'yupe\components\behaviors\SortableBehavior',
            ],
        ];
    }
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'category' => [self::BELONGS_TO, 'Page', ['category_id' => 'id']],
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'       => 'ID',
			'name'     => 'Название',
			'code'     => 'Код видео',
			'image'    => 'Изображение(миниатюра)',
			'status'   => 'Статус',
			'position' => 'Сортировка',
			'category_id' => 'Категория',
			'video' => 'Видео',
			'desc' => 'Текст',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('position',$this->position);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('video',$this->video);
		$criteria->compare('desc',$this->desc);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => ['defaultOrder' => 't.position DESC'],
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Video the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getStatusList()
	{
		return [
			self::STATUS_PUBLIC   => 'Опубликован',
			self::STATUS_MODERATE => 'На модерации',
		];
	}

	public function getStatusName()
	{
		$data = $this->getStatusList();
		if (isset($data[$this->status])) {
			return $data[$this->status];
		}
		return null;
	}
	public function scopes()
    {
        return [
            'published' => [
                'condition' => 'status  = :status',
                'params' => [
                    ':status' => self::STATUS_PUBLIC
                ]
            ],
        ];
    }

    public function getCategoryList()
	{

		return CHtml::listData($this->getFormattedList(), 'id', 'title');
	}

	public function getFormattedList($parentId = null, $level = 0, $criteria = null)
    {
        if (empty($parentId)) {
            $parentId = null;
        }

        $models = Page::model()->findAllByAttributes(['parent_id' => $parentId], $criteria);
        
        $list = [];

        foreach ($models as $model) {

            $model->title = str_repeat('&emsp;', $level) . $model->title;

            $list[$model->id]['id'] = $model->id;
            $list[$model->id]['title'] = $model->title;

            $list = CMap::mergeArray($list, $this->getFormattedList($model->id, $level + 1, $criteria));
        }

        return $list;
    }

    public function getVideoUrl()
    {
        $module = Yii::app()->getModule('video');

        return '/uploads/'.$module->uploadPath . '/' . $this->video;
    }
}
