<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\User;

/**
 * Default controller for the `admin` module
 */
class AdminAbstractController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['logout'],
                'rules' => [
                        [//Actions to access without login 
                        'actions' => ['login', 'register', 'auth', 'error'],
                        'allow' => true,
                    ],
                        [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->email);
                        }
                    ],
                        [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function($rule, $action) {                           
                    // return $this->goHome();
                    $this->redirect('/admin/login');
                },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    
    public function init() {
        parent::init();
        $this->layout = "main";
//         $this->layout = false;
    }
}
