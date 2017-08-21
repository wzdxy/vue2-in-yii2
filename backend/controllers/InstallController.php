<?php
namespace backend\controllers;
use common\models\InstallSite;

Class InstallController extends \yii\web\Controller {
    function beforeAction($action)
    {
        return true;
//        if(InstallSite::hasInstalled()){
//            throw new \yii\web\NotFoundHttpException('Page not found.');
//        }
//        else{
//            return true;
//        }
    }
    function actionIndex(){
        if(InstallSite::hasInstalled()){
            throw new \yii\web\NotFoundHttpException('Page not found.');
        }
        return $this->render('index');
    }
    function actionInit(){
        if(InstallSite::hasInstalled()){
            throw new \yii\web\NotFoundHttpException('Page not found.');
        }
        $install=new InstallSite();
        $install->setAttributes($_POST);
        if($install->testDbConnect()===true){
            if($install->install()===true) return 'ok';
            else return 'install() failed';
        }else{
            return 'cannot connect db';
        }
    }

    function actionUninstall(){
        throw new \yii\web\NotFoundHttpException('Page not found.');
//        InstallSite::uninstall();
    }
}