<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 11.10.2018
 * Time: 17:52
 */

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;

class ProductController extends AppController
{
    public function actionView($id){
        $id=Yii::$app->request->get('id');
        $product=Product::findOne($id);
        $this->setMeta($product->name);
        return $this->render('view',compact('product'));
    }
}