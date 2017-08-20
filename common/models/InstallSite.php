<?php
namespace common\models;

use PDO;
use PDOException;
use Yii;
use yii\base\Model;

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
            $x=file_get_contents($configFile);
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
        $text='<?php '.var_export($config,true).'?>';
        return file_put_contents($configFile,$text);
    }

    public function install(){
        $this->initDatabase();
        $this->writeConfigFile();
        $this->createInitiallyData();
        return true;
    }

    private function createInitiallyData(){
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

}
