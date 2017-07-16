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

                            <span class="tag-box">
                                <?php foreach ($tags as $tag){?>
                                    <a class="tag-item btn" href="/tag/<?=$tag->url?>">
                                        <i class="fa fa-tag fa-1" aria-hidden="true"></i>
                                        <span><?=$tag->name?></span>
                                    </a>
                                <?php }?>
                            </span>
                            <a ><?=$article->author_name?></a> <a ><?=$article->created_at?></a>
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
$this->registerCssFile('@web/css/article.css',['depends'=>'frontend\assets\AppAsset']);
?>