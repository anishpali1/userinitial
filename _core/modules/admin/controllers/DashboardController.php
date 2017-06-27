<?php

namespace app\modules\admin\controllers;

//use yii\web\Controller;
use Yii;

/**
 * Default controller for the `admin` module
 */
class DashboardController extends AdminAbstractController {
//     public function init() {
//        parent::init();
//        $this->layout = "main";
////         $this->layout = false;
//    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $accessedCodes = 11111;
        $customerCount = \app\models\Customers::find()->where(['user_type' => 'CUSTOMER'])->andWhere(['profile_status' => 'ACTIVE'])->count();


        return $this->render('index', ['customerCount' => $customerCount,
                    'accessedCodes' => $accessedCodes]);

        return $this->render('index');
    }

    public function actionTimetest() {



        echo date('Y-m-d H:i:s') . "<br><br>";

        echo 'user time zone:' . Yii::$app->user->identity->timezone . "<br>";
        echo "<br>";
         echo Yii::$app->formatter->asTime('now', 'php:Y-m-d H:i:s');
echo "<br>";
        echo $DBTIME = Yii::$app->formatter->asTime('now' . ' ' . Yii::$app->user->identity->timezone, 'php:Y-m-d H:i:s');
        echo "<br><br><br>" . Yii::$app->formatter->asTime($DBTIME, 'php:Y-m-d H:i:s');

//                $tzlist = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
//                print_r($tzlist);

        die();
    }

}
