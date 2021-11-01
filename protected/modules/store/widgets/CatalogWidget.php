<?php

Yii::import('application.modules.store.models.*');

class CatalogWidget extends yupe\widgets\YWidget
{   
    public $category_id = null;
    public $tags = 0;
    public $limit;
    public $id;
    
    public $view = 'view';
    protected $category;

    public function run()
    {
        $criteria = new CDbCriteria();

        if($this->limit){
            $criteria->limit = $this->limit;
        }
        
        $criteria->order = 't.sort ASC';
        
        // $criteria->compare('t.tags', $this->tags);
        if($this->id){
            $this->category = StoreCategory::model()->published()->findByPk($this->id);
        }
        else if($this->category_id){
            $criteria->compare('parent_id', $this->category_id);
            $this->category = StoreCategory::model()->published()->findAll($criteria);
        } else{
            $this->category = StoreCategory::model()->published()->roots()->findAll($criteria);
        }
        
        $this->render($this->view, [
            'category' => $this->category
        ]);
    }
}