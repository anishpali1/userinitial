<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-md-3">
        <?= $form->field($model, 'full_name')->label(false)->textInput(['placeholder' => 'Full Name']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'email')->label(false)->textInput(['placeholder' => 'Email']) ?>
    </div>
    <div class="col-md-3">        
    <?= $form->field($model, 'user_status')->dropDownList(['ACTIVE' => 'Active', 'INACTIVE' => 'Inactive',], ['prompt' => 'Select Status'])->label(false) ?>        
    </div>
    <div class="col-md-3">        
    <?= $form->field($model, 'profile_status')->dropDownList(['ACTIVE' => 'Active', 'INACTIVE' => 'Inactive',], ['prompt' => 'Select Status'])->label(false) ?>        
    </div>
    <?php // $form->field($model, 'id') ?>

    <?php // $form->field($model, 'email') ?>

    <?php // $form->field($model, 'full_name') ?>

    <?php //$form->field($model, 'password') ?>

    <?php //$form->field($model, 'profile_picture') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'access_token') ?>

    <?php // echo $form->field($model, 'fb_token') ?>

    <?php // echo $form->field($model, 'user_type') ?>

    <?php // echo $form->field($model, 'user_status') ?>

    <?php // echo $form->field($model, 'profile_status') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'modified_date') ?>
   <div class="col-md-12"> 
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>
    </div>   

    <?php ActiveForm::end(); ?>

</div>
