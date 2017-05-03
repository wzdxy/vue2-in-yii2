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
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'text' => $this->text(),
            'html' => $this->text(),
            'author_id'=>$this->string(),
            'author_name'=>$this->string(),
            'type'=>$this->string(),
            'tag'=>$this->string(),
            'status'=>$this->integer(),
            'created_at'=>$this->timestamp(),
            'updated_at'=>$this->timestamp(),
            'url'=>$this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
