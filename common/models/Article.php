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
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'author_id', 'author_name', 'type', 'tag', 'url'], 'string', 'max' => 255],
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
     * @return bool
     */
    public function publish($title,$text){
        $User=Yii::$app->user->getIdentity();
        $this->title=$title;
        $this->text=$text;
        $this->author_id=$User->id;
        $this->author_name=$User->username;
        $this->status=0;
        return $this->save(false);
    }
}
