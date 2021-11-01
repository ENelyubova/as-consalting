<?php
/**
 * CustomFieldWidget виджет для вывода страниц
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.page.widgets
 * @since 0.1
 *
 */

Yii::import('application.modules.gallery.models.*');

class CustomFieldWidget extends yupe\widgets\YWidget
{
    /**
     * Вьюха
     * @var string
     */
    public $module = 'page';
    public $id = null;
    public $code = null;
    public $class;
    public $fancybox = false;
    public $view = 'gallery-customfield';

    protected $model;

    public function init()
    {
        if ($this->module == 'news') {
            $this->model = News::model()->published()->findByPk($this->id);
        }else if ($this->module == 'store') {
            $this->model = Store::model()->published()->findByPk($this->id);
        }else {
            $this->model = Page::model()->published()->findByPk($this->id);
        }
        
        parent::init();
    }

    public function run()
    {
        if ($this->model===null) {
            echo '';
        } else {
            $this->render($this->view, [
                'model' => $this->model,
                'code'   => $this->code,
                'class'   => $this->class,
                'fancybox'   => $this->fancybox,
            ]);
        }
    }
}