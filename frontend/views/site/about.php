<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>source code <a href="https://github.com/wzdxy/vue2-in-yii2">wzdxy/vue2-in-yii2</a> </p>
    <p>e-mail <a href="mailto:zh.ch.0915@gmail.com">zh.ch.0915@gmail.com</a> </p>
</div>
<style>
    .site-about{
        width: 100%;
        text-align: center;
    }
</style>