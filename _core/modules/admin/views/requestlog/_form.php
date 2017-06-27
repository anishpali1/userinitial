<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequestLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'action_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'get_data')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'post_data')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'return_data')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'request_time')->textInput() ?>

    <?= $form->field($model, 'return_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
