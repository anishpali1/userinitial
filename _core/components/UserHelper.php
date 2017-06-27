<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\components;
 
 
use Yii;
//use yii\base\Component;
//namespace common\components;
 
class UserHelper 
{
   
    public static function generateAccessToken()
    {
        mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
                    $charid = strtoupper(md5(uniqid(rand(), true)));
             $access_token = substr($charid, 0, 8)
                            . substr($charid, 8, 4)
                            . substr($charid, 12, 4)
                            . substr($charid, 16, 4)
                            . substr($charid, 20, 12);
                    return $access_token;
    }
    
       
    
    /*
     * password genertor for email
     */
    public function getRandomPassword($length = '6') {
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $max = strlen($str);
        $length = @round($length);
        if (empty($length)) {
            $length = rand(4, 12);
        }
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password.=$str{rand(0, $max - 1)};
        }
        return $password;
    }
    
    //verifies every request to this controller is from a valid customer who has a valid token id.
    
    public function verifyRequestCustomer(){
        $post_data = Yii::$app->request->post();
        $access_token = trim($post_data['access_token']);
        $userAllowed = \app\models\Customers::find()->where(['access_token' => $access_token, 'user_type' => 'CUSTOMER', 'profile_status' => 'ACTIVE'])->asArray()->one();

        $webservice = \app\models\Webservice::find()->where(['access_token' => $access_token, 'login_status' => 'LoggedIn', 'status' => 'ACTIVE'])->asArray()->one();
        if (empty($userAllowed)) {
            $message = ['status' => 'failed', 'message' => 'Access Denied!'];
            echo json_encode($message);
            Yii::$app->end();
        }
        if (empty($webservice)) {
            $message = ['status' => 'failed', 'message' => 'Access Denied!'];
            echo json_encode($message);
            Yii::$app->end();
        } else {
            $this->customer = $webservice;
        }
    }
    
   
    
    
}
