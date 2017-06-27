<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Request Logs: Development purpose only';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-log-index box box-primary content-box">

    <h1><?php //  Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //  Html::a('Create Request Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'tableOptions' => ['class' => 'table  table-bordered table-hover'],
        'layout'=>"<div class='box-body table-responsive'>{summary}\n{items}\n{pager}</div>",
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'action_path',
//            'get_data:ntext',
            [
            'attribute' => 'get_data',
            'format'=>'raw',           
            'contentOptions'=>['style'=>'max-width:250px;word-wrap: break-word;','class' => 'text-wrap'],        
            ],
            [
            'attribute' => 'post_data',
//            'format'=>'ntext',           
            'contentOptions'=>['style'=>'max-width:250px;word-wrap: break-word;','class' => 'text-wrap'],        
            ],
//            'post_data:ntext',
            [
            'attribute' => 'return_data',
//            'format'=>'ntext',           
            'contentOptions'=>['style'=>'max-width:250px;word-wrap: break-word;','class' => 'text-wrap'],        
            ],
//            'return_data:ntext',
             'request_time',
            // 'return_time',

//            ['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn','header'=>'Action','template' => '{view}'],
        ],
    ]); ?>
</div>
