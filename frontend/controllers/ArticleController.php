<?php
namespace frontend\controllers;
use common\models\Tag;
use Yii;
use common\models\Article;
use yii\db\Query;

/**
 * Site controller
 */
class ArticleController extends FrontController
{
    public function actions(){
        $actions=parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        $id=Yii::$app->request->get('id');
        $articleQuery=Article::findOne($id);
        $relationshipQuery=(new Query())->select('cid')->from('relationship')->where(['pid'=>$id]);
        $tagQuery=Tag::find()->where(['id'=>$relationshipQuery])->all();
        return $this->render('index',[
            'article'=>$articleQuery,
            'tags'=>$tagQuery
        ]);
    }
}
