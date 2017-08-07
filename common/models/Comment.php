<?php

namespace common\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $text
 * @property integer $author_id
 * @property string $author_name
 * @property string $author_email
 * @property string $author_blog
 * @property string $author_ip
 * @property integer $parent
 * @property integer $status
 * @property integer $type
 * @property string $created_at
 * @property string $updated_at
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'author_name', 'author_email'], 'required'],
            [['text', 'author_name', 'author_email', 'author_blog', 'author_ip'], 'string'],
            [['author_id', 'parent', 'status', 'type'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'author_id' => 'Author ID',
            'author_name' => 'Author Name',
            'author_email' => 'Author Email',
            'author_blog' => 'Author Blog',
            'author_ip' => 'Author Ip',
            'parent' => 'Parent',
            'status' => 'Status',
            'type' => 'Type',
            'created_at' => 'Create At',
            'updated_at' => 'Update At',
        ];
    }

    public function xssHandle(){
        $this->text=htmlspecialchars($this->text);
    }

    public function urlHandle(){
        $url=$this->author_blog;
        if($this->author_blog!==''){
            $this->author_blog=str_ireplace(['http://','https://'],'',$url);
        }
    }

    /**
     * @param $author_ip    {string}
     * @param $period       {integer} how many minutes before
     * @return int|string
     */
    public static function getIpCountRecent($author_ip, $period){
        //需要注意一下数据库和 PHP 时区的统一
        $startTimeStamp=date('Y-m-d H:i:s',strtotime('-'.$period.' minutes'));
        return static::find()->where(['author_ip'=>$author_ip])->andWhere(['>','created_at',$startTimeStamp])->count();
    }

    public static function getByArticleId($articleId){
        $relationshipQuery=(new Query())->select('cid')->from('relationship')->where(['pid'=>$articleId,'type'=>'comment-article']);
        return static::find()->where(['id'=>$relationshipQuery])->all();
    }

    public function beforeSave($insert)
    {
        $this->xssHandle();
        $this->urlHandle();
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}