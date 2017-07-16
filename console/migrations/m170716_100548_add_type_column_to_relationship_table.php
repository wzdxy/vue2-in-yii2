<?php

use yii\db\Migration;

/**
 * Handles adding type to table `relationship`.
 */
class m170716_100548_add_type_column_to_relationship_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('relationship', 'type', $this->text()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('relationship', 'type');
    }
}
