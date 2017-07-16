<?php

/* @var $this yii\web\View */

$this->title = 'Tags';
?>
<div class="site-index" style="padding-top: 5px">
    <div class="">
        <h1>All Tags</h1>
        <div class="collection">
            <?php foreach ($tags as $idx=>$tag){?>
                <a href="/tag/<?=$tag->url?>" class="collection-item"><span class="badge"><?=$tag->count?></span><?=$tag->name?></a>
            <?php }?>
        </div>
    </div>
</div>
