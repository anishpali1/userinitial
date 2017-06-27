<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Users;
use yii\web\Controller;
use app\models\AdminLoginForm;
use app\components\UserHelper;
use app\components\EmailHelper;
/**
 * Default controller for the `admin` module
 */
class LoginController extends Controller
{
    public function init() {
        parent::init();
        $this->layout = 'main-login';
    }
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect( array('/admin'));
        }
        

        $model = new AdminLoginForm();
       
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            return $this->redirect( array('/admin/dashboard'));
            
        }
        return $this->render('index', [
            'model' => $model,
        ]);
        
    }
    
    
    /*
     * Logout the user
     */
    public function actionForgotPassword() {
        $post_data = Yii::$app->request->post();
        $email = trim($post_data['AdminLoginForm']['email']);
        $user_info = \app\models\User::findOne(['email' => $email, 'user_type' => 'ADMIN', 'profile_status' => 'ACTIVE']);
        if (empty($user_info)) {
            Yii::$app->session->setFlash('danger', 'Seems like you have not registered to our system.');
            return $this->redirect(['/admin/login/']);
        } else {
            $user_details = \app\models\Users::findOne($user_info->id);
            $newpassword = UserHelper::getRandomPassword();
            $hash = Yii::$app->getSecurity()->generatePasswordHash($newpassword);
            $user_details->password = $hash;
            $user_details->save();
            EmailHelper::forgotPasswordEmail($user_info->id, $newpassword);

            Yii::$app->session->setFlash('success', 'New password has been sent to your email address.');
            return $this->redirect(['/admin/login/']);
        }
    }
    
    public function actionPassword(){
        Yii::$app->getSecurity()->generatePasswordHash("12345");
    } 
}
