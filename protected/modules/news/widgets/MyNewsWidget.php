<?php

/**
 * Виджет вывода последних новостей
 * **/
Yii::import('application.modules.news.models.*');

class MyNewsWidget extends yupe\widgets\YWidget
{
    /** @var $categories mixed Список категорий, из которых выбирать новости. NULL - все */

    public $view = 'view';
    public $view2 = 'view2';
    
    public $category_id;
    public $limit = 10;

    public $all = false;

    public $notIds;

    public function init()
    {

        parent::init();
    }

    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'date DESC';
        $criteria->limit = $this->limit;
        
        if($this->category_id){
            $criteria->addCondition("category_id = {$this->category_id}");
        }

        if($this->notIds){
            $this->notIds = explode(',', $this->notIds);
            $criteria->addNotInCondition('id', $this->notIds);
        }

        if($this->all) {
            $dataProvider = new CActiveDataProvider('News', [
                'criteria' => $criteria,
                'pagination' => [
                    'pageSize' => $this->limit
                ]
            ]);
            $this->render($this->view2, ['dataProvider' => $dataProvider]);
        } else{
            $news = News::model()->published()->findAll($criteria);
            $this->render($this->view, ['models' => $news]);
        }
    }
}
