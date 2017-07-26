<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\Comment;
use common\models\Relationship;
use Yii;
use yii\db\Transaction;

/**
 * Site controller
 */
class CommentController extends FrontController
{
    public function actionIndex()
    {
        return $this->render('index',[]);
    }

    public function actionAdd(){
        $model=new Comment();
        $post=Yii::$app->request->post();
        $model->author_ip=Yii::$app->request->userIP;
        if(Comment::getIpCountRecent($model->author_ip,5)>=5){
            return json_encode(['result'=>-2,'message'=>'you had reviewed too many , have a rest']);
        };
        $articleId=$post['article_id'];
        $articleModel=Article::findOne($post['article_id']);// new Article(['id'=>intval($post['article_id'])]);
        if($articleModel===null)return json_encode(['result'=>-1,'message'=>'article is not exist']);
        if($model->load($post,'') && $model->save()){
            (new Relationship(['cid'=>$model->id,'pid'=>$articleId,'type'=>'comment-article']))->save();
            $articleModel->countComments();
            return json_encode(['result'=>0]);
        }else{
            return var_dump($model->errors);
        }
    }
}
