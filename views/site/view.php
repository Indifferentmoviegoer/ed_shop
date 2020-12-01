<?php

/* @var $this yii\web\View */
use yii\widgets\LinkPager;
use yii\helpers\Html;
?>


<?php if(!empty($products)):?>


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
                <h1 text-align="center"><?= $category->name?></h1>
                <?php foreach($products as $product):?>

                <div class="col-lg-4" id="myid">
                    <?php $main=$product->getImage();?>
                    <?= Html::img($main->getUrl('200x200'))?>
                    <p class="myp"><a href="<?= \yii\helpers\Url::to(['product/view', 'id'=>$product->id])?>"><?= $product->name?> </a></p>
                    <h3><?= $product->price?>р.</h3>
                    <a href="<?= \yii\helpers\Url::to(['cart/add', 'id'=>$product->id])?>" data-id="<?= $product->id?>"  class="add-to-cart">
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


<?php else:?>
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
        <h2>В данной категории временно отсутствует товар...</h2>
    </div>
</div>
<?php endif;?>
