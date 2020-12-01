<?php
/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 13.10.2018
 * Time: 17:35
 */

namespace app\controllers;
use app\models\Product;
use app\models\Cart;
use app\models\MyOrder;
use app\models\MyOrderItems;
use Yii;

class CartController extends AppController
{
    public function actionAdd(){
        $id=Yii::$app->request->get('id');
        $qty=(int)Yii::$app->request->get('qty');
        $qty=!$qty ? 1 : $qty;
        $product=Product::findOne($id);
        if(empty($product)) return false;
        $session=Yii::$app->session;
        $session->open();
        $cart=new Cart();
        $cart->addToCart($product,$qty);
        $this->layout=false;
        return $this->render('cart-modal',compact('session'));
    }

    public function actionClear(){
        $session=Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout=false;
        return $this->render('cart-modal',compact('session'));
    }
    public function actionDelProduct(){
        $id=Yii::$app->request->get('id');
        $session=Yii::$app->session;
        $session->open();
        $cart=new Cart();
        $cart->recalc($id);
        $this->layout=false;
        return $this->render('cart-modal',compact('session'));
    }
    public function actionShowCart(){
        $session=Yii::$app->session;
        $session->open();
        $this->layout=false;
        return $this->render('cart-modal',compact('session'));
    }
    public function actionView(){
        $session=Yii::$app->session;
        $session->open();
        $this->setMeta('Корзина');
        $order= new MyOrder();
        if($order->load(Yii::$app->request->post())){
            $order->qty=$session['cart.qty'];
            $order->sum=$session['cart.sum'];
            if($order->save()){
                $this->saveMyOrderItems($session['cart'],$order->id);
                Yii::$app->session->setFlash('success','Заказ оформлен');
                Yii::$app->mailer->compose('order',['session'=>$session])
                    ->setFrom(['voloshchenko_ivan_1999@mail.ru'=>'ED-SHOP'])
                    ->setTo($order->email)
                    ->setSubject('Заказ')
                    ->send();
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            }else{
                Yii::$app->session->setFlash('error','Ошибка');
            }
        }
        return $this->render('view',compact('session','order'));
    }
    protected function saveMyOrderItems($items,$order_id){
        foreach ($items as $id=>$item){
            $order_items=new MyOrderItems();
            $order_items->order_id=$order_id;
            $order_items->product_id=$id;
            $order_items->name=$item['name'];
            $order_items->price=$item['price'];
            $order_items->qty_item=$item['qty'];
            $order_items->sum_item=$item['qty']*$item['price'];
            $order_items->save();
        }
    }
}