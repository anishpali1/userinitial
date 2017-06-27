<?php

namespace app\modules\api\controllers;

use Yii;
use app\components\GeneralHelper;
use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class TestController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex() {

//        $background_data=array(array(
//            'url'=>Yii::$app->urlManager->createAbsoluteUrl('api/background/sendemail'),
//            'post'=>array(
//                   'name'=>'welcome',
//                   'userid'=>60,
//                    )
//        ));
        $background_data = array(array(
                'url' => Yii::$app->urlManager->createAbsoluteUrl('api/background/sendemail'),
                'post' => array(
                    'name' => 'emailverification',
                    'userid' => 60,
                    'activation_url' => 'http://local.legacy/emailverification?id=52933F69B4303B54A71EF40B1C47CA54&key=8381aabd0f2b774612896db5a79363ada4182268',
                )
        ));


        GeneralHelper::multiRequest($background_data);
    }

}
