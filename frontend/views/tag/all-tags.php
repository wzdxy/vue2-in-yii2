<?php

/* @var $this yii\web\View */

$this->title = 'Tags';
?>
<div class="content-center row" style="padding-top: 5px">
    <div class="col s12 m12">
        <h1>All Tags</h1>
        <div class="collection">
            <?php foreach ($tags as $idx=>$tag){?>
                <a href="/tag/<?=$tag->url?>" class="collection-item"><span class="badge"><?=$tag->count?></span><?=$tag->name?></a>
            <?php }?>
        </div>
    </div>
</div>
