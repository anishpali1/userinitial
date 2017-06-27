<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
<div class="site-login">
    <div class="row">
        <div class="Absolute-Center is-Responsive">
            <div id="logo-container"></div>
            <div class="col-sm-12 col-md-10 col-md-offset-1">

                <?php
                $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'fieldConfig' => [
                                'template' => "<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-1 control-label'],
                            ],
                ]);
                ?>

                <?= $form->field($model, 'email', ['template' => '   
                                <div class="col-lg-12">
                                       <div class="form-group input-group">
                                         <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                          {input}         
                                       </div>
                                 </div> 
                                 <div class="col-lg-12">
                                       {error}{hint}
                                 </div>      
                            '])->textInput(['placeholder' => "Email"]) ?>



                <?= $form->field($model, 'password', ['template' => '   
                                <div class="col-lg-12">
                                       <div class="form-group input-group">
                                         <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                          {input}         
                                       </div>
                                 </div> 
                                 <div class="col-lg-12">
                                       {error}{hint}
                                 </div>      
                            '])->passwordInput(['placeholder' => "Password"]) ?>

                <?=
                $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"col-lg-offset-1 col-lg-12\">{input}&nbsp;&nbsp;&nbsp; {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ])
                ?>
                <div class="form-group">
                    <div class="col-lg-12 ">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
                <div class="form-group ">
                    <div class="col-lg-12 pull-left" >
                        <a  style="margin:3px 0;display:block;" href="#">Forgot Password</a>
                    </div>
                </div>

            </div>  
        </div>    
    </div>
</div>  
</div>    
<style type="text/css">

</style>
