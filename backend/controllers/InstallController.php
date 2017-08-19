<?php
namespace backend\controllers;
use PDO;
use PDOException;

Class InstallController extends \yii\web\Controller {
    function beforeAction($action)
    {
        if(file_exists('../../config/site.php'))return false;
        else return true;
    }
    function actionIndex(){
        return $this->render('index');
    }
    function actionInit(){
        try {
            $dbh = new PDO('mysql:dbname='.$_POST['dbName'].';host=127.0.0.1', $_POST['dbUser'], $_POST['dbPassword']);
            return 'connect ok';
        } catch (PDOException $e) {
            return 'Connection failed: ' . $e->getMessage();
        }
    }
}