<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotAcceptableHttpException;

/**
 * Site controller
 */
class ArticleController extends BackendController
{
    public $layout=false;
    public $enableCsrfValidation = false;
    public function actionPublish(){
//        Yii::$app->response->statusCode = 401;
//        throw new NotAcceptableHttpException('myqx');
        $post=Yii::$app->request->post();
        return $post['title'];
    }
}
