<?php

namespace common\models;

use Yii;
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
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url', 'description'], 'string'],
            [['status', 'type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'status' => 'Status',
            'description' => 'Description',
            'type' => 'Type',
            'count' => 'Count',
        ];
    }

    public function add(){
        if(static::find()->where(['id'=>$this->id])->count()>0)return false;
        $this->url=$this->name;
        $this->save();
        return $this->id;
    }

    public static function batchAdd($tags,$autoId){
        if($autoId)$cols=['name','url','description'];
        else $cols=['id','name','url','description'];
        $result=Yii::$app->db->createCommand()->batchInsert(static::tableName(), $cols, $tags)->execute();
    }

    public static function getAllList(){
        return static::find()->select(['id','name','description','url','count'])->where(['status'=>0])->all();
    }

    public static function getTagsByArticleId($id){
        $relationshipQuery=(new Query())->select('cid')->from('relationship')->where(['pid'=>$id,'type'=>'tag-article']);
        return Tag::find()->where(['id'=>$relationshipQuery])->all();
    }

    public static function getByName($name){
        return static::findOne(['name'=>$name]);
    }

    public function refreshCount(){
        $relationshipCount=Relationship::find()->where(['cid'=>$this->id,'type'=>'tag-article'])->count();
        $this->count=$relationshipCount;
        $this->save();
        return $relationshipCount;
    }

    public static function refreshAllCount(){
        $tagQuery=self::find()->where(['type'=>'tag-article'])->all();
        foreach($tagQuery as $tag){
            $tag->refreshCount();
        };
    }

    public static function exportAllData(){
        return self::find()->asArray()->all();
    }

    /**
     * 验证唯一性 ( $name 和 $url 不能重复 )
     * @return array|bool
     */
    public function uniqueValidate(){
        if(static::find()->where(['name'=>$this->name])->count()>0){
            return ['result'=>false,'prop'=>'name','value'=>$this->name];
        }else if(static::find()->where(['url'=>$this->url])->count()==0){
            return ['result'=>false,'prop'=>'url','value'=>$this->url];
        }else return ['result'=>true];
    }
}
