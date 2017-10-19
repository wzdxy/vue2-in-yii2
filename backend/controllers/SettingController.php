<?php

namespace backend\controllers;

use common\models\Setting;
use Yii;

/**
 * Site controller
 */
class SettingController extends BackendController
{
    public function actionImport()
    {
        $post = yii::$app->request->post();
        if ($post['src'] == 'ghost') {
            $r = Setting::importFromGhost($post);
            return json_encode($r);
        } else if ($post['src']==='backup'){
            $r = Setting::importFromBackup($post);
            return json_encode($r);
        }
    }

    public function actionBackup()
    {
        $get = yii::$app->request->get();
        $data = Setting::exportAllData();
        if ($get['target'] === 'file') {
            $path = Yii::getAlias('@web/backup');
            if (!is_dir($path)) mkdir($path);
            $filename = $path . date("Ymd-hms") . '.json';
            file_put_contents($filename, json_encode($data));
//            return json_encode($data);

            header("Content-Type: application/force-download");
            header("Content-Disposition: attachment; filename=" . date("Ymd-hms") . '.json');
            readfile($filename);
        }
    }

}
