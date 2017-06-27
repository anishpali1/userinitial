<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RelationshipSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Relationships';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relationships-index box box-primary content-box">

    <div class="container">    
        <?= Html::a('Create Relationships', ['create'], ['class' => 'btn btn-default']) ?>
    </div>
     <h1><?php // Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'tableOptions' => ['class' => 'table  table-bordered table-hover'],
        'layout'=>"<div class='box-body table-responsive'>{summary}\n{items}\n{pager}</div>",
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'relation',
            'status',
//            'created_date',
//            'modified_date',

//            ['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn','header'=>'Action','template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil action_column_size"></span>', ['update', 'id' => $model['id']], [
                                    'title' => Yii::t('yii', 'Update'),
                                    'data-pjax' => '0',
                        ]);
                   }
                ]
                
                
                
                
                ],
        ],
    ]); ?>
</div>
