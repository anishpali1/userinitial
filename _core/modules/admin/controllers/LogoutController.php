<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\AdminLoginForm;
use app\models\User;

class LogoutController extends \yii\web\Controller
{
    public function init() {
        parent::init();
        $this->layout = false;
    }
    public function actionIndex() {
    
        Yii::$app->user->logout();

        return $this->redirect(['/admin/login']);
    
    }
    
   
    
      

}
