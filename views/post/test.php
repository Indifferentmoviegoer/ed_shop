<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<h1>TEST</h1>
<?php
//debug(Yii::$app);
//debug($model);?>

<?php if(Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <?php echo Yii::$app->session->getFlash('success');?>
<?php endif;?>


<?php if(Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <?php echo Yii::$app->session->getFlash('error');?>
<?php endif;?>

<?php $form=ActiveForm::begin(['options'=>['id'=>'testForm']])?>
<?= $form->field($model,'name')->label('Имя')?>
<?= $form->field($model,'email')->input('email')?>
<?= $form->field($model,'text')->label('Текст сообщения')->textarea(['rows'=>10])?>
<?= Html::submitButton('Send',['class'=>'btn btn-success'])?>
<?php ActiveForm::end()?>