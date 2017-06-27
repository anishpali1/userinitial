<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Category;
use app\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends AdminAbstractController
{
    /**
     * @inheritdoc
     */


    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

      /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) ) {
//             $model->created_date = date('Y-m-d H:i:s');
            //Set created time in UTC 
             $model->created_date = Yii::$app->formatter->asTime('now'.' '.Yii::$app->user->identity->timezone,'php:Y-m-d H:i:s'); 
               //category image upload
            if (Yii::$app->request->isPost) {
                //Upload category image if it is available
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if(!empty($model->imageFile)){
                   
                    $fileName=rand(). '.' . $model->imageFile->extension;
                    if ($model->imageFile->saveAs(Yii::$app->params['categoryDirectory'].$fileName)){                       
                       $model->imageFile=""; 
                       $model->category_image=$fileName; 
                    }
                }
            } 
            if($model->save()){        
                Yii::$app->session->setFlash('success', 'New Category has been created.');                
                return $this->redirect(['index']);
                 
            }else{
                Yii::$app->session->setFlash('danger', 'New Category has not created.'); 
                return $this->render('create', ['model' => $model]); 
                
            }
            
        } else {
            
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
             //category image upload
            if (Yii::$app->request->isPost) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if(!empty($model->imageFile)){
                    $fileName=rand(). '.' . $model->imageFile->extension;
                    if ($model->imageFile->saveAs(Yii::$app->params['categoryDirectory'].$fileName)){
                       $model->imageFile=""; 
                       $model->category_image=$fileName; 
                    }
                }
            } 
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Category has been updated.'); 
                return $this->redirect(['index']);
                 
            }else{
                Yii::$app->session->setFlash('danger', 'Category not updated.'); 
                return $this->render('update', ['model' => $model]);
                 
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
