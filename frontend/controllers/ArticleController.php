<?php
namespace frontend\controllers;

use common\models\Article;

/**
 * Site controller
 */
class ArticleController extends FrontController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
