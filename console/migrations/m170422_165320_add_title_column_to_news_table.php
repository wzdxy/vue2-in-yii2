<?php

use yii\db\Migration;

/**
 * Handles adding title to table `news`.
 */
class m170422_165320_add_title_column_to_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('news', 'title', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('news', 'title');
    }
}
