<?php
use frontend\assets\HighlightAsset;

/* @var $this yii\web\View */

$this->title = $article->title;
?>

<article class="row content-center">
    <section class="article-content col s12">
        <div class="card sticky-action">
            <div class="card-image waves-effect waves-block waves-light" style="max-height: 30vh;">
                <img class="activator" src="/images/1.jpg">
            </div>
            <div class="card-content">
                <header class="card-title">
                    <h3 style="margin-top: 0;"><?=$article->title?></h3>
                    <span class="article-info col m3 s12" style="text-align: right;">
                        <a style="float: left;"><?=$article->author_name?></a>
                        <a ><?=$article->created_at?></a>
                    </span>
                    <span class="tag-box col m9 s12 ">
                    <?php foreach ($tags as $tag){?>
                        <a class="tag-item btn" href="/tag/<?=$tag->url?>">
                            <i class="fa fa-tag fa-1" aria-hidden="true"></i>
                            <span><?=$tag->name?></span>
                        </a>
                    <?php }?>
                </span>
                </header>
            </div>
            <div class="card-content">
                <?=$article->html?>
            </div>
            <div class="card-reveal" style="display: none; transform: translateY(0px);">
                <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
                <p>Here is some more information about this product that is only revealed once clicked on.</p>
            </div>
        </div>
    </section>
    <div class="send-review col s12">
        <form id="review-form" onsubmit="return false;" class="col s12">
            <div class="input-field col m3 s12">
                <input name="name" type="text" class="validate">
                <label for="name">Name</label>
            </div>
            <div class="input-field col m5 s12">
                <input name="email" type="email" class="validate">
                <label for="email" data-error="Please input a correct email">Email</label>
            </div>
            <div class="input-field col m4 s12">
                <input name="blog" type="text" class="validate">
                <label for="blog" data-error="Please input a correct URL">Blog</label>
            </div>
            <div class="input-field col m12 s12">
                <textarea name="content" class="materialize-textarea"></textarea>
                <label for="content">Content</label>
            </div>
            <button id="comment-sumbit-btn" onclick="commentSubmit();" class="btn waves-effect waves-light col m2 offset-m5 s6 offset-s3" type="submit" name="action">Submit</button>
        </form>
    </div>
    <section class="user-reviews col s12" style="height: 200px;">

    </section>
</article>

<?php
HighlightAsset::register($this);
\frontend\assets\JquerySerializeJson::register($this);
$this->registerCssFile('@web/css/article.css',['depends'=>'frontend\assets\AppAsset']);
$this->registerJsFile('@web/js/article.js',['depends'=>'frontend\assets\AppAsset']);
?>