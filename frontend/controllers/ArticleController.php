<?php
namespace frontend\controllers;
use common\models\Comment;
use common\models\Tag;
use Yii;
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
            return Yii::$app->runAction('catalog/index');
        }
        $articleQuery=Article::findOne($id);
        $tagQuery=Tag::getTagsByArticleId($id);
        $commentQuery=Comment::getByArticleId($id);
        return $this->render('index',[
            'article'=>$articleQuery,
            'tags'=>$tagQuery,
            'comments'=>$commentQuery
        ]);
    }
}
