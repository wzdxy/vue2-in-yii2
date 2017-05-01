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
        $post=Yii::$app->request->post();
//        $header=Yii::$app->request->getHeaders('authorization');
        if(isset($header['_headers']['authorization'])){
            $user=new User();
            $user->id=
            $user->validateToken();
            $Token=$header['_headers']['authorization'];
            $Id=User::validateToken($Token);

        }else{
            return false;
        }
    }

}
