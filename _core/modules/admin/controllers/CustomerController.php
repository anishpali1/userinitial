<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Customers;
use app\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CustomerController implements the CRUD actions for Customers model.
 */
class CustomerController extends AdminAbstractController
{
    /**
     * Lists all Customers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customers model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Updates an existing Customers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //profile image upload
            if (Yii::$app->request->isPost) {

                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if (!empty($model->imageFile)) {

                    $fileName = rand() . '.' . $model->imageFile->extension;
                    if ($model->imageFile->saveAs(Yii::$app->params['profileDirectory'] . $fileName)) {
                        $model->imageFile = "";
                        $model->profile_picture = $fileName;
                    }
                }
            }
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Customer profile has been updated.');               
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                 Yii::$app->session->setFlash('danger', "Sorry,We couldn't update customer profile.");
            }
        } 
            return $this->render('update', [
                'model' => $model,
            ]);
        
    }

   
    /**
     * Finds the Customers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
