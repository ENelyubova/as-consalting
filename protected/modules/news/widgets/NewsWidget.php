<?php

/**
 * Виджет вывода последних новостей
 *
 * @category YupeWidget
 * @package  yupe.modules.news.widgets
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3
 * @link     https://yupe.ru
 *
 **/
Yii::import('application.modules.news.models.*');

/**
 * Class NewsWidget
 */
class NewsWidget extends yupe\widgets\YWidget
{
    /** @var $categories mixed Список категорий, из которых выбирать новости. NULL - все */
    public $categories = null;
    public $limit;
    public $buttonText;

    /**
     * @var string
     */
    public $view = 'lastnewswidget';

    /**
     * @throws CException
     */
    public function run()
    {
        $criteria = new CDbCriteria();
        
        // $criteria->order = 'position DESC';
        
        if ($this->categories) {
            if (is_array($this->categories)) {
                $criteria->addInCondition('category_id', $this->categories);
            } else {
                $criteria->compare('category_id', $this->categories);
            }
        }

        $dataProvider = new CActiveDataProvider('News', [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => $this->limit,
            ],
        ]);

        $this->render($this->view, [
            'dataProvider' => $dataProvider,
            'categories' => $this->categories,
        ]);
    }
}
