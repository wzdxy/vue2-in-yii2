<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m170718_162607_create_comment_table extends Migration
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
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'text'=> $this->text()->notNull(),
            'author_id'=>$this->integer(),
            'author_name'=>$this->text()->notNull(),
            'author_email'=>$this->text()->notNull(),
            'author_blog'=>$this->text(),
            'author_ip'=>$this->text(),
            'parent'=>$this->integer(),
            'status'=>$this->integer(),
            'type'=>$this->integer(),
            'create_at'=>$this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'update_at'=>$this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('comment');
    }
}
