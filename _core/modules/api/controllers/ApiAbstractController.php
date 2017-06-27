<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;

/**
 * abstract controller of All API requests
 * All the features of this abstract controller be applicable to all other controllers which extends from this.
 */
class ApiAbstractController extends Controller {

    public $request_time;
    
    //This avoids default Yii2 feature of Csrf validation for API.  
    //request_time added as class variable to make it available to the request log section in this controller at later stage.
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        $this->request_time = Yii::$app->formatter->asTime('now','php:Y-m-d H:i:s'); 
        return parent::beforeAction($action);
    }
    
    //This method will be initiated after the requested method in any other controller, which extends this base controller 
    //returns data after the execution.
    public function afterAction($action, $result) {
        parent::afterAction($action, $result);
        if(Yii::$app->params['apiRequestLog']){
            $this->addLog($action, $result);
        }        
        echo $result;
    }
    
    //This recods all the requests to all APIs and its returned value.
    private function addLog($action, $result) {
        $post_data = '';
        $get_data = '';
        
        if (!empty(Yii::$app->request->post())) {
            $post_data = Yii::$app->request->post();
            if(in_array($action->id, array('login','register'))) {                
                if (isset($post_data['password'])) {
                    unset($post_data['password']);
                }                
            }
            $post_data = json_encode($post_data);
        }
        if (!empty(Yii::$app->request->get())) {
            $get_data = json_encode(Yii::$app->request->get());
        }

        $model = new \app\models\RequestLog();
        $model->post_data = $post_data;
        $model->get_data = $get_data;
        $model->action_path = Yii::$app->request->pathInfo;
        $model->request_time = $this->request_time;
        $model->return_time = Yii::$app->formatter->asTime('now','php:Y-m-d H:i:s');
        //The result may or maynot be in json format. If result is not in json format it will be converted to json.
        if ($this->isJson($result)) {
            $model->return_data = $result;
        } else {
            $model->return_data = json_encode($result);
        }
        $model->save();
    }

//check whether the given string is a json formated string
    private function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

}
