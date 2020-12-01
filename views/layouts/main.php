<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Raleway">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/web/img/icon.png" type="image/x-icon" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'id'=>'main',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
            $menuItems = [
                    ['label' => 'Главная', 'url' => ['/']],
                    ['label' => 'О компании', 'url' => ['/about']],
                    ['label' => 'Обратная связь', 'url' => ['/contact']],
                    ['label' => 'Корзина', 'options' => ['onclick'=>'return getCart()']],
                    ['label' => 'Заказы', 'url' => ['/admin/my-order'], 'visible'=>Yii::$app->user->identity->username=='admin'],
                    ['label' => 'Категории', 'url' => ['/admin/category'], 'visible'=>Yii::$app->user->identity->username=='admin'],
                    ['label' => 'Продукты', 'url' => ['/admin/product'], 'visible'=>Yii::$app->user->identity->username=='admin'],
                    ['label' => 'Пользователи', 'url' => ['/admin/user'], 'visible'=>Yii::$app->user->identity->username=='admin'],
];

if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
    $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Выйти (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';
}

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items'=>$menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">©Voloshchenko Ivan <?= date('Y') ?></p>

<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php
\yii\bootstrap\Modal::begin([
    'header'=>'<h2>Корзина</h2>',
    'id'=>'cart',
    'size'=>'modal-lg',
    'footer'=>'<button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
        <a href="'. \yii\helpers\Url::to(['cart/view']).'" class="btn btn-success">Оформить заказ</a>
        <button type="button" class="btn btn-danger" onclick="clearCart()">Очистить корзину</button>'
]);
\yii\bootstrap\Modal::end();
?>

<?php if (class_exists('yii\debug\Module')) {
$this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
