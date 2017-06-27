<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-index box box-primary content-box">

    <h1><?php //  Html::encode($this->title)  ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php // Html::a('Create Customers', ['create'], ['class' => 'btn btn-success']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table  table-bordered table-hover'],
        'layout' => "<div class='box-body table-responsive'>{summary}\n{items}\n{pager}</div>",
//        'filterModel' => $searchModel,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            'full_name',
            'email:email',
            'user_status',
            'profile_status',
//            'id',            
//            'password',
//            'profile_picture',
//             'dob',
//             'access_token',
//             'fb_token',
//             'user_type',            
//             'created_date',
//             'modified_date',
//            ['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Action', 'template' => '{update}  {view}',
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
    ]);
    ?>
</div>
