<?php

namespace app\modules\api\controllers;

use Yii;
use app\components\EmailHelper;
use yii\web\Controller;

/**
 * This controller handles API requests from same system .
 */
class BackgroundController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    //Disable CSRF for the API to work
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    //This handles sending emails when requests comes as API request. 
    //This helps avoid the delay in sending emails from apps main API.(eg: forgotpassword email)
    //The Curl request to this method doesnt wait  to get a result. Thus the waiting time to send email for the Main API is avoided. 

    public function actionSendemail() {

        $post_data = Yii::$app->request->post();
        if (!empty($post_data)) {
            extract($post_data);
        }
        switch ($name) {
            case 'welcome':
                EmailHelper::welcomeEmail($userid);
                break;
            case 'emailverification':
                EmailHelper::emailVerificationEmail($userid, $activation_url);
                break;
            case 'forgotpassword':
                EmailHelper::forgotPasswordEmail($userid, $newpassword);
                break;
             case 'changepassword':
                EmailHelper::changePasswordEmail($userid, $newpassword);
                break;
        }
    }

}
