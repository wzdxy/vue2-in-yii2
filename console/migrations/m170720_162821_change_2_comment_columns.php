<?php

use yii\db\Migration;

class m170720_162821_change_2_comment_columns extends Migration
{
    public function up()
    {
        $this->renameColumn('comment','create_at','created_at');
        $this->renameColumn('comment','update_at','updated_at');
    }

    public function down()
    {
        $this->renameColumn('comment','created_at','create_at');
        $this->renameColumn('comment','updated_at','update_at');
    }
}
