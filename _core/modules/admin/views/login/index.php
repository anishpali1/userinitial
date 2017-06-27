<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="login_form" class="login_form container">

    <div class="row">
        <div class="col-sm-6 col-md-4 col-lg-4 col-sm-offset-3 col-md-offset-4">
            <div class="login_box align-top">
                <div id="logo-container"></div>
                
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
                        <a  style="margin:3px 0;display:block;" id="forgotpass" href="#">Forgot Password</a>
                    </div>
                </div>
                
                
                
            </div>
        </div>
    </div>  
</div>  



<div id="forgotpass_form" class="forgotpass_form container hidden">

    <div class="row">
        <div class="col-sm-6 col-md-4 col-lg-4 col-sm-offset-3 col-md-offset-4">
            <div class="login_box align-top">
                <div id="logo-container"></div>
                
                 <?php
                $form2 = ActiveForm::begin([
                            'action' => ['forgot-password'],
                            'id' => 'forgot-form',
                            'fieldConfig' => [
                                'template' => "<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-1 control-label'],
                            ],
                ]);
                ?>

                 <?= $form2->field($model, 'email', ['template' => '   
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
                
               

               
                <div class="form-group">
                    <div class="col-lg-12 ">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-block', 'name' => 'forgot-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
                <div class="form-group ">
                    <div class="col-lg-12 pull-left" >
                        <a  style="margin:3px 0;display:block;" id="signin" href="#">Sign In</a>
                    </div>
                </div>
                
                
                
            </div>
        </div>
    </div>  
</div> 

<script>
//    jQuery(document).ready(function(){
//        console.log("sdf");
//    });

</script>
<?php
$this->registerJs(
        "$('#forgotpass').on('click', function(e) { "
                 ."e.preventDefault();"
                 ."$('#forgotpass_form').removeClass('hidden');"
                 ."$('#login_form').addClass('hidden');"            
        . "});"
        
        
        . "$('#signin').on('click', function(e) { "
                 ."e.preventDefault();"
                 ."$('#login_form').removeClass('hidden');"
                 ."$('#forgotpass_form').addClass('hidden');"            
        . "});"
);
?>