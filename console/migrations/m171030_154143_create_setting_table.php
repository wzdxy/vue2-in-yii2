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
        $this->batchInsert('setting', ['user', 'name', 'value'], [
            [0, 'admin-domain', 'admin.zchi.me'],
            [0, 'front-domain', 'front.zchi.me'],
            [0, 'index-head', 'Welcome To ZCHI \'s Blog'],
            [0, 'index-title', 'ZCHI \'s Blog']
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
