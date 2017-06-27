<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Profile: ' . ucwords($profileModel->full_name);
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['index']];

$this->params['breadcrumbs'][] = ucwords($profileModel->full_name);
?>
<?php
/* profile form  */


 //Get timezone list
 $timeZoneList = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
 //replace timezone key with value
 $timeZoneListArray = array_combine($timeZoneList, $timeZoneList);


?>
<div class="profile-update box box-primary content-box">

    <h1><?php //  Html::encode($this->title)    ?></h1>

    <div class="profile-form padding-h15">

        <?php $form = ActiveForm::begin(['action' => ['update'], 'options' => ['enctype' => 'multipart/form-data']]); ?>
        <?php //$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

                <?= $form->field($profileModel, 'full_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($profileModel, 'email')->textInput(['maxlength' => true, 'disabled' => true]) ?>
                
                 <?= $form->field($profileModel, 'timezone')->dropDownList($timeZoneListArray) ?>

            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

                <?php if (!empty($profileModel->profile_picture)): ?>                 
                    <img src="<?= Yii::$app->urlManager->createAbsoluteUrl('') . "uploads/profile/" . $profileModel->profile_picture ?>" width="150px" />
                <?php endif; ?>
                <?= $form->field($profileModel, 'imageFile')->fileInput()->label('Profile Picture') ?> 

            </div>
        </div>        
        
        <div calls="row">
            <div class="box-footer padding-v15">
                <div class="col-lg-12">

                    <div class='btn-toolbar pull-right'>
                        <?= Html::resetButton('Reset', ['class' => 'btn btn-default ']) ?> 
                        <?= Html::submitButton($profileModel->isNewRecord ? 'Create' : 'Update', ['class' => $profileModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                </div>
            </div>
        </div>   

        <?php ActiveForm::end(); ?>

    </div>
</div>



<?php
/* password change form  */
?>

<div class="profile-changepassword box box-primary content-box">

    <h1><?php //  Html::encode($this->title)    ?></h1>

    <div class="profile-changepassword-form padding-h15">

        <?php $form2 = ActiveForm::begin(['action' => ['changepassword']]); ?>    

        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <?= $form2->field($changePasswordModel, 'currentpass')->passwordInput(['placeholder' => "Current password"]) ?>
                <?= $form2->field($changePasswordModel, 'newpass')->passwordInput(['placeholder' => "New password"]) ?>
                <?= $form2->field($changePasswordModel, 'repeatnewpass')->passwordInput(['placeholder' => "Re-type New password"]) ?>

            </div>
        </div>        
        
        <div calls="row">
            <div class="box-footer padding-v15">
                <div class="col-lg-12">

                    <div class='btn-toolbar pull-right'>
                        <?= Html::resetButton('Reset', ['class' => 'btn btn-default ']) ?> 
                        <?= Html::submitButton($changePasswordModel->isNewRecord ? 'Create' : 'Update', ['class' => $changePasswordModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                </div>
            </div>
        </div>   

        <?php ActiveForm::end(); ?>

    </div>
</div>

