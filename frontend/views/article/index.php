<?php
use frontend\assets\HighlightAsset;

/* @var $this yii\web\View */

$this->title = $article->title;
?>
<div class="site-index" style="padding-top: 5px">
    <div class="">
        <h1><?=$article->title?></h1>
            <div class="row">
                <div class="col s12 m10">
                    <div class="card blue-grey darken-1">
                        <div class="card-action">
                            <a><?=$article->author_name?></a> <a style="float: right;"><?=$article->created_at?></a>
                        </div>
                        <div class="card-content white-text">
                            <?=$article->html?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<?php
HighlightAsset::register($this);
?>