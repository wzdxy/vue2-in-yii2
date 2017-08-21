<?php
namespace common\models;

use PDO;
use PDOException;
use Yii;
use yii\base\Model;
use yii\db\Migration;

class InstallSite extends Model
{
    public $dbName;
    public $dbUser;
    public $dbPassword='';
    public $dbPrefix='';
    public $adminDomain;
    public $frontDomain;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dbName', 'dbUser'], 'required'],
        ];
    }

    public static function hasInstalled(){
        $configFile=Yii::getAlias('@common').'/config/site.php';
        if(file_exists($configFile)){
            $config=require $configFile;
            if(isset($config['db'])){
                return true;
            }else {
                return false;
            }
        }
        return file_exists($configFile);
    }

    public function initDatabase(){
        try{
            $sql=file_get_contents('../Mysql.sql');
            $dbh = new PDO('mysql:dbname='.$this->dbName.';host=127.0.0.1', $this->dbUser, $this->dbPassword);
            $dbh->exec($sql);
            $dbh=null;
            return true;
        } catch (PDOException $e){
            return $e->getMessage();
        }
    }

    public function testDbConnect(){
        try {
            $dbh = new PDO('mysql:dbname='.$this->dbName.';host=127.0.0.1', $this->dbUser, $this->dbPassword);
            $dbh=null;
            return true;
        } catch (PDOException $e) {
            return 'Connection failed: ' . $e->getMessage();
        }
    }

    private function writeConfigFile(){
        $config=[];
        $configFile=Yii::getAlias('@common').'/config/site.php';
        if(file_exists($configFile)){
            $config=require $configFile;
        };
        $config['db']=$this->generateDbConfig();
        $config['mailer']=$this->generateMailerConfig();
        $text="<?php return\n".var_export($config,true)."?>";
        return file_put_contents($configFile,$text);
    }

    public function install(){
        $this->initDatabase();
        $this->writeConfigFile();
//        $this->createInitiallyData();
        return true;
    }

    private function createInitiallyData(){
//        $curPdo=(new Connection)->getMasterPdo();
        Yii::$app->db->close();
//        $curPdo=null;
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
        Yii::$app->db->createCommand()->batchInsert('group',['name'],[
            ['name'=>'master'],['name'=>'admin'],['name'=>'editor'],['name'=>'author'],
        ]);
        $permissionInsert=[];
        foreach ($permission as $idx=>$item){
            $permissionInsert[]=[$item['id'],$item['name'],$item['description']];
        }
        Yii::$app->db->createCommand()->batchInsert('permission',['id','name','description'],$permissionInsert);

        // INSERT relation
        $relationInsert=[];
        foreach ($permission as $idx=>$item){
            foreach ($item['group'] as $group) {
                $relationInsert[]=[$item['id'],$group,'group-permission'];
            }
        }
        Yii::$app->db->createCommand()->batchInsert('relationship',['cid','pid','type'],$relationInsert);
        return true;
    }

    private function generateMailerConfig(){
        return [

        ];
    }

    private function generateDbConfig(){
        return [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname='.$this->dbName,
            'username' => $this->dbUser,
            'password' => $this->dbPassword,
            'charset' => 'utf8',
            'tablePrefix'=>$this->dbPrefix,
        ];
    }

    public static function uninstall(){
        (new Migration())->dropTable('relationship');
        (new Migration())->dropTable('user');
        (new Migration())->dropTable('group');
        (new Migration())->dropTable('permission');
        (new Migration())->dropTable('article');
        (new Migration())->dropTable('comment');
        (new Migration())->dropTable('tag');
        $configFile=Yii::getAlias('@common').'/config/site.php';
        if(file_exists($configFile)){
            $text="<?php return\n".var_export([],true)."?>";
            return file_put_contents($configFile,$text);
        }else return false;

    }

}
