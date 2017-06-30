<?php
namespace backend\controllers;

use Yii;
use common\models\Tag;
/**
 * Site controller
 */
class TagController extends BackendController
{
    public function actionAdd(){
        $post=Yii::$app->request->post();
        $tagModel=new Tag(['type'=>1,'status'=>0]);
        $tagModel->load($post,'');
        $tagModel->url=$tagModel->name;
        $validate=$tagModel->uniqueValidate();
        if(false===$validate['result'])
            return json_encode(['result'=>-1,'message'=>$validate['prop']]);
        else {
            if($tagModel->insert()){
                return json_encode(['result'=>0,'message'=>'success']);
            }else return json_encode(['result'=>-2,'message'=>'insert db error']);
        }
    }

    public function actionList(){
        return json_encode(Tag::getAllList());
    }
}
