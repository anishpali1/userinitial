<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */

$this->title = $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-view box box-primary padding-h15">

    <h1><?php // Html::encode($this->title)    ?></h1>

    <div class="row">
        <div class="col-sm-12">
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <p>&nbsp;</p>

    <div class="row">
        <div class="col-sm-6">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'full_name',
                    'email:email',
                    'timezone',
                    'user_status',
                    'profile_status',
//                    'id',
//                    'password',
//                    'profile_picture',
//                    'dob',
//                    'access_token',
//                    'fb_token',
//                    'user_type',
//                    'created_date',
//                    'modified_date',
                ],
            ])
            ?>
        </div>
        <div class="col-sm-6">
            <?php if (!empty($model->profile_picture)): ?>                 
                <img src="<?= Yii::$app->urlManager->createAbsoluteUrl('') . Yii::$app->params['profileDirectory'] . $model->profile_picture ?>" width="150px" />
            <?php endif; ?>

        </div>
    </div>



</div>
