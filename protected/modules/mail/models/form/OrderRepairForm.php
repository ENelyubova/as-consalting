<?php
Yii::import('application.modules.mail.MailModule');
/**
 * Форма заказать ремонт
 */
class OrderRepairForm extends CFormModel
{
    public $name;
    public $phone;
    public $email;
    public $text;
    public $verify;
    public $verifyCode;

    public function rules()
    {
        return [
            ['name, phone', 'required'],
            ['email', 'email'],
            ['verify, text', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'   => Yii::t('MailModule.mail', 'Ваше имя'),
            'phone'  => Yii::t('MailModule.mail', 'Ваш телефон'),
            'email'   => Yii::t('MailModule.mail', 'E-mail'),
            'text'   => Yii::t('MailModule.mail', 'Ваш вопрос'),
            'verify' => Yii::t('MailModule.mail', 'Verify'),
        ];
    }

    public function beforeValidate(){
        if ($_POST['g-recaptcha-response']=='') {
            $this->addError('verifyCode', Yii::t('MailModule.mail', 'Пройдите проверку reCAPTCHA..'));
        } else {
            //$ip = CHttpRequest::getUserHostAddress();
            $post = [
                'secret' => Yii::app()->params['secretkey'],
                'response' => $_POST['g-recaptcha-response'],
                //'remoteip' => $ip,
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
        if (!$this->hasErrors()){
            Yii::app()->mailMessage->raiseMailEvent('zadat-vopros', $this->getAttributes());
        }
        return parent::afterValidate();
    }
}
?>