<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\RegisterForm;
use app\components\UserHelper;

//use app\models\LoginForm;
//use app\models\ContactForm;

class TestController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                        [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

   public function actionTimetest() {



        echo date('Y-m-d H:i:s') . "<br><br>";

//        echo 'user time zone:' . Yii::$app->user->identity->timezone . "<br>";
        echo "<br>";
         echo Yii::$app->formatter->asTime('now Asia/Kolkata', 'php:Y-m-d H:i:s');
echo "<br>";
//        echo $DBTIME = Yii::$app->formatter->asTime('now' . ' ' . Yii::$app->user->identity->timezone, 'php:Y-m-d H:i:s');
//        echo "<br><br><br>" . Yii::$app->formatter->asTime($DBTIME, 'php:Y-m-d H:i:s');

//                $tzlist = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
//                print_r($tzlist);

        die();
    }

   

}
