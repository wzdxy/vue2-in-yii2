<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\Comment;
use common\models\Relationship;
use Yii;

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
        if(Article::find()->where(['id'=>$articleId])->count()===0)return json_encode(['result'=>-1,'message'=>'article is not exist']);
        if($model->load($post,'') && $model->save()){
            (new Relationship(['cid'=>$articleId,'pid'=>$model->id,'type'=>'comment-article']))->save();
            return json_encode(['result'=>0]);
        }else{
            return var_dump($model->errors);
        }
    }
}
