<?php

/* @var $this yii\web\View */

$this->title = 'Articles';
?>
<div class="content-center" style="padding-top: 5px">
    <div class="">
        <h1>All Articles</h1>
        <?php foreach ($list as $article){?>
            <div class="row">
                <div class="col s12 m8">
                    <div class="article-item card blue-grey darken-1">
                        <div class="article-content card-content white-text">
                            <a href=<?='article/'.$article['id']?> class="card-title"><?=$article['title']?></a>
                            <p><?=mb_substr($article['text'],0,140,'utf-8').(mb_strlen($article['text'])>140?"...":"")?></p>
                        </div>
                        <div class="card-action">
                            <a href="#">MORE</a>
                            <a href="#">AND?</a>
                            <span><?=$article['created_at']?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if(count($list)==0) {?>
            <p>Before you publish a article you can not see anything</p>
        <?php }?>
    </div>
</div>

<div class="article-archive">
    <ul class="collection with-header">
        <li class="collection-header"><h6>Archive</h6></li>
        <a href="#!" class="collection-item">2017-12<span class="secondary-content article-count">22</span></a>
        <a href="#!" class="collection-item ">2017-12<span class="secondary-content article-count">22</span></a>
    </ul>
</div>

<?php
$this->registerCssFile('@web/css/catalog.css');
?>