<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Relationships */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relationships-form padding-h15">

    <?php $form = ActiveForm::begin(); ?>
   
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?= $form->field($model, 'relation')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status')->dropDownList(['ACTIVE' => 'ACTIVE', 'INACTIVE' => 'INACTIVE']) ?>
            </div>
        </div>    
      

    <?php // $form->field($model, 'created_date')->textInput() ?>

    <?php // $form->field($model, 'modified_date')->textInput() ?>
     <div class="row">
            <div class="box-footer padding-v15" >
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

