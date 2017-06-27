<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Relationships;
use app\models\RelationshipSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RelationshipController implements the CRUD actions for Relationships model.
 */
class RelationshipController extends AdminAbstractController
{
    /**
     * @inheritdoc
     */
   

    /**
     * Lists all Relationships models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RelationshipSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Relationships model.
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
     * Creates a new Relationships model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Relationships();
        
        if ($model->load(Yii::$app->request->post()) ) {
             $model->created_date = Yii::$app->formatter->asTime('now'.' '.Yii::$app->user->identity->timezone,'php:Y-m-d H:i:s'); 
             
             if($model->save()){        
                Yii::$app->session->setFlash('success', 'New Relationship has been created.');                
                return $this->redirect(['index', 'id' => $model->id]);
                 
            }else{
                Yii::$app->session->setFlash('danger', 'New Relationship has not created.'); 
                return $this->render('create', ['model' => $model]); 
                
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Relationships model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {

            if($model->save()){
                Yii::$app->session->setFlash('success', 'Relation has been updated.'); 
                return $this->redirect(['index']);
                 
            }else{
                Yii::$app->session->setFlash('danger', 'Relation not updated.'); 
                return $this->render('update', ['model' => $model]);
                 
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Relationships model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Relationships model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Relationships the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Relationships::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
