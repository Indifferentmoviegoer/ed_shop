<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 02.10.2018
 * Time: 19:35
 */

namespace app\controllers;
use app\models\Product;
use Yii;
use app\models\TestForm;
class PostController extends AppController
{
    public $layout='basic';
    public function beforeAction($action)
    {
        if($action=='index'){
            $this->enableCsrfValidation=false;
        }
        return parent::beforeAction($action);
    }

    public function actionIndex(){
    if(Yii::$app->request->isAjax){
        //debug($_POST);
        debug(Yii::$app->request->post());
        return 'test';
    }
    $model=new TestForm();
    if($model->load(Yii::$app->request->post()) ){
        if($model->validate()){
            Yii::$app->session->setFlash('success','Данные приняты');
            return $this->refresh();
        }else{
            Yii::$app->session->setFlash('error','Ошибка');
        }
    }
    $this->view->title='Все статьи';
    return $this->render('test', compact('model'));
    }
//    public function actionShow(){
//        //$this->layout='basic';
//        $this->view->title='Одна статья';
//        $this->view->registerMetaTag(['name'=>'keywords', 'content'=>'ключевики...']);
//        $this->view->registerMetaTag(['name'=>'description', 'content'=>'описание страницы...']);
//
//        $cats=Product::find()->all();
//        //$cats=Catalog::find()->orderBy(['id'=>SORT_DESC])->all();
//        //$cats=Catalog::find()->asArray()->all();
//        //$cats=Catalog::find()->asArray()->where('quantity=125')->all();
//        //$cats=Catalog::find()->asArray()->where(['quantity'=>125])->all();
//        //$cats=Catalog::find()->asArray()->where(['like','name', '%iphone%'])->all();
//        //$cats=Catalog::find()->asArray()->where(['<=','id',5])->all();
//        //$cats=Catalog::find()->asArray()->where('quantity=123')->limit(1)->one();
//        //$cats=Catalog::find()->asArray()->where('quantity=123')->count();
//        //$cats=Catalog::findOne(['quantity'=>125]);
//        //$cats=Catalog::findAll(['quantity'=>125]);
//        //$query="SELECT * FROM catalog WHERE name LIKE '%phone%'";
//        //$cats=Catalog::findBySql($query)->all();
//        //$query="SELECT * FROM catalog WHERE name LIKE :search";
//        //$cats=Catalog::findBySql($query,[':search'=>'%p%'])->all();
//
//
//        return $this->render('show',compact('cats'));
//    }
}