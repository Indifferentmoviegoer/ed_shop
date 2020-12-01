<?php

/* @var $this yii\web\View */
use yii\widgets\LinkPager;
use yii\helpers\Html;
?>



<div class="row">
            <div class="col-lg-3">
                <div class="left-sidebar">
                    <h2>Категории</h2>
                    <ul class="catalog category-products">
                        <?= \app\components\MenuWidget::widget(['tpl'=>'menu'])?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <h1>Каталог товаров</h1>
                <?php foreach($hits as $hit):?>

                <div class="col-lg-4" text-align="center" id="myid">
                    <?php $main=$hit->getImage();?>
                    <?= Html::img($main->getUrl('200x200'))?>
                    <p class="myp"><a href="<?= \yii\helpers\Url::to(['product/view', 'id'=>$hit->id])?>"><?= $hit->name?> </a></p>
                    <h3><?= $hit->price?>р.</h3>
                    <a href="<?= \yii\helpers\Url::to(['cart/add', 'id'=>$hit->id])?>" data-id="<?= $hit->id?>"  class="add-to-cart">
                    <button type="button" class="btn btn-fefault cart">
                     <i class="fa fa-shopping-cart"></i>
                        Добавить в корзину
                    </button>
                    </a>
                </div>

        <?php endforeach;?>

            </div>
</div>
<div class="row">
            <div class="col-lg-offset-7 col-lg-5">
                <?php
                echo LinkPager::widget([
                    'pagination' => $pagination,
                ]);?>
            </div>
</div>


