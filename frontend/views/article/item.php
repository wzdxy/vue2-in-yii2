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
            <div class="card-content article-title">
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
            <div class="card-content article-content">
                <?=$article->html?>
            </div>
            <div class="card-reveal" style="display: none; transform: translateY(0px);">
                <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
                <p>Here is some more information about this product that is only revealed once clicked on.</p>
            </div>
        </div>
    </section>
    <div class="send-review col s12" style="padding-bottom: 20px;">
        <form id="review-form" onsubmit="return false;" class="col s12">
            <div class="input-field col m3 s12">
                <input name="author_name" type="text" class="validate">
                <label for="author_name">Name</label>
            </div>
            <div class="input-field col m5 s12">
                <input name="author_email" type="email" class="validate">
                <label for="author_email" data-error="Please input a correct email">Email</label>
            </div>
            <div class="input-field col m4 s12">
                <input name="author_blog" type="text" class="validate">
                <label for="author_blog" data-error="Please input a correct URL">Blog</label>
            </div>
            <div class="input-field col m12 s12">
                <textarea name="text" class="materialize-textarea"></textarea>
                <label for="text">Content</label>
            </div>
            <input name="article_id" type="hidden" value="<?=$article->id?>">
            <input name="<?= Yii::$app->request->csrfParam; ?>" type="hidden"  value="<?=Yii::$app->request->getCsrfToken()?>" />
            <button id="comment-sumbit-btn" onclick="commentSubmit();" class="btn waves-effect waves-light col m2 offset-m5 s6 offset-s3" type="submit" name="action">Submit</button>
        </form>
    </div>
    <section class="user-reviews col s12">
        <?php foreach ($comments as $comment){ ?>
            <div class="card">
                <div class="card-content">
                    <p><a target="_blank" <?=$comment->author_blog?'href=http://'.$comment->author_blog:''?>><?= $comment->author_name ?></a> :</p>
                    <span class="card-title"></span>
                    <p><?= $comment->text ?></p>
                </div>
                <div class="card-action">
                    <a href="#" type="button"><i class="material-icons">reply</i></a>
                    <a href="#" type="button"><i class="material-icons">thumb_up</i></a>
                    <a href="#"><i class="material-icons">thumb_down</i></a>
                </div>
            </div>
        <?php } ?>

    </section>
</article>

<?php
HighlightAsset::register($this);
\frontend\assets\JquerySerializeJson::register($this);
$this->registerCssFile('@web/css/article.css',['depends'=>'frontend\assets\AppAsset']);
$this->registerJsFile('@web/js/article.js',['depends'=>'frontend\assets\AppAsset']);
?>