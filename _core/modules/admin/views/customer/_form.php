<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */
/* @var $form yii\widgets\ActiveForm */

//Customer Profile update page template for admin
?>
<?php
 //Get timezone list
 $timeZoneList = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
 
 //To avoid mismatch between PHP configured timezone names & API received timezones. If timezone received is not available 
 //in PHP timezonelist($timeZoneList), the new timezone will be added to it. so that could be shown in admin panel.
 //BUT ALL TIME CONVERSIONS USING THIS TIME ZONE COULD FAIL AS THE NEW TIMEZONE IS NOT AVAILABLE IN PHP.
 if((!empty($model->timezone)) && (!in_array($model->timezone,$timeZoneList))){
    array_unshift($timeZoneList , $model->timezone);    
 }
//replace timezone key with value
 $timeZoneListArray = array_combine($timeZoneList, $timeZoneList);
 

?>
<div class="customers-form padding-h15">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'disabled' => true]) ?>
                
                <?= $form->field($model, 'timezone')->dropDownList($timeZoneListArray) ?>

                <?= $form->field($model, 'user_status')->dropDownList(['ACTIVE' => 'ACTIVE', 'INACTIVE' => 'INACTIVE']) ?>

                <?= $form->field($model, 'profile_status')->dropDownList(['ACTIVE' => 'ACTIVE', 'INACTIVE' => 'INACTIVE']) ?>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

                <?php if (!empty($model->profile_picture)): ?>                 
                    <img src="<?= Yii::$app->urlManager->createAbsoluteUrl('') . Yii::$app->params['profileDirectory'] . $model->profile_picture ?>" width="150px" />
                <?php endif; ?>
                <?= $form->field($model, 'imageFile')->fileInput()->label('Profile Picture') ?> 
                    
            </div>
        </div>  
       
     
    <?php // $form->field($model, 'profile_picture')->textInput(['maxlength' => true]) ?>  
    <?php // $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?php // $form->field($model, 'dob')->textInput() ?>
    <?php // $form->field($model, 'access_token')->textInput(['maxlength' => true]) ?>
    <?php // $form->field($model, 'fb_token')->textInput(['maxlength' => true]) ?>
    <?php // $form->field($model, 'user_type')->dropDownList([ 'ADMIN' => 'ADMIN', 'CUSTOMER' => 'CUSTOMER', '' => '', ], ['prompt' => '']) ?>
    <?php // $form->field($model, 'created_date')->textInput() ?>
    <?php // $form->field($model, 'modified_date')->textInput() ?>
   
        <div class="row">
            <div class="box-footer padding-v15" >
                <div class="col-lg-12">
                    
                        <div class='btn-toolbar pull-right'>
                            <?= Html::resetButton('Reset', ['class' => 'btn btn-default ']) ?> 
                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                   
                </div>
            </div>
        </div>               
   
    <?php ActiveForm::end(); ?>

</div>
