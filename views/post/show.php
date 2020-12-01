<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>


<?php
//$this->title = 'Одна статья';
?>
<?php $this->beginBlock('block1');?>
    <h1>Zagolovok</h1>
<?php $this->endBlock(); ?>
<h1>SHOW</h1>




    <?php
    //$models =$dataProvider->getData();
    foreach($cats as $cat)
    {

        echo $cat->img.'<br>';
        echo $cat->name.'<br>';
        echo $cat->price.'<br>';
        echo $cat->quantity.'<br>';

    }
    ?>

<button class="btn btn-success" id="btn">Clickni</button>

<?php //$this->registerJsFile('@web/js/scripts.js',['depends'=>'yii\web\YiiAsset'])?>
<?php //$this->registerJS("$('.container').append('<p>SH</p>');",\yii\web\View::POS_LOAD)?>
<?php //$this->registerCss('.container{background:#ccc}')?>
<?php

$js=<<<JS
$('#btn').on('click',function() {
  $.ajax(
      {
      url:'index.php?r=post/index',
      data: {test:'123'},
      type: 'POST',
      success:function(res) {
        console.log(res);
      },
      error: function() {
        alert('Error');
      }
      }
  )
})
JS;
$this->registerJS($js);

?>
