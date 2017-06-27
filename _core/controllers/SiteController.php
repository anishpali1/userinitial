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

class SiteController extends Controller {

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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())) {

            $model->created_date = date('Y-m-d H:i:s');
            $model->access_token = UserHelper::generateAccessToken();
            $model->user_status = 'ACTIVE';
            $hash = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $model->password = $hash;



            if ($model->save()) {

                $user = \app\models\User::findByEmail($model->email);
                Yii::$app->session->setFlash('success', 'Your account has been created successfully.');

                //Send register email
                $api_input_data = array('method' => 'registerEmail', 'id' => $user->id);
//                Yii::$app->helper->apiRequest($api_input_data);
                return $this->goHome();
            } else {
                $model->password = "";
                Yii::$app->session->setFlash('danger', 'Sorry, we are unable to create your account right now. Please varify the provided information. ');
//                return $this->render('index', ['model' => $model]);
            }
        }

        return $this->render('index', ['model' => $model]);



//        return $this->render('index');
    }

    public function actionNopage() {
        return $this->render('nopage');
    }

    //verify email after customer registration. This will be initiated from verification email.
    public function actionEmailverification() {
        if (Yii::$app->request->get('id') && Yii::$app->request->get('key')) {

            $access_token = Yii::$app->request->get('id');
            $key = Yii::$app->request->get('key');

            $customers = \app\models\Customers::find()
                    ->leftjoin('user_token', 'user_token.user_id=users.id')
                    ->where(['access_token' => $access_token])
                    ->andWhere(['token' => $key])
                    ->one();


            if (count($customers)) {

                $customers->profile_status = 'ACTIVE';
                $customers->save();
                $user_token = \app\models\UserToken::find()
                        ->where(['token' => $key])
                        ->andWhere(['user_id' => $customers->id])
                        ->one();
                $user_token->delete();
                Yii::$app->session->setFlash('success', 'Your account verified successfully.');
                \app\components\EmailHelper::welcomeEmail($customers->id);
            } else {
                Yii::$app->session->setFlash('danger', 'Illegal attempt1.');
            }
        } else {
            Yii::$app->session->setFlash('danger', 'Illegal attempt2.');
        }
        return $this->render('emailverification');
    }

}
