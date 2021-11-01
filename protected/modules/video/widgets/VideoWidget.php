<?php

Yii::import('application.modules.video.models.Video');

class VideoWidget extends yupe\widgets\YWidget
{
    public $limit = 5;
    /**
     * @var string
     */
    public $category_id;
    public $id;
    public $view = 'video';

    protected $models;

    public function init()
    {
        if($this->id){
            $this->models = Video::model()->published()->findByPk($this->id);
        } else {
            $criteria = new CDbCriteria();
            $criteria->limit = $this->limit;
            $criteria->order = 't.position ASC';

            $criteria->compare('category_id', $this->category_id);

            $this->models = Video::model()->published()->findAll($criteria);
        }
        parent::init();
    }

    public function run()
    {
        
        $this->render($this->view, [
            'models' => $this->models
        ]);
    }
}
