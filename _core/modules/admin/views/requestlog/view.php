<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RequestLog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Request Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-log-view box box-primary padding-h15">

    <h1><?php  // Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'action_path',
            'get_data:ntext',
            'post_data:ntext',
            'return_data:ntext',
            'request_time',
            'return_time',
        ],
    ]) ?>

</div>
