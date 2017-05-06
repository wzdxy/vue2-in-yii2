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
            if($modal->validateToken($token_key)){
                return true;
            }else{
                return json_encode(['result'=>-1,'message'=>'用户验证失败']);
            }
        }else{
//            return false;
            return json_encode(['result'=>-1,'message'=>'用户验证失败']);
        }
    }

}
