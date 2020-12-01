<?php

/* @var $this yii\web\View */
use yii\widgets\LinkPager;
use yii\helpers\Html;
?>
<!--            <div class="row personal">-->

    <div class="row">
        <div class="col-lg-3">
            <div class="left-sidebar">
                <h2>Категории</h2>
                <ul class="catalog category-products">
                    <?= \app\components\MenuWidget::widget(['tpl'=>'menu'])?>
                </ul>
            </div>
        </div>


        <?php
        $main=$product->getImage();
        $gallery=$product->getImages();
        ?>


        <div class="col-lg-9">
            <div class="col-lg-6">
                <div class="view-product">
                    <?= Html::img($main->getUrl(), ['width'=>'420px'])?>
                </div>
<!--                <div id="similar-product" class="carousel slide" data-ride="carousel">-->
<!--                    <div class="carousel-inner">-->
<!--                        --><?php //$count=count($gallery); $i=0; foreach($gallery as $img): ?>
<!--                            --><?php //if($i%3==0 || $i==$count):?>
<!--                        <div class="item --><?php //if($i==0) echo 'active'?><!--">-->
<!--                            --><?php //endif;?>
<!--                            <a href=""> --><?//= Html::img($img->getUrl('99x100'))?><!--</a>-->
<!--                            --><?php //$i++; if($i%3==0 || $i==$count):?>
<!--                        </div>-->
<!--                            --><?php //endif;?>
<!--                            --><?php //endforeach;?>
<!--                        <a class="left item-control" href="#similar-product" data-slide="prev">-->
<!--                            <i class="fa fa-angle-left"></i>-->
<!--                        </a>-->
<!--                        <a class="right item-control" href="#similar-product" data-slide="next">-->
<!--                            <i class="fa fa-angle-right"></i>-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
            <div class="col-lg-6">
                <div class="product-information colorlink">
                    <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                    <h2 class="product"><?= $product->name?></h2>
                    <h2><?= $product->price?> р.</h2>
                    <label>Количество:</label>
                    <input type="text" value="1" id="qty" size="6px"/><br>
                    <a href="<?= \yii\helpers\Url::to(['cart/add', 'id'=>$product->id])?>" data-id="<?= $product->id?>"  class="add-to-cart">
                        <button type="button" class="btn btn-fefault cart">
                            <i class="fa fa-shopping-cart"></i>
                            Добавить в корзину
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>



<div class="row">
    <div class="col-lg-offset-3 col-lg-9">
        <h2>О товаре</h2>
        <p><?=$product->content?></p>
    </div>
</div>
