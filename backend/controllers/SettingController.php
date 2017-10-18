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
    public function actionBackup(){
        $get=yii::$app->request->get();
        $data=Setting::exportAllData();
        if($get['target']==='file'){
//            $path=Yii::getAlias('@web/backup');
//            if(is_dir())mkdir($path);
//            file_put_contents(,json_encode($data));
            return json_encode($data);
//            $filename = $path;
//            $time=time();
//            header("Content-Type: application/force-download");
//            header("Content-Disposition: attachment; filename=control-".date("Ymd-hms").'.log');
//            readfile($filename);
        }
    }

}
