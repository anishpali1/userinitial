<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    
    
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php
    $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
    ]);
    ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?=
    $form->field($model, 'rememberMe')->checkbox([
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])
    ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    $form2 = ActiveForm::begin([
                'action' => ['forgot-password'],
                'id' => 'forgot-form',
                'options' => [
                    'class' => 'forget-form',
                ],
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
//                'fieldConfig' => [
//                    'template' => "{input}",
//                    'options' => [
//                        'tag' => false,
//                    ]
//                //'template' => "<div class=\"col-xs-6\">{input}</div>",
//                //'labelOptions' => ['class' => 'col-lg-1 control-label'],
//                ],
    ]);
    ?>

    <h3 class="font-green">Forgot Password ?</h3>
    <p> Enter your e-mail address below to reset your password. </p>
    <div class="form-group">
    <?php // $form2->field($model, 'email')->textInput(['class' => 'form-control form-control-solid placeholder-no-fix form-group', 'autocomplete' => "off", 'autofocus' => true, 'required' => "", 'placeholder' => "Email"]) ?>
    <?= $form2->field($model, 'email')->textInput() ?> 
   <!--<input class="form-control placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Email" name="email" />--> 
    </div>
    <div class="form-actions">

    <?= Html::submitButton('Submit', ['class' => 'btn btn-success uppercase pull-right', 'name' => 'login-button']) ?>

    </div>

<?php ActiveForm::end(); ?>


</div>
