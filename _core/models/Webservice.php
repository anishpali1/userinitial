<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "webservice".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $device_type
 * @property string $device_token
 * @property string $push_token
 * @property string $access_token
 * @property string $login_status
 * @property string $status
 * @property string $created_date
 * @property string $modified_date
 *
 * @property Users $user
 */
class Webservice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'webservice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'device_type', 'device_token', 'push_token', 'created_date'], 'required'],
            [['user_id'], 'integer'],
            [['device_type', 'login_status', 'status'], 'string'],
            [['created_date', 'modified_date'], 'safe'],
            [['device_token', 'push_token', 'access_token'], 'string', 'max' => 200],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'device_type' => 'Device Type',
            'device_token' => 'Device Token',
            'push_token' => 'Push Token',
            'access_token' => 'Access Token',
            'login_status' => 'Login Status',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
