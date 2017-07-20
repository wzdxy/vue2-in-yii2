<?php

namespace common\models;

use Yii;

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
 * @property string $create_at
 * @property string $update_at
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
            [['create_at', 'update_at'], 'safe'],
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
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }
}
