<?php
namespace frontend\controllers;

use common\models\Article;

/**
 * Site controller
 */
class CatalogController extends FrontController
{
    public function actionIndex()
    {
        return $this->render('index',[
            'list'=>Article::getHead(null)
        ]);
    }

    public function actionArticle(){

    }
}
