<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<nav>
    <div class="nav-wrapper  light-blue accent-4">
        <a href="/" class="brand-logo">BLOG</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="/">Home</a></li>
            <li><a href="/article">Article</a></li>
            <li><a href="/tag">Tag</a></li>
            <li><a href="/site/about">About</a></li>
            <li><a href="/site/contact">Contact</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="/">Home</a></li>
            <li><a href="/catalog">Catalog</a></li>
            <li><a href="/tag">Tag</a></li>
            <li><a href="/site/about">About</a></li>
            <li><a href="/site/contact">Contact</a></li>
        </ul>
    </div>
</nav>
<main class="wrap">
    <?= $content ?>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
