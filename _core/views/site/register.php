<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $register_model app\models\RegisterForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Symple | Registration</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #6 for " name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?= Yii::getAlias('@web') ?>/m_assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?= Yii::getAlias('@web') ?>/m_assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?= Yii::getAlias('@web') ?>/m_assets/pages/css/login-5.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->
    <!-- BEGIN : LOGIN PAGE 5-1 -->
    <div class="user-login-5">
        <div class="row bs-reset">
            <div class="col-md-6 bs-reset mt-login-5-bsfix">
                <div class="login-bg" style="background-image:url(<?= Yii::getAlias('@web') ?>/m_assets/pages/img/login/bg1.jpg)">
                    <!--<img class="login-logo" src="<?php // Yii::getAlias('@web') ?>/m_assets/pages/img/login/logo.png" />--> 
                </div>
            </div>
            <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
                <div class="login-content" style="margin-top:30%;">

<!--                        <h1><?= Html::encode($this->title) ?></h1>-->
                    <h1><img style="width:45px;margin-right: 5px;" src="<?= Yii::getAlias('@web') ?>/m_assets/pages/img/login/logo.png" />Symple</h1>
                    <h3 style="margin-top:0; margin-bottom: 20px;color:#4e5a64">Internet Financial Ltd.</h3>
                    <h4>Digital Asset Management.</h4>
                    <h5 class="font-green-seagreen">Private Beta</h5>


                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'register-form',
                                'options' => [
                                    'class' => 'login-form',
                                ],
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

                    <?php
                    if ($register_model->hasErrors()) {
                        $class = "form-control form-control-solid placeholder-no-fix form-group has-error";
                        ?>

                        <div class="alert alert-danger error-message">
                            <button class="close" data-close="alert"></button>
                            <span><?php print_r($form->errorSummary($register_model, ['header' => ''])); ?> </span>
                            <div class="clear"></div>
                        </div>

                    <?php
                    } else {
                        $class = "form-control form-control-solid placeholder-no-fix form-group";?>
                        <div class="alert alert-danger error-message display-hide">
                            <button class="close" data-close="alert"></button>
                            <span>Please fill all the required fields.</span>
                            <div class="clear"></div>
                        </div>
                   <?php }
                    ?>
                    <div class="row">
                        <div class="col-xs-6"> <?= $form->field($register_model, 'first_name')->textInput(['class' => 'form-control form-control-solid placeholder-no-fix form-group', 'autocomplete' => "off", 'autofocus' => true, 'required' => "", 'placeholder' => "First Name"]) ?></div>

                        <div class="col-xs-6"><?= $form->field($register_model, 'last_name')->textInput(['class' => 'form-control form-control-solid placeholder-no-fix form-group', 'autocomplete' => "off", 'autofocus' => true, 'required' => "", 'placeholder' => "Last Name"]) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6"> <?= $form->field($register_model, 'email')->textInput(['class' => $class, 'autocomplete' => "off", 'autofocus' => true, 'required' => "", 'placeholder' => "Email"]) ?></div>

                        <div class="col-xs-6"><?= $form->field($register_model, 'password')->passwordInput(['id'=>'regPassword','class' => 'form-control form-control-solid placeholder-no-fix form-group', 'autocomplete' => "off", 'autofocus' => true, 'required' => "", 'placeholder' => "Password"]) ?><a href="javascript:;" id="showHidePassword"style="display:none; position: absolute; right: 15px;top: 5px; color:#868e97;font-size: 18px"><i id="eyeShowHide" class="fa fa-eye"></i></a></div>
                    </div>
                    <div class="col-sm-4">
                        <div class="rem-password">

                        </div>
                    </div>


                    <div class="col-sm-8 text-right">

                        <?= Html::submitButton('Register', ['class' => 'btn green', 'name' => 'register-button']) ?>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-1 col-lg-11 text-center">
                            Already have an account? <a href="login" id="forget-password" class="">Login in here</a>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
                <div class="login-footer">
                    <div class="row bs-reset">
                        <div class="col-xs-5 bs-reset">
                            <ul class="login-social">
                                
                                <li>
                                    <a target="_blank" href="https://twitter.com/symple_ltd">
                                        <i class="icon-social-twitter"></i>
                                    </a>
                                </li>
                               
                            </ul>
                        </div>
                        <div class="col-xs-7 bs-reset">
                            <div class="login-copyright text-right">
                                <p>Copyright &copy; Symple, Internet Financial LTD.  <?php echo date('Y'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END : LOGIN PAGE 5-1 -->
    <!--[if lt IE 9]>
<script src="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/respond.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/excanvas.min.js"></script> 
<script src="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?= Yii::getAlias('@web') ?>/m_assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?= Yii::getAlias('@web') ?>/m_assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?= Yii::getAlias('@web') ?>/m_assets/pages/scripts/login-5.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <!-- END THEME LAYOUT SCRIPTS -->
    <script>
    (function() {

	try {

		// switch the password field to text, then back to password to see if it supports
		// changing the field type (IE9+, and all other browsers do). then switch it back.
		var passwordField = document.getElementById('regPassword');
		passwordField.type = 'text';
		passwordField.type = 'password';
		
		// if it does support changing the field type then add the event handler and make
		// the button visible. if the browser doesn't support it, then this is bypassed
		// and code execution continues in the catch() section below
		var showHidePassword = document.getElementById('showHidePassword');
		showHidePassword.addEventListener('click', showHidePasswordClicked, false);
		showHidePassword.style.display = 'inline';
		
	}
	catch(err) {

	}

})();

function showHidePasswordClicked() {

	var passwordField = document.getElementById('regPassword');
	var value = passwordField.value;
        var eye=document.getElementById('eyeShowHide');

	if(passwordField.type == 'password') {
		passwordField.type = 'text';
                eye.className = "fa fa-eye-slash";
	}
	else {
		passwordField.type = 'password';
                eye.className = "fa fa-eye";
	}
	
	passwordField.value = value;

}
    </script>

    
</body>
</html>



