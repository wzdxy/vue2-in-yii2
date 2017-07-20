<?php

use yii\db\Migration;
use common\models\Relationship;

class m170720_142117_add_type_column_in_relationship_table_primary_key extends Migration
{
    public function up()
    {
        $oldData=Relationship::find()->asArray()->all();//backup old data
        Relationship::deleteAll();//clear all
        $this->dropTable('relationship');
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('relationship', [
            'cid' => $this->integer()->notNull(),
            'pid'=>$this->integer()->notNull(),
            'type'=>$this->string()->notNull(),
        ],$tableOptions);
        $this->addPrimaryKey('relationship_pk','relationship',['pid','cid','type']);
        $this->batchInsert('relationship',['cid','pid','type'],$oldData);//insert old data
    }

    public function down()
    {
        //this is an Migration can not down
        return false;
    }
}
