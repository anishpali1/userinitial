<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Relationships */

$this->title = 'Update Relationships: ' . $model->relation;
$this->params['breadcrumbs'][] = ['label' => 'Relationships', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->relation;
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="relationships-update box box-primary content-box">

    <h1><?php //  Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
