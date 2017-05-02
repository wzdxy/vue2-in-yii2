<?php

namespace common\models;

use Yii;
use common\models\User;
/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property string $author_id
 * @property string $type
 * @property string $tag
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $url
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'author_id', 'type', 'tag', 'url'], 'string', 'max' => 255],
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
            'body' => 'Body',
            'author_id' => 'Author ID',
            'type' => 'Type',
            'tag' => 'Tag',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'url' => 'Url',
        ];
    }

    public function publish($title,$body){
        $this->title=$title;
        $this->body=$body;
//        $this->author_id=Yii::$app->user->id;
        return $this->save();
    }
}
