<?php
namespace frontend\controllers;
use Yii;
use common\models\Article;

/**
 * Site controller
 */
class ArchiveController extends FrontController
{
    public function actionIndex()
    {
        $month=Yii::$app->request->get('month');
        if(isset($month)){
            $startTime=$month.'-01 00:00:00';
            $endTime=$month.'-31 00:00:00';
            return $this->render('list',[
                'list'=>Article::getHead(['and',['between','created_at',$startTime,$endTime],['status'=>0]]),
                'archive'=>Article::getArchive(),
                'month'=>$month
            ]);
        }else{
            return $this->render('list',[
                'list'=>Article::getHead(['status'=>0]),
                'archive'=>Article::getArchive(),
                'month'=>'All'
            ]);
        }
    }
}
