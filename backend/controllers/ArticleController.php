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
        $text=$post['md'];
        $title=$post['title'];
        $html=$post['html'];
        $tag=json_decode($post['tag']);
        $modal=new Article();
        $result=$modal->publish($title,$text,$html,$tag);
        if($result===0){
            return json_encode(['result'=>0,'message'=>'发布成功']);
        }else{
            return json_encode(['result'=>-1,'message'=>$result]);
        }
    }

    public function actionUpdate(){
        $post=Yii::$app->request->post();
        $articleId=$post['id'];
        $text=$post['md'];
        $title=$post['title'];
        $html=$post['html'];
        $tag=json_decode($post['tag']);
        $modal=Article::findOne($articleId);
        if($modal===null)return json_encode(['result'=>-2,'message'=>'This article is not exist']);
        $result=$modal->edit($title,$text,$html,$tag);
        if($result===0){
            return json_encode(['result'=>0,'message'=>'Update Success']);
        }else{
            return json_encode(['result'=>-1,'message'=>$result]);
        }
    }

    public function actionList(){
        $modal=new Article();
        $List=$modal->getAllList();
        return json_encode(['result'=>0,'list'=>$List]);
    }

    public function actionText(){
        $id=Yii::$app->request->get('id');
        $text=Article::getText($id);
        return json_encode(['result'=>0,'content'=>$text]);
    }
}
