<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * RegisterForm is the model behind the register form.
 *
 * @property string $full_name
 * @property string $dob 
 * @property string $email
 * @property string $password
 * @property string $user_type
 * @property string $timezone
 * @property string $profile_picture
 * @property string $user_status
 * @property string $profile_status
 * 
 * 
 * @property User|null $user This property is read-only.
 *
 */
class AdminProfileForm extends \yii\db\ActiveRecord {
   
    public $imageFile;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['full_name', 'email','timezone'], 'required'],
            [['user_type','user_status', 'profile_status'], 'string'],
            [['full_name', 'email', 'password'], 'string', 'max' => 200],
//            [['imageFile'], 'file', 'extensions' => 'png, jpg'], 
            ['imageFile', 'image','skipOnEmpty' => true, 'minWidth' =>50, 'maxWidth' => 160,'minHeight' => 50, 'maxHeight' => 160, 'extensions' => 'jpg,png', 'maxSize' => 256 * 1024],
        ];
    }

    public static function tableName() {
        return 'users';
    }

//    public static function getProfileDetails($userid) {
//        $user = self::find()->where(["id" => $userid, 'profile_status' => 'ACTIVE'])->one();
//        if (!count($user)) {
//            return null;
//        }
//        return new static($user);
//    }   
  
    
}
