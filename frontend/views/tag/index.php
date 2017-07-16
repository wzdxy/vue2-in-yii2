<?php

/* @var $this yii\web\View */

$this->title = '目录';
?>
<div class="site-index" style="padding-top: 5px">
    <div class="">
        <h2><?=isset($tag)?$tag->name:''?></h2>
        <div class="collection">
            <?php if($articles!==false && count($articles)>0) {?>
                <?php foreach ($articles as $idx=> $article){
                    echo '<a href="/article/'.$article->id.'" class="collection-item"><span class="badge">'.$article->author_name.'</span>'.$article->title.'</a>';
                }?>
            <?php }else {?>
                沒有內容
            <?php } ?>

        </div>
    </div>
</div>
