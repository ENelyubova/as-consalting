<?php
Yii::import('application.modules.mail.MailModule');
/**
 * Форма Статус заказа
 */
class OrderStatusFormModal extends CFormModel
{
    public $code;
    public $verify;
    public $verifyCode;

    public function rules()
    {
        return [
            ['code', 'required'],
            ['verify, body', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'code'   => Yii::t('MailModule.mail', 'Номер заказа'),
            'verify' => Yii::t('MailModule.mail', 'Verify'),
        ];
    }

    public function beforeValidate(){
        if ($_POST['g-recaptcha-response']=='') {
            $this->addError('verifyCode', Yii::t('MailModule.mail', 'Пройдите проверку reCAPTCHA..'));
        } else {
            $ip = CHttpRequest::getUserHostAddress();
            $post = [
                'secret' => Yii::app()->params['secretkey'],
                'response' => $_POST['g-recaptcha-response'],
                'remoteip' => $ip,
            ];

            $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $response = curl_exec($ch);
            curl_close($ch);

            $response = CJSON::decode($response);
            if (isset($response['success']) and isset($response['error-codes']) and $response['success']===false) {
                $this->addError('verifyCode', implode(', ', $response['error-codes']));
            }
        }
        return parent::beforeValidate();
    }
    
    public function afterValidate()
    {
        if (empty($this->getErrors())) {
            // Yii::app()->mailMessage->raiseMailEvent('vyzvat-mastera', $this->getAttributes());
        }
        return parent::afterValidate();
    }
}
?>