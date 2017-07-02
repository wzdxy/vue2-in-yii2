<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property integer $status
 * @property string $description
 * @property integer $type
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
        ];
    }

    public function add(){
        if(static::find()->where(['id'=>$this->id])->count()>0)return false;
        $this->url=$this->name;
        $this->save();
    }

    public static function getAllList(){
        return static::find()->select(['id','name','description'])->where(['status'=>0])->asArray()->all();
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
