<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "relationship".
 *
 * @property integer $cid
 * @property integer $pid
 */
class Relationship extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relationship';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'pid'], 'required'],
            [['cid', 'pid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => 'Cid',
            'pid' => 'Pid',
        ];
    }

    public static function exportAllData(){
        return self::find()->asArray()->all();
    }

    public static function batchAdd($relation){
        $cols=['cid','pid','type'];
        return $result=Yii::$app->db->createCommand()->batchInsert(static::tableName(), $cols, $relation)->execute();
    }
}
