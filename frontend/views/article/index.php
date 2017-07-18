<?php
use frontend\assets\HighlightAsset;

/* @var $this yii\web\View */

$this->title = $article->title;
?>
<div style="padding-top: 5px">
    <article class="row">
        <header class="col s11"><h1><?=$article->title?></h1></header>
        <section class="article-content col s12">
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
        </section>
        <div class="send-review col s12">
            <div class="card">
                <form onsubmit="return false;" class="">
                    <div class="input-field col m3 s12">
                        <input name="name" type="text" class="validate">
                        <label for="name">Name</label>
                    </div>
                    <div class="input-field col m5 s12">
                        <input name="email" type="text" class="validate">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col m4 s12">
                        <input name="blog" type="text" class="validate">
                        <label for="blog">Blog</label>
                    </div>
                    <div class="input-field col m12 s12">
                        <textarea name="content" class="materialize-textarea"></textarea>
                        <label for="content">Content</label>
                    </div>
                    <button class="btn waves-effect waves-light col m2 offset-m5 s6 offset-s3" type="submit" name="action">Submit</button>
                </form>
            </div>
        </div>
        <section class="user-reviews">

        </section>
    </article>
</div>

<?php
HighlightAsset::register($this);
$this->registerCssFile('@web/css/article.css',['depends'=>'frontend\assets\AppAsset']);
?>