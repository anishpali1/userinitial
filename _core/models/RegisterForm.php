<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * RegisterForm is the model behind the register form.
 *
 * @property string $full_name
 * @property string $email
 * @property string $password
 * @property string $access_token
 * @property string $profile_status
 * @property string $user_status
 * @property string $created_date
 * 
 * 
 *
 */ 
class RegisterForm extends \yii\db\ActiveRecord
{    
    public $password_repeat;
    public $user_type='CUSTOMER';
    /**
     * @return array the validation rules.
     */
    
    public function rules()
    {
        return [         
            [['full_name','email', 'password','password_repeat'], 'required'],
            [['user_type', 'profile_status', 'user_status'], 'string'],
            [['full_name','email','password','access_token'], 'string', 'max' => 200],
//            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
            [['created_date'], 'safe'],            
            ['email', 'email'],
            [['email'], 'unique', 'targetAttribute' => ['email','user_type'],"message"=>'Email Already exists!'],
            [['access_token'], 'unique'],
            
        ];
    }
    
    public static function tableName() { return 'users'; }    
}
