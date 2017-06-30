<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tag`.
 */
class m170630_150033_create_tag_table extends Migration
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
        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'name'=> $this->text(),
            'url'=>$this->text(),
            'status'=>$this->integer(),
            'description'=>$this->text(),
            'type'=>$this->integer(),
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tag');
    }
}
