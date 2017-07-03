<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $html
 * @property string $author_id
 * @property string $author_name
 * @property string $type
 * @property string $tag
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $url
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'html'], 'string'],
            [['status','author_id'], 'integer'],
            [['created_at','updated_at'], 'safe'],
            [['title', 'author_name', 'type', 'tag', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'html' => 'Html',
            'author_id' => 'Author ID',
            'author_name' => 'Author Name',
            'type' => 'Type',
            'tag' => 'Tag',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'url' => 'Url',
        ];
    }

    /**
     * @param $title
     * @param $text
     * @param $html
     * @param $tags
     * @return bool
     */
    public function publish($title,$text,$html,$tags){
        $User=Yii::$app->user->getIdentity();

        $this->title=$title;
        $this->text=$text;
        $this->html=$html;
        $this->tag='';
        $this->url='';
        $this->type='';
        $this->author_id=$User->id;
        $this->author_name=$User->username;
        $this->status=0;
        if($this->save()){
            $this->addTags($tags);
            return 0;
        }else{
            return json_encode($this->errors);
        }
    }

    public function addTags($tags){
        foreach ($tags as $tag){
            if($tag->isNew && Tag::find()->where(['name'=>$tag->name])->count()==0){
                $tagModel=new Tag(['name'=>$tag->name]);
                $tagId=$tagModel->add();
            }else{
                $tagId=Tag::findOne(['name'=>$tag->name])->id;
                $rs=new Relationship(['cid'=>$tagId,'pid'=>$this->id]);
                $rs->save();
            }

        }
        return 0;
    }

    public function getAllList(){
        return self::find()->select(['id','title','author_name','created_at'])->asArray()->all();
    }

    public static function getAllHead(){
        return self::find()->select(['id','title','text','author_name','created_at'])->asArray()->all();
    }
}
