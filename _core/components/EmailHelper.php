<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use Yii;

//use yii\base\Component;
//use yii\base\InvalidConfigException;

//This Helper handles all the mail specific configurations.
class EmailHelper {

    public static function forgotPasswordEmail($userid, $newpassword) {

        $user_info = \app\models\Users::find()->where('id=:query')
                ->addParams([':query' => $userid])
                ->asArray()
                ->one();
        $view = 'forgotpassword';
        $subject = "Forgot Password- Legacy";

        try {

            Yii::$app->mailer->compose($view, ["user_info" => $user_info, "newpassword" => $newpassword])
                    ->setFrom(Yii::$app->params['supportEmail'])
                    ->setTo($user_info['email'])
                    ->setSubject($subject)
                    ->send();
            return true;
        } catch (\Swift_SwiftException $e) {
//            print_r($e->getMessage());
        }
    }

    public function emailVerificationEmail($userid, $activation_url) {

        $user_info = \app\models\Users::find()->where('id=:query')
                ->addParams([':query' => $userid])
                ->asArray()
                ->one();

        $view = 'email_varification';

        try {

            Yii::$app->mailer->compose($view, ["user_info" => $user_info, 'activation_url' => $activation_url])
                    ->setFrom(Yii::$app->params['supportEmail'])
                    ->setTo($user_info['email'])
                    ->setSubject('Email Verification')
                    ->send();
            return true;
        } catch (\Swift_SwiftException $e) {
            
        }
    }

    public function welcomeEmail($userid) {

        $user_info = \app\models\Users::find()->where('id=:query')
                ->addParams([':query' => $userid])
                ->asArray()
                ->one();

        $view = 'welcome';

        try {

            Yii::$app->mailer->compose($view, ["user_info" => $user_info])
                    ->setFrom(Yii::$app->params['supportEmail'])
                    ->setTo($user_info['email'])
                    ->setSubject('Welcome to Legacy')
                    ->send();
            return true;
        } catch (\Swift_SwiftException $e) {
            
        }
    }
    
    public function changePasswordEmail($userid, $newpassword) {

        $user_info = \app\models\Users::find()->where('id=:query')
                ->addParams([':query' => $userid])
                ->asArray()
                ->one();

        $view = 'changepassword';

        try {
//echo "fg";
            Yii::$app->mailer->compose($view, ["user_info" => $user_info, "newpassword" => $newpassword])
                    ->setFrom(Yii::$app->params['supportEmail'])
                    ->setTo($user_info['email'])
                    ->setSubject('Your Password Changed')
                    ->send();
            return true;
        } catch (\Swift_SwiftException $e) {
            
        }
    }

}
