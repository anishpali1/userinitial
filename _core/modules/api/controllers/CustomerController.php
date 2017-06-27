<?php

namespace app\modules\api\controllers;

use Yii;
use app\components\UserHelper;
use app\components\GeneralHelper;

//use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class CustomerController extends ApiAbstractController {

    /**
     * Renders the index view for the module
     * @return string
     */
    public $customer;

    public function init() {
        parent::init();
        //verifies every request to this controller is from a valid customer who has a valid token id.
        UserHelper::verifyRequestCustomer();
    }

    public function actionIndex() {
//          print_r($this->customer);
    }

    //Change customer password if his profile is active and he is alive(user_status='ACTIVE')

    public function actionChangepassword() {
        try{
        $post_data = Yii::$app->request->post();
        //trim all post data
        $post_sanitized = GeneralHelper::sanitize($post_data);
        $user_id = $this->customer['user_id'];
        $oldpassword = $post_sanitized['oldpassword'];
        $newpassword = $post_sanitized['newpassword'];

        $changepassword = \app\models\Customers::findOne(['id' => $user_id, 'user_type' => 'CUSTOMER', 'user_status' => 'ACTIVE', 'profile_status' => 'ACTIVE']);
        $valid = Yii::$app->getSecurity()->validatePassword($oldpassword, $changepassword['password']);
        
        if ($valid > 0) {
            $hash = Yii::$app->getSecurity()->generatePasswordHash($newpassword);
            $changepassword->password = $hash;
            $changepassword->save();
            $message = ['status' => 'success'];
            
             //Sending email in background
            $background_data = array(array(
                    'url' => Yii::$app->urlManager->createAbsoluteUrl('api/background/sendemail'),
                    'post' => array(
                        'name' => 'changepassword',
                        'userid' => $user_id,
                        'newpassword' => $newpassword
                    )
            ));
            GeneralHelper::multiRequest($background_data);
            
            
            return json_encode($message);
        } else {
            $message = ['status' => 'failed', 'message' => 'Old password is wrong.'];
            return json_encode($message);
        }
        } catch (ErrorException $ex) {
            $message = ['status' => 'failed',
                'exception_message' => $ex->getMessage(),
                'file_name' => $ex->getFile(),
                'line_no' => $ex->getLine()];
            return $message;
        }
    }
    
    public function actionMyprofile() {
        try{
        $post_data = Yii::$app->request->post();
        //trim all post data
        $post_sanitized = GeneralHelper::sanitize($post_data);
        $user_id = $this->customer['user_id'];
        $customer = \app\models\Customers::find()->select(['id','email','full_name','profile_picture'])
                ->where(['id' => $user_id])->asArray()->one();
        if(count($customer)>0){
             $message = ['status' => 'success', 'customerdetails' => $customer];
            return json_encode($message);
        }else{
           $message = ['status' => 'failed', 'message' => 'Profile data not available.'];
            return json_encode($message); 
        }
        print_r($customer);
        
        }catch (ErrorException $ex) {
            $message = ['status' => 'failed',
                'exception_message' => $ex->getMessage(),
                'file_name' => $ex->getFile(),
                'line_no' => $ex->getLine()];
            return $message;
        }
        
    }

}
