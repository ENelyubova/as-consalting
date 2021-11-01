<?php
/**
 * OrderRepairWidget виджет формы "Заказать ремонт"
 */
Yii::import('application.modules.mail.models.form.OrderRepairForm');

class OrderRepairWidget extends yupe\widgets\YWidget
{
    public $view = 'order-repair-widget';

    /**
     * @throws CException
     */
    public function init() {
        $mainAssets = Yii::app()->getTheme()->getAssetsUrl();

        // Yii::app()->getClientScript()->registerCssFile($mainAssets . '/ion.rangeSlider/css/ion.rangeSlider.min.css');
        Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/jquery.event.move.min.js', CClientScript::POS_END);
        Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/jquery.twentytwenty.min.js', CClientScript::POS_END);
    }
    public function run()
    {
        $model = new OrderRepairForm;
        if (isset($_POST['OrderRepairForm'])) {
            $model->attributes = $_POST['OrderRepairForm'];
            if($model->verify == ''){
                if ($model->validate()) {
                    Yii::app()->user->setFlash('order-repair-success', Yii::t('MailModule.mail', 'Ваша заявка успешно отправлена.'));
                    Yii::app()->controller->refresh();
                }
            }
        }      

        $this->render($this->view, [
            'model' => $model,
        ]);
    }

}
