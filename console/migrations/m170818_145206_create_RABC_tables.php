<?php

use yii\db\Migration;

class m170818_145206_create_RABC_tables extends Migration
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
        // group TABLE
        $this->createTable('group', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(),
        ],$tableOptions);

        $this->batchInsert('group',['name'],[
            ['name'=>'master'],['name'=>'admin'],['name'=>'editor'],['name'=>'author'],
        ]);

        // permission TABLE
        $this->createTable('permission', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(),
            'description'=>$this->text()
        ],$tableOptions);

        $permission=[
            ['id'=>1,'name'=>'article_add','description'=>'添加文章','group'=>[1,2,3,4]],
            ['id'=>2,'name'=>'article_delete_self','description'=>'','group'=>[1,2,3,4]],
            ['id'=>3,'name'=>'article_delete_all','description'=>'','group'=>[1,2,3]],
            ['id'=>4,'name'=>'article_review','description'=>'','group'=>[1,2,3]],
            ['id'=>5,'name'=>'article_edit_self','description'=>'','group'=>[1,2,3,4]],
            ['id'=>6,'name'=>'article_edit_all','description'=>'','group'=>[1,2,3]],
            ['id'=>7,'name'=>'comment_delete_self','description'=>'','group'=>[1,2]],
            ['id'=>8,'name'=>'comment_delete_all','description'=>'','group'=>[1,2]],
            ['id'=>9,'name'=>'message_delete','description'=>'','group'=>[1,2]],
            ['id'=>10,'name'=>'system_site_description','description'=>'','group'=>[1]],
            ['id'=>11,'name'=>'system_index_head','description'=>'','group'=>[1]],
            ['id'=>12,'name'=>'system_site_description','description'=>'','group'=>[1]],
            ['id'=>13,'name'=>'system_site_theme','description'=>'','group'=>[1]],
            ['id'=>14,'name'=>'user_add','description'=>'','group'=>[1,2]],
            ['id'=>15,'name'=>'user_group','description'=>'','group'=>[1,2]],
            ['id'=>16,'name'=>'user_invite','description'=>'','group'=>[1,2]],
            ['id'=>17,'name'=>'user_delete','description'=>'','group'=>[1]],
            ['id'=>18,'name'=>'guest_ban_ip','description'=>'','group'=>[1,2]],
        ];

        $permissionInsert=[];
        foreach ($permission as $idx=>$item){
            $permissionInsert[]=[$item['id'],$item['name'],$item['description']];
        }
        $this->batchInsert('permission',['id','name','description'],$permissionInsert);

        // INSERT relation
        $relationInsert=[];
        foreach ($permission as $idx=>$item){
            foreach ($item['group'] as $group) {
                $relationInsert[]=[$item['id'],$group,'group-permission'];
            }
        }
        $this->batchInsert('relationship',['cid','pid','type'],$relationInsert);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('group');
        $this->dropTable('permission');
        $this->delete('relationship',['type'=>'group-permission'],[]);
    }
}
