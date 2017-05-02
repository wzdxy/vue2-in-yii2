<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m170502_141015_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'body' => $this->text(),
            'author_id'=>$this->string(),
            'type'=>$this->string(),
            'tag'=>$this->string(),
            'status'=>$this->integer(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
            'url'=>$this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('post');
    }
}
