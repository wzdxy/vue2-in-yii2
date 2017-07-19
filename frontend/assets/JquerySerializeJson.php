<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * jquery.serializeJSON asset bundle.
 */
class JquerySerializeJson extends AssetBundle
{
    public $sourcePath='@bower/jquery.serializeJSON';
    public $css = [];
    public $js = [
        'jquery.serializejson.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
