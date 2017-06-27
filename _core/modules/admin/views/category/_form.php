<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
/* Admin Category module create/update form template */
?>
<div class="category-form padding-h15">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tagline')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList(['ACTIVE' => 'ACTIVE', 'INACTIVE' => 'INACTIVE',]) ?>
        </div>


        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

            <?= $form->field($model, 'imageFile')->fileInput()->label('Category Image') ?>       
            <?php if (!$model->isNewRecord): ?>
                <?php if (!empty($model->category_image)): ?>                 
                    <img src="<?= Yii::$app->urlManager->createAbsoluteUrl('') . Yii::$app->params['categoryDirectory'] . $model->category_image ?>" width="150px" />
                <?php endif; ?>
            <?php endif; ?>        


        </div>
    </div>   
    <?php //  Yii::$app->formatter->asTime($model->created_date,'php:Y-m-d H:i:s');?>
    <div class="row">
        <div class="box-footer padding-v15">
            <div class="col-lg-12">

                <div class='btn-toolbar pull-right'>
                    <?= Html::resetButton('Reset', ['class' => 'btn btn-default ']) ?> 
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

            </div>
        </div>
    </div>   

    <?php ActiveForm::end(); ?>


</div>
