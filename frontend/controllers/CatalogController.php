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
            'list'=>Article::getAllHead()
        ]);
    }

    public function actionArticle(){

    }
}
