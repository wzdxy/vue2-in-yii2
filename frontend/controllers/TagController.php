<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\Tag;
use Yii;

/**
 * Site controller
 */
class TagController extends FrontController
{
    public function actionIndex()
    {
        $url=Yii::$app->request->get('url');
        if(!isset($url)){
            $tagQuery=Tag::getAllList();
            return $this->render('all-tags',[
                'tags'=>$tagQuery
            ]);
        }else {
            $tag=Tag::findOne(['url'=>$url]);
            $articleQuery=Article::getByTagUrl($url);
            return $this->render('index',[
                'articles'=>$articleQuery,
                'tag'=>$tag
            ]);
        }


    }
}
