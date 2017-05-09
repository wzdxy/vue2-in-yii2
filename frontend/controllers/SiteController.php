<?php
namespace frontend\controllers;
use frontend\models\ContactForm;
use Yii;

/**
 * Site controller
 */
class SiteController extends FrontController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
