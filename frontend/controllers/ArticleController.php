<?php
namespace frontend\controllers;
use Yii;
use common\models\Article;

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
        $query=Article::findOne($id);
        return $this->render('index',[
            'article'=>$query
        ]);
    }
}
