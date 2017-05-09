<?php

/* @var $this yii\web\View */

$this->title = '目录';
?>
<div class="site-index" style="padding-top: 5px">
    <div class="">
        <h1>Catalog</h1>
        <?php foreach ($list as $article){?>
            <div class="row">
                <div class="col s12 m8">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title"><?=$article['title']?></span>
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
    </div>
</div>
