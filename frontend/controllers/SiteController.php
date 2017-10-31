<?php

namespace frontend\controllers;

use common\models\Setting;
use frontend\models\ContactForm;
use Yii;

/**
 * Site controller
 */
class SiteController extends FrontController
{

    public function actionIndex()
    {
        $settingsQuery = Setting::find()->where(['name' => ['index-head', 'index-title']])->asArray()->all();
        $settings=[];
        foreach ($settingsQuery as $idx=>$item){
            $settings[$item['name']]=$item['value'];
        }
        return $this->render('index',[
            'settings'=>$settings
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
