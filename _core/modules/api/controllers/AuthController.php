<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
//use app\models\RegisterForm;
use app\models\Customers;
use yii\base\Security;
use app\components\GeneralHelper;
use app\components\UserHelper;
use app\models\Webservice;
use app\components\EmailHelper;

/**
 * Default controller for the `api` module.
 * This controller handles all the initial user related APIs.
 * All this API's will be used for user actions where user is not logged in already. 
 */
class AuthController extends ApiAbstractController {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionRegister() {
        try {
            $post_data = Yii::$app->request->post();

            //trim all post data
            $post_sanitized = GeneralHelper::sanitize($post_data);

            if (!empty($post_sanitized['email'])) {

                //check whether email exixts in DB

                $email = $post_sanitized['email'];
                $email_already_reg = Customers::find()->where(['email' => $email, 'user_type' => 'CUSTOMER'])->count();
                if ($email_already_reg > 0) {
                    $message = ['status' => 'failed', 'message' => 'Already registered with this email.'];
                    return json_encode($message);
                }

                //Register customer

                $customer_model = new Customers();
                $customer_model->email = $post_sanitized['email'];
                $customer_model->full_name = $post_sanitized['full_name'];
                $customer_model->password = Yii::$app->getSecurity()->generatePasswordHash($post_sanitized['password']);

                $customer_model->created_date = Yii::$app->formatter->asTime('now', 'php:Y-m-d H:i:s');
                $customer_model->timezone = $post_sanitized['timezone'];
//                $customer_model->created_date = date('Y-m-d H:i:s');
                $customer_model->access_token = UserHelper::generateAccessToken();
                $customer_model->user_type = 'CUSTOMER';
                $customer_model->user_status = 'ACTIVE';
                $customer_model->save();


                if (!empty($customer_model->id)) {

                    //Set device details

                    $device_token = trim($post_sanitized['device_token']);
                    if (!empty($post_data['push_token'])) {
                        $push_token = trim($post_sanitized['push_token']);
                    } else {
                        $push_token = "PushTokenNotRecieved"; //To Avoid Push error in IOS
                    }


                    //creating email verification token . this will be sent to users email.Only after he clicks and validate the 
                    //email, he will be able to login to the app.

                    $token_model = new \app\models\UserToken();
                    $token_model->token = sha1(mt_rand(10000, 99999) . time() . $customer_model->email);
                    $token_model->user_id = $customer_model->id;
                    $token_model->created_date = $customer_model->created_date;
                    $token_model->save();

                    $activation_url = Yii::$app->urlManager->createAbsoluteUrl("emailverification?id=" . $customer_model->access_token . "&key=" . $token_model->token);

                    $access_token = $customer_model->access_token;
                    $user_details = array('id' => $customer_model->id, 'full_name' => $customer_model->full_name, 'email' => $customer_model->email);
                    $message = ['status' => 'success', 'message' => 'Registration Successful.', 'access_token' => $access_token, 'user_details' => $user_details];

                    $this->adddeviceinfo($post_sanitized, $customer_model->access_token, $customer_model->id, 'LoggedOut');
//                EmailHelper::emailVerificationEmail($customer_model->id, $activation_url);
//                
                    //Sending email in the background

                    $background_data = array(array(
                            'url' => Yii::$app->urlManager->createAbsoluteUrl('api/background/sendemail'),
                            'post' => array(
                                'name' => 'emailverification',
                                'userid' => $customer_model->id,
                                'activation_url' => $activation_url,
                            )
                    ));
                    GeneralHelper::multiRequest($background_data);
                } else {
                    $message = ['status' => 'failed', 'message' => 'Sorry Something went wrong.'];
                }
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

    //Login the user if the submited credentils are valid.

    public function actionLogin() {
        try {
            $post_data = Yii::$app->request->post();

            //trim all post data
            $post_sanitized = GeneralHelper::sanitize($post_data);
            if (!empty($post_sanitized['email'])) {
                $email = $post_sanitized['email'];
                $password = $post_sanitized['password'];

                //Check whether the user exists for the email address 

                $customer_details = Customers::find()->select(['users.id',
                            'full_name', 'email',
                            'password',
                            'access_token'])
                        ->from('users')
                        ->where(['email' => $email, 'user_type' => 'CUSTOMER', 'users.profile_status' => 'ACTIVE'])
                        ->asArray()
                        ->one();

                if (!empty($customer_details)) {
                    $user_details = array('id' => $customer_details['id'],
                        'full_name' => trim($customer_details['full_name']),
                        'email' => trim($customer_details['email'])
                    );

                    //Check whether the password a valid one.
                    $valid = Yii::$app->getSecurity()->validatePassword($password, $customer_details['password']);

                    if ($valid > 0) {
                        $message = ['status' => 'success', 'message' => 'You are logged In.', 'access_token' => $customer_details['access_token'], 'user_details' => $user_details];

                        //Update device info of successfuly logged in users.

                        $this->adddeviceinfo($post_sanitized, $customer_details['access_token'], $customer_details['id']);

                        return json_encode($message);
                    } else {

                        //If password not valid, return error.

                        $message = ['status' => 'failed', 'message' => 'incorrect password<BR>try again!'];
                        return json_encode($message);
                    }
                } else {

                    //If the user doesnt exists in the DB , return error.

                    $message = ['status' => 'failed', 'message' => 'unknown email address<BR>try again!'];
                    return json_encode($message);
                }
            } else {

                //If email is not available in the post data, retun error.

                $message = ['status' => 'failed', 'message' => 'Invalid Access.'];
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

    //This method stores the device information.

    public function adddeviceinfo($post_data, $access_token, $user_id, $loginStatus = 'LoggedIn') {
        $device_token = trim($post_data['device_token']);
        $push_token = 'No_token';
        if (!empty($post_data['push_token'])) {
            $push_token = trim($post_data['push_token']);
        }

        //Update device information ,even if the data exists for the user. 
        // Push token can be a different one for a divice each time

        $finddevice = Webservice::findOne(['device_token' => $device_token]);
        if (!empty($finddevice)) {
            $finddevice->user_id = $user_id;
            $finddevice->push_token = $push_token;
            $finddevice->access_token = $access_token;
            $finddevice->login_status = $loginStatus;
            $finddevice->save();
        } else {

            //If device information of the current divice doesnt exists, it will be added. 
            //One user can have multiple active device  too            

            $finduser = \app\models\Users::findOne(['access_token' => $access_token]);
            if (!isset($post_data['device_type'])) {
                $device_type = 'Android';
            } else {
                $device_type = trim($post_data['device_type']);
            }

            $newdevice = new Webservice();
            $newdevice->user_id = $finduser->id;
            $newdevice->device_token = $device_token;
            $newdevice->device_type = $device_type;
            $newdevice->push_token = $push_token;
            $newdevice->access_token = $access_token;
            $newdevice->created_date = Yii::$app->formatter->asTime('now', 'php:Y-m-d H:i:s');
            $newdevice->save();
        }
    }

    //Facebook registration & Login happens togather. There is no stand alone facebook register. So this method will be used inside 
    //facebook login method.
    //Our app will have a facebook app credentials integrated. So when someone clicks on login/register by facebook from our app, the facebook app 
    //authorizes the user with his facebook credentials and return us faceboomk token for the user and his permited profile details.Our app will
    //will send this token to serverside and we will store it in DB to identify the user.    


    private function fbregister($post_data) {
        try {
            // If the facebook returned email is already registered, return error.
            if (!empty($post_data['fb_email'])) {
                $fb_email = $post_data['fb_email'];
                $already_email_reg_to_another_cust = \app\models\Users::find()->where(['email' => $fb_email, 'user_type' => 'CUSTOMER'])->one();

                if (!empty($already_email_reg_to_another_cust)) {
                    $message = ['status' => 'failed', 'message' => 'This email is already registered with another account.'];
                    return $message;
                }
            }


            //Register customer
            $cust_register = new Customers();
            $cust_register->email = $fb_email;
            $cust_register->full_name = $post_data['full_name'];
//            $cust_register->password = Yii::$app->getSecurity()->generatePasswordHash($post_data['password']);

            $cust_register->created_date = Yii::$app->formatter->asTime('now', 'php:Y-m-d H:i:s');
            $cust_register->timezone = $post_data['timezone'];
            $cust_register->fb_token = $post_data['fb_token'];
            $cust_register->access_token = UserHelper::generateAccessToken();
            $cust_register->user_type = 'CUSTOMER';
            $cust_register->user_status = 'ACTIVE';
            $cust_register->profile_status = 'ACTIVE';
            $cust_register->save();


            if (!empty($cust_register->id)) {
                //Set device details
                $device_token = $post_data['device_token'];
                if (!empty($post_data['push_token'])) {
                    $push_token = trim($post_data['push_token']);
                } else {
                    $push_token = "PushTokenNotRecieved"; //To Avoid Push error in IOS
                }

                $user_details = array('id' => $cust_register->id, 'first_name' => trim($cust_register->full_name), 'email' => $cust_register->email);

                $message = ['status' => 'success', 'message' => 'facebook registration.', 'access_token' => $cust_register->access_token, 'user_details' => $user_details];

                //Add user device info
                $this->adddeviceinfo($post_data, $cust_register->access_token, $cust_register->id);

//                EmailHelper::welcomeEmail($cust_register->id);
                //Sending email in the background
                $background_data = array(array(
                        'url' => Yii::$app->urlManager->createAbsoluteUrl('api/background/sendemail'),
                        'post' => array(
                            'name' => 'welcome',
                            'userid' => $cust_register->id,
                        )
                ));
                GeneralHelper::multiRequest($background_data);

                return $message;
            }
        } catch (ErrorException $ex) {
            $message = ['status' => 'failed',
                'exception_message' => $ex->getMessage(),
                'file_name' => $ex->getFile(),
                'line_no' => $ex->getLine()];
            return $message;
        }
    }

    //Initial part of facebook login.

    public function actionFblogin() {
        try {
            $post_data = Yii::$app->request->post();
            //trim all post data
            $post_sanitized = GeneralHelper::sanitize($post_data);


            if (!empty($post_sanitized['fb_token'])) {

                //Checks whether the user is already registered with us using facekook.

                $fb_token = $post_sanitized['fb_token'];

                $cust_login = Customers::find()->select(['users.id',
                            'full_name', 'email',
                            'password',
                            'access_token'])
                        ->from('users')
                        ->where(['fb_token' => $fb_token, 'user_type' => 'CUSTOMER', 'users.profile_status' => 'ACTIVE'])
                        ->asArray()
                        ->one();

                if (!empty($cust_login)) {

                    //If the facebook user credentials exists in our system , allow him to login.

                    $access_token = $cust_login['access_token'];
                    $user_details = array(
                        'id' => $cust_login['id'],
                        'full_name' => trim($cust_login['full_name']),
                        'email' => trim($cust_login['email'])
                    );


                    $message = ['status' => 'success', 'message' => 'You are logged In.', 'access_token' => $access_token, 'user_details' => $user_details];
                    $this->adddeviceinfo($post_sanitized, $access_token, $cust_login['id']);
                    return json_encode($message);
                } else {

                    if (!empty($post_sanitized['fb_email'])) {

                        //If the user is not registered to our app with his facebook login , check if he is registered with his email. 

                        $fb_email = $post_sanitized['fb_email'];

                        $cust_login_fb = Customers::find()->select(['users.id',
                                    'full_name', 'email',
                                    'password',
                                    'access_token'])
                                ->from('users')
                                ->where(['email' => $fb_email, 'user_type' => 'CUSTOMER', 'users.profile_status' => 'ACTIVE'])
                                ->andWhere("fb_token IS NULL")
                                ->asArray()
                                ->one();


                        if (!empty($cust_login_fb)) {

                            //If the user is not registered with facebook ,but tried to login with facebook and
                            //if he alrady have his email registered with us (email validated or not), allow him to login.

                            $access_token = $cust_login_fb['access_token'];
                            $user_details = array('id' => $cust_login_fb['id'],
                                'full_name' => trim($cust_login_fb['full_name']),
                                'email' => trim($cust_login_fb['email'])
                            );

                            $saveFbtoken = Customers::findOne(['email' => $cust_login_fb['email']]);
                            if (!empty($saveFbtoken)) {

                                //Store his facebook token to DB.

                                $saveFbtoken->fb_token = $fb_token;
                                $saveFbtoken->save();
                            }
                            $message = ['status' => 'success', 'message' => 'Facebook login by already registered customer.', 'access_token' => $access_token, 'user_details' => $user_details];

                            //  Add device info.
                            $this->adddeviceinfo($post_sanitized, $access_token, $cust_login_fb['id']);
                        } else {
                            //If the facebook user is not registered with us usinf facebook or directly by our app, register him using 
                            //his facebook credentials. 

                            $message = $this->fbregister($post_sanitized);
                        }
                        return json_encode($message);
                    } else {
                        //If the user is not registered with us using Facebook, or from our app direclty and tries to register with facebook, 
                        //but if facebook is not providing his fb email as a result of his FB profile settings , return error.

                        $message = ['status' => 'failed', 'message' => 'Some error occured.'];
                        return json_encode($message);
                    }
                }
            } else {
                //If facebook is not returning FB token return error.

                $message = ['status' => 'failed', 'message' => 'Invalid Access.'];
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

    //Loggout a  user device . another user device may be in logged in state.

    public function actionLogout() {
        try {
            $post_data = Yii::$app->request->post();
            $post_sanitized = GeneralHelper::sanitize($post_data);
            $access_token = $post_sanitized['access_token'];
            $device_token = $post_sanitized['device_token'];
            $logout_device = Webservice::findOne(['device_token' => $device_token, 'access_token' => $access_token]);
            if (!empty($logout_device)) {
                $logout_device->login_status = 'LoggedOut';
                $logout_device->save();
                $message = ['status' => 'success', 'message' => 'You have been logged out successfully from this device!'];
                return json_encode($message);
            } else {
                $message = ['status' => 'failed', 'message' => 'Invalid Access.'];
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

    //Generate a random password for forgot password request, if the email exists in our DB.
    //Also send password to registered email.

    public function actionForgotpassword() {
        try {
            $post_data = Yii::$app->request->post();
            $post_sanitized = GeneralHelper::sanitize($post_data);
            $email = $post_sanitized['email'];
            $newpassword = UserHelper::getRandomPassword();
            $changepassword = \app\models\Users::findOne(['email' => $email, 'user_type' => 'CUSTOMER']);
            if (!empty($changepassword)) {
                $user_id = $changepassword['id'];
                $hash = Yii::$app->getSecurity()->generatePasswordHash($newpassword);
                $changepassword->password = $hash;
                $changepassword->save();

//            EmailHelper::forgotPasswordEmail($user_id, $newpassword);
//            
                //Sending email in background
                $background_data = array(array(
                        'url' => Yii::$app->urlManager->createAbsoluteUrl('api/background/sendemail'),
                        'post' => array(
                            'name' => 'forgotpassword',
                            'userid' => $user_id,
                            'newpassword' => $newpassword
                        )
                ));
                GeneralHelper::multiRequest($background_data);

                $message = ['status' => 'success', 'result' => '', 'message' => 'Please check your email for new password'];
                return json_encode($message);
            } else {
                $message = ['status' => 'failed', 'message' => 'Email not found or not registered as a customer.'];
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

}
