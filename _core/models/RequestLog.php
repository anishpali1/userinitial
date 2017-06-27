<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_log".
 *
 * @property integer $id
 * @property string $action_path
 * @property string $get_data
 * @property string $post_data
 * @property string $return_data
 * @property string $request_time
 * @property string $return_time
 */
class RequestLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['get_data', 'post_data', 'return_data'], 'string'],
            [['request_time', 'return_time'], 'safe'],
            [['action_path'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'action_path' => 'Action Path',
            'get_data' => 'Get Data',
            'post_data' => 'Post Data',
            'return_data' => 'Return Data',
            'request_time' => 'Request Time',
            'return_time' => 'Return Time',
        ];
    }
}
