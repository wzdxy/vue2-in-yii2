<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Materialize Framework asset bundle.
 */
class HighlightAsset extends AssetBundle
{
    public $sourcePath='@bower/highlightjs';
    public $css = [
        'styles/github.css'
    ];
    public $js = [
        'highlight.pack.min.js'
    ];
    public $depends = [
    ];
}
