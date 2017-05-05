<?php

use yii\db\Migration;

/**
 * Handles adding token_key to table `user`.
 */
class m170501_154420_add_token_key_column_to_user_table extends Migration
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
        $this->addColumn('user', 'token_key', $this->text(),$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'token_key');
    }
}
