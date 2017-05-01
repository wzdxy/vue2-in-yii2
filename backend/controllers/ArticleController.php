<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class ArticleController extends BackendController
{
    public $layout=false;
    public $enableCsrfValidation = false;
    public function actionPublish(){
        $Post=Yii::$app->request->post();
        return $Post['title'];
    }
}
