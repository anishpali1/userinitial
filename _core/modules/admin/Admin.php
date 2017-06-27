<?php

namespace app\modules\admin;

use Yii;
/**
 * admin module definition class
 */
class Admin extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::$app->setHomeUrl('/admin');
        // custom initialization code goes here
    }
}
