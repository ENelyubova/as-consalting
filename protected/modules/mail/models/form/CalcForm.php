<?php
Yii::import('application.modules.mail.MailModule');
/**
 * Форма заказать звонок
 */
class CalcForm extends CFormModel
{
    public $name;
    public $phone;
    public $email;
    public $verify;
    public $verifyCode;
    
    public $resultCalc;
    public $bodyLetter;

    public function rules()
    {
        return [
            ['name, phone, email', 'required'],
            ['email', 'email'],
            ['verify, resultCalc, bodyLetter', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'   => Yii::t('MailModule.mail', 'Ф.И.О.'),
            'phone'  => Yii::t('MailModule.mail', 'Ваш телефон'),
            'email'   => Yii::t('MailModule.mail', 'E-mail'),
            'verify' => Yii::t('MailModule.mail', 'Verify'),
            'resultCalc' => Yii::t('MailModule.mail', 'Result calc form'),
            'bodyLetter' => Yii::t('MailModule.mail', 'Body letter'),
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
    
    public function afterValidate(){
        if (empty($this->getErrors())) {
            Yii::app()->mailMessage->raiseMailEvent('quiz-calc', $this->getAttributes());
        }
        return parent::afterValidate();
    }
}
?>

