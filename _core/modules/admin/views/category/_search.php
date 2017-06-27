<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
     <div class="col-md-3">
        <?= $form->field($model, 'name')->label(false)->textInput(['placeholder' => 'Category']) ?>
    </div>
     <div class="col-md-3">
        <?= $form->field($model, 'tagline')->label(false)->textInput(['placeholder' => 'Tagline']) ?>
    </div>
    <div class="col-md-3">        
        <?= $form->field($model, 'status')->dropDownList([ 'ACTIVE' => 'Active', 'INACTIVE' => 'Inactive', ], ['prompt' => 'Select Status'])->label(false) ?>        
    </div>
    <?php // $form->field($model, 'id') ?>

    <?php // $form->field($model, 'name') ?>

    <?php // $form->field($model, 'tagline') ?>

    <?php // $form->field($model, 'category_image') ?>

    <?php // $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'creates_date') ?>

    <?php // echo $form->field($model, 'modified_date') ?>
    <div class="col-md-3">     
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>
    </div>    

    <?php ActiveForm::end(); ?>
    

</div>
