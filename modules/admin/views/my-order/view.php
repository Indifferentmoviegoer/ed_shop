<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MyOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my-order-view">

    <h1>Просмотр заказа №<?= $model->id ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить данный заказ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'qty',
            'sum',
//            'status',
        [
                 'attribute'=>'status',
                 'value'=>!$model->status ? '<span class="text-danger">Активен</span>' : '<span class="text-success">Завершен</span>',
                 'format'=>'raw',
                ],
            'name',
            'email:email',
            'phone',
            'address'
        ],
    ]) ?>

    <?php $items=$model->myOrderItems;?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thed>
                <tr>
<!--                    <th>Фото</th>-->
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Cумма</th>
<!--                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>-->
<!--                </tr>-->
            </thed>
            <tbody>
            <?php foreach ($items as $item):?>
                <tr>
<!--                    <td>--><?//= \yii\helpers\Html::img("@web/img/{$item['img']}",['alt'=>$item['name'],'width'=>50])?><!--</td>-->
                    <td><a href="<?=\yii\helpers\Url::to(['/product/view','id'=>$item->product_id])?>"><?= $item['name']?></a></td>
                    <td><?= $item['qty_item']?></td>
                    <td><?= $item['price']?></td>
                    <td><?= $item['sum_item']?></td>
<!--                    <td><span data-id="--><?//= $id?><!--" class="glyphicon glyphicon-remove text-danger del-item mydelproduct" aria-hidden="true"></span></td>-->
                </tr>
            <?php endforeach;?>
<!--            <tr>-->
<!--                <td colspan="5">Итого</td>-->
<!--                <td>--><?//= $session['cart.qty']?><!--</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td colspan="5">На сумму:</td>-->
<!--                <td>--><?//= $session['cart.sum']?><!--</td>-->
<!--            </tr>-->
            </tbody>
        </table>
    </div>

</div>
