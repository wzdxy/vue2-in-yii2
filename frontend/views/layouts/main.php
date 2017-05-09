<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="navbar-fixed"><nav>
    <div class="nav-wrapper  light-blue accent-4">
        <a href="/" class="brand-logo">BLOG</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="/">Home</a></li>
            <li><a href="/catalog">Catalog</a></li>
            <li><a href="/tag">Tag</a></li>
            <li><a href="/site/about">About</a></li>
            <li><a href="/site/contact">Contact</a></li>
        </ul>
    </div>
</nav></div>
<main class="wrap">
    <div class="container">
        <?= $content ?>
    </div>
</main>

<footer class="page-footer light-blue accent-4" style="padding-top: 0;">
    <div class="footer-copyright">
        <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
