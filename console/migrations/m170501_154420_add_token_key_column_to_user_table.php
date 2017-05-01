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
        $this->addColumn('user', 'token_key', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'token_key');
    }
}
