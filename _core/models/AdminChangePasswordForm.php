<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * RegisterForm is the model behind the register form.
 *
 * @property integer $id
 * @property string $password
 * 
 * 
 * 
 * @property User|null $user This property is read-only.
 *
 */
class AdminChangePasswordForm extends \yii\db\ActiveRecord {

    public $currentpass;
    public $newpass;
    public $repeatnewpass;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
                [['currentpass', 'newpass', 'repeatnewpass'], 'required'],
                [['currentpass', 'newpass', 'repeatnewpass'], 'string', 'min' => 5],
                ['currentpass', 'findPasswords'],
                ['repeatnewpass', 'compare', 'compareAttribute' => 'newpass'],
        ];
    }

    public static function tableName() {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'currentpass' => 'Current Password',
            'newpass' => 'New Password',
            'repeatnewpass' => 'Re-type New Password',
        ];
    }

    public function findPasswords($attribute, $params) {

        $user = Users::find()->where([
                    'id' => Yii::$app->user->identity->id
                ])->one();
        $password = $user->password;
        $valid = Yii::$app->getSecurity()->validatePassword($this->currentpass, $password);
        if (!$valid) {
            $this->addError($attribute, 'Current password is incorrect');
        }
    }

}
