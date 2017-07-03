<?php

use yii\db\Migration;

/**
 * Handles the creation of table `relationship`.
 */
class m170703_160943_create_relationship_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('relationship', [
            'cid' => $this->integer()->notNull(),
            'pid'=>$this->integer()->notNull()
        ],$tableOptions);
        $this->addPrimaryKey('relationship_pk','relationship',['pid','cid']);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('relationship');
    }
}
