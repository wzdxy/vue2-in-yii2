<?php

use yii\db\Migration;

/**
 * Handles adding count to table `tag`.
 */
class m170716_100457_add_count_column_to_tag_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('tag', 'count', $this->integer()->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('tag', 'count');
    }
}
