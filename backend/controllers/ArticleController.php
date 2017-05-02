<?php
namespace backend\controllers;

use Yii;
use common\models\Post;
/**
 * Site controller
 */
class ArticleController extends BackendController
{
    public function actionPublish(){
        $post=Yii::$app->request->post();
        $body=$post['content'];
        $title=$post['title'];
        $modal=new Post();
        return $modal->publish($title,$body);
    }
}
