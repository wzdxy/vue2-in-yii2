<?php
namespace backend\controllers;

use common\models\Setting;
use Yii;

/**
 * Site controller
 */
class SettingController extends BackendController
{
    public function actionImport(){
        $post=yii::$app->request->post();
        if($post['src']=='ghost'){
            $r= Setting::importFromGhost($post);
            return json_encode($r);
        }

    }
}
