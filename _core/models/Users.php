<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $full_name
 * @property string $password
 * @property string $profile_picture
 * @property string $dob
 * @property string $access_token
 * @property string $fb_token
 * @property string $user_type
 * @property string $user_status
 * @property string $profile_status
 * @property string $created_date
 * @property string $modified_date
 *
 * @property Webservice[] $webservices
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'full_name', 'created_date'], 'required'],
            [['dob', 'created_date', 'modified_date'], 'safe'],
            [['user_type', 'user_status', 'profile_status'], 'string'],
            [['email', 'full_name', 'password', 'profile_picture', 'access_token', 'fb_token'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'full_name' => 'Full Name',
            'password' => 'Password',
            'profile_picture' => 'Profile Picture',
            'dob' => 'Dob',
            'access_token' => 'Access Token',
            'fb_token' => 'Fb Token',
            'user_type' => 'User Type',
            'user_status' => 'User Status',
            'profile_status' => 'Profile Status',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebservices()
    {
        return $this->hasMany(Webservice::className(), ['user_id' => 'id']);
    }
}
