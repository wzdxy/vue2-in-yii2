<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;

class BackendController extends Controller
{
    public $layout=false;
    public $enableCsrfValidation = false;
    public function beforeAction($action){
        $token_key=Yii::$app->request->headers->get('authorization');
        if(isset($token_key)){
            $modal=new User();
            return $modal->validateToken($token_key);
        }else{
            return false;
        }
    }

}
