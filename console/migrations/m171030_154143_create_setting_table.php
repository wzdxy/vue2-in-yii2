<?php

use yii\db\Migration;

/**
 * Handles the creation of table `setting`.
 */
class m171030_154143_create_setting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('setting', [
            'id' => $this->primaryKey(),
            'user' => $this->integer(),
            'name' => $this->string(),
            'value' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('setting');
    }
}
