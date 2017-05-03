<?php
namespace backend\controllers;

use Yii;
use common\models\Article;
/**
 * Site controller
 */
class ArticleController extends BackendController
{
    public function actionPublish(){
        $post=Yii::$app->request->post();
        $text=$post['content'];
        $title=$post['title'];
        $modal=new Article();
        $result=$modal->publish($title,$text);
        return $result;

    }
}
