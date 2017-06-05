<?php
namespace frontend\controllers;
use Yii;
use common\models\Article;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Site controller
 */
class ArticleController extends ActiveController
{
    public $modelClass='common\models\Article';
//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
//        return $behaviors;
//    }
    public function actions(){
        $actions=parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {

//        return $this->render('index');
        return '123';
    }

    public function actionTest(){
        $title=Yii::$app->request->get();
        return $this->render('index',[
            'title'=>'heheh'
        ]);
    }
}
