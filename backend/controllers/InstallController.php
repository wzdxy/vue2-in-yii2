<?php
namespace backend\controllers;
use common\models\InstallSite;

Class InstallController extends \yii\web\Controller {
    function beforeAction($action)
    {
        if(InstallSite::hasInstalled()){
            throw new \yii\web\NotFoundHttpException('Page not found.');
        }
        else{
            return true;
        }
    }
    function actionIndex(){
        return $this->render('index');
    }
    function actionInit(){
        $install=new InstallSite();
        $install->setAttributes($_POST);
        if($install->testDbConnect()===true){
            if($install->install()===true) return 'ok';
            else return 'install() failed';
        }else{
            return 'cannot connect db';
        }
    }
}