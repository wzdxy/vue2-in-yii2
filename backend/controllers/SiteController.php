<?php
namespace backend\controllers;

use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\filters\Cors;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout=false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),
            [

            ]
        );
    }

    public function beforeAction($action){
        return true;
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//        echo var_dump(Yii::$app->user->isGuest)+"<br>"+var_dump(Yii::$app->user->identity);
        return $this->render('..\..\web\dist\views\admin.html');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
//        return Yii::$app->user->isGuest;
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
        $Post=Yii::$app->request->post();
        $user=User::findByUsername($Post['id']);
        if(isset($user)){
            if($user->validatePassword($Post['pw'])){
                return json_encode(['result'=>0,'token'=>$user->setToken()]);
            }else{
                return json_encode(['result'=>2,'message'=>'wrong pw']);
            };
        }else {
            return json_encode(['result'=>1,'message'=>'no user']);
        }



        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
