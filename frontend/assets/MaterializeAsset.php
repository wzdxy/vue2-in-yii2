<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Materialize Framework asset bundle.
 */
class MaterializeAsset extends AssetBundle
{
    public $sourcePath='@bower/materialize/dist';
    public $css = [
        'css/materialize.min.css',
    ];
    public $js = [
        'js/materialize.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset'

    ];
}
