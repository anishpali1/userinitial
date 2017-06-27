<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequestlogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'action_path') ?>

    <?= $form->field($model, 'get_data') ?>

    <?= $form->field($model, 'post_data') ?>

    <?= $form->field($model, 'return_data') ?>

    <?php // echo $form->field($model, 'request_time') ?>

    <?php // echo $form->field($model, 'return_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
