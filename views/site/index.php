<?php

/* @var $this yii\web\View */

$this->title = 'Test Shop';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Welcome!</h1>
        <?php
        echo !\Yii::$app->user->isGuest
            ? \yii\bootstrap\Html::a('Start shopping',['/shop'],['class'=>'btn btn-lg btn-success'])
            : '<p class="lead">Please, sign in to start shopping</p>';
        ?>
    </div>
</div>
