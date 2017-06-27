<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RelationshipSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relationships-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>
    <div class="col-md-3">
        <?= $form->field($model, 'relation')->label(false)->textInput(['placeholder' => 'Relation']) ?>
    </div>
    <div class="col-md-3">        
    <?= $form->field($model, 'status')->dropDownList(['ACTIVE' => 'Active', 'INACTIVE' => 'Inactive',], ['prompt' => 'Select Status'])->label(false) ?>        
    </div>
         
    <?php // $form->field($model, 'id') ?>

    <?php // $form->field($model, 'relation') ?>

    <?php // $form->field($model, 'status') ?>

    <?php // $form->field($model, 'created_date') ?>

            <?php // $form->field($model, 'modified_date')  ?>
    <div class="col-md-6"> 
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div
    </div>
     

<?php ActiveForm::end(); ?>

</div>
