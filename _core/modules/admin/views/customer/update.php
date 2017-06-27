<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */

$this->title = 'Update Customer: ' . ucwords($model->full_name);
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => ucwords($model->full_name), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customers-update box box-primary content-box">

    <h1><?php //  Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
