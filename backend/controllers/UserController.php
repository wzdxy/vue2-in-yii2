<?php
namespace backend\controllers;

use Yii;
use common\models\User;
/**
 * Site controller
 */
class UserController extends BackendController
{
    public function actionList(){
        $modal=new User();
        $List=$modal->getAllList();
        return json_encode(['result'=>0,'list'=>$List]);
    }
}
