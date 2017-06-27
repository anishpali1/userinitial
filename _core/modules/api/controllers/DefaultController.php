<?php

namespace app\modules\api\controllers;

//use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class DefaultController extends ApiAbstractController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
          echo "You dont have access any Access Here.";
//        return $this->render('index');
    }
}
