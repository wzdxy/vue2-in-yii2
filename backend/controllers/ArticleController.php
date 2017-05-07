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
        if($result===0){
            return json_encode(['result'=>0,'message'=>'发布成功']);
        }else{
            return json_encode(['result'=>-1,'message'=>$result]);
        }
    }

    public function actionList(){
        $modal=new Article();
        $List=$modal->getAllList();
        return json_encode(['result'=>0,'list'=>$List]);
    }
}
