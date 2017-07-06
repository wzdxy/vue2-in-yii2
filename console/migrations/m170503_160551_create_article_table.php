<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m170503_160551_create_article_table extends Migration
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
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'text' => $this->text(),
            'html' => $this->text(),
            'author_id'=>$this->integer(),
            'author_name'=>$this->string(),
            'type'=>$this->string(),
            'tag'=>$this->string(),
            'status'=>$this->integer(),
            'created_at'=>$this->timestamp(),
            'updated_at'=>$this->timestamp()->defaultExpression('0 ON UPDATE CURRENT_TIMESTAMP'),
            'url'=>$this->string()
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
