<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

//$this->title = $name;
?>
<div class="site-error">

    <h1>You dont have access to this page </h1>
    <a href="<?= Yii::getAlias('@web').'/admin/'; ?>">Admin </a>

</div>
