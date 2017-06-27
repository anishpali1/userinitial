<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//$this->title = $name;
?>
<div class="site-login">

    <h1>User Register    </h1>
    
    
    <?php
                    $form = ActiveForm::begin([
                                'id' => 'register-form',
                                'options' => [
                                    'class' => 'login-form',
                                ],
                                'action' =>['index'],
                                //'layout' => 'horizontal',
                                'fieldConfig' => [
                                    'template' => "{input}",
                                    'options' => [

                                        'tag' => false,
                                    ]
                                //'template' => "<div class=\"col-xs-6\">{input}</div>",
                                //'labelOptions' => ['class' => 'col-lg-1 control-label'],
                                ],
                    ]);
                    ?>
    <div class="row">
                        <div class="col-xs-6"> <?= $form->field($model, 'full_name')->textInput(['class' => 'form-control form-control-solid placeholder-no-fix form-group', 'autocomplete' => "off", 'autofocus' => true, 'required' => "", 'placeholder' => "Full Name"]) ?></div>
                    </div>
     <div class="row">
                        <div class="col-xs-6"> <?= $form->field($model, 'email')->textInput(['class' => 'form-control form-control-solid placeholder-no-fix form-group', 'autocomplete' => "off", 'autofocus' => true, 'required' => "", 'placeholder' => "Email"]) ?></div>
            </div>
   
                   
     <div class="row">
                        <div class="col-xs-6"><?= $form->field($model, 'password')->passwordInput(['id'=>'regPassword','class' => 'form-control form-control-solid placeholder-no-fix form-group', 'autocomplete' => "off", 'autofocus' => true, 'required' => "", 'placeholder' => "Password"]) ?></div>
                    </div>
       <div class="row">
                        <div class="col-xs-6"><?= $form->field($model, 'password_repeat')->passwordInput(['id'=>'regPassword2','class' => 'form-control form-control-solid placeholder-no-fix form-group', 'autocomplete' => "off", 'autofocus' => true, 'required' => "", 'placeholder' => "Password repeat"]) ?></div>
                    </div>
     <div class="col-sm-8 text-right">
                        
                        <?= Html::submitButton('Register', ['class' => 'btn green', 'name' => 'register-button']) ?>
                    </div>
     <?php ActiveForm::end(); ?>

</div>
<a href="<?= Yii::getAlias('@web').'/admin/'; ?>">Admin </a>