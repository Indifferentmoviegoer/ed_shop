<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Связаться с нами';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Благодарим Вас за обращение к нам. Мы ответим вам как можно скорее.
        </div>

<!--        <p>-->
<!--            Note that if you turn on the Yii debugger, you should be able-->
<!--            to view the mail message on the mail panel of the debugger.-->
<!--            --><?php //if (Yii::$app->mailer->useFileTransport): ?>
<!--                Because the application is in development mode, the email is not sent but saved as-->
<!--                a file under <code>--><?//= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?><!--</code>.-->
<!--                Please configure the <code>useFileTransport</code> property of the <code>mail</code>-->
<!--                application component to be false to enable email sending.-->
<!--            --><?php //endif; ?>
<!--        </p>-->

    <?php else: ?>

        <p>
            Если у вас есть деловые вопросы или другие вопросы, пожалуйста, заполните следующую форму, чтобы связаться с нами. Спасибо.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->label('Имя')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email')->label('E-mail') ?>

                    <?= $form->field($model, 'subject')->label('Тема') ?>

                    <?= $form->field($model, 'body')->label('Текст сообщения')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'verifyCode')->label('Проверочный код')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
