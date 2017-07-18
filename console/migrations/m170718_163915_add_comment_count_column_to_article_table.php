<?php

use yii\db\Migration;

/**
 * Handles adding comment_count to table `article`.
 */
class m170718_163915_add_comment_count_column_to_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('article', 'comment_count', $this->integer()->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('article', 'comment_count');
    }
}
