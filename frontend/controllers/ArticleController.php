<?php
namespace frontend\controllers;
use common\models\Comment;
use common\models\Tag;
use Yii;
use yii\web;
use common\models\Article;
use yii\db\Query;

/**
 * Site controller
 */
class ArticleController extends FrontController
{
    public function actionIndex()
    {
        $id=Yii::$app->request->get('id');
        if(!isset($id)){
            return $this->render('list',[
                'list'=>Article::getAllHead(),
                'archive'=>Article::getArchive()
            ]);
        }
        $articleQuery=Article::findOne(['id'=>$id,'status'=>0]);
        if($articleQuery===null){
            return '404';
        }
        $tagQuery=Tag::getTagsByArticleId($id);
        $commentQuery=Comment::getByArticleId($id);
        return $this->render('item',[
            'article'=>$articleQuery,
            'tags'=>$tagQuery,
            'comments'=>$commentQuery
        ]);
    }
}
