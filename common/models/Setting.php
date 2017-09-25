<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property integer $status
 * @property string $description
 * @property integer $type
 * @property integer $count
 */
class Setting extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    public static function importFromGhost($post){
        $file=$_FILES['file']['tmp_name'];
        $fileData=json_decode(file_get_contents($file));
        if(isset($fileData->db) && isset($fileData->db[0]->data)){
            $data=$fileData->db[0]->data;
            if(isset($data->tags)){
                $tagsArray=[];
                foreach ($data->tags as $tag){
                    $tagsArray[]=[
                        'name'=>$tag->name,'url'=>$tag->slug,'description'=>$tag->description
                    ];
                }
                Tag::batchAdd($tagsArray);//TODO 数组去重
            }
            if(isset($data->posts)){

            }
            if(isset($data->posts_tags)){

            }
        }
        return true;
    }
}
