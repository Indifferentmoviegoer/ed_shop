<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MyOrder */

$this->title = 'Create My Order';
$this->params['breadcrumbs'][] = ['label' => 'My Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
