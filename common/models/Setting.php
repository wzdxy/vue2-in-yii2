<?php

namespace common\models;

use Yii;
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
        $user=Yii::$app->user->identity;
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
                $articlesArray=[];
                foreach ($data->posts as $post){
                    $articlesArray[]=[
                        'title'=>$post->title,
                        'text'=>$post->markdown,
                        'html'=>$post->html,
                        'author_id'=>$user->id,
                        'author_name'=>$user->username,
                        'type'=>null,
                        'tag'=>null,
                        'status'=>0,
                        'created_at'=>$post->created_at,
                        'updated_at'=>$post->updated_at,
                        'url'=>$post->slug,
                        'comment_count'=>0
                    ];
                }
                $r=Article::batchAdd($articlesArray);
            }
            if(isset($data->posts_tags)){
                foreach ($data->posts_tags as $relation){
                    foreach ($data->tags as $tag){
                        if($tag->id===$relation->tag_id){
                            $existTag=Tag::getByName($tag->name);
                        }
                    }
                    if(isset($tagName)){

                    }
                    foreach ($data->posts as $post){
                        if($post->id===$relation->post_id){
                            $existArticle=Article::getByUrl($post->slug);
                        }
                    }
                    if(isset($existArticle) && isset($existTag)){
                        (new Relationship(['cid'=>$existTag->id,'pid'=>$existArticle->id,'type'=>'tag-article']))->save();
                    }
                }
            }
        }
        return ['code'=>0];
    }

    public static function exportAllData(){
        $data = [
            'article'=>Article::exportAllData(),
            'tag'=>Tag::exportAllData(),
            'comment'=>Comment::exportAllData(),
            'relation'=>Relationship::exportAllData()
        ];
        return $data;
    }
}
