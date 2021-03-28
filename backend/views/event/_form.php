<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="event-form">

    <?php if (Yii::$app->session->hasFlash('success') && ($this->title != 'Create Guest') && ($this->title != 'Create Event')): ?>
        <?php 
            $meta = [
                'http-equiv' => 'Refresh',
                'content' => '4; url=index',
            ];
            Yii::$app->view->registerMetaTag($meta);
        ?>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['rows' => 6]) ?>

    <?= $form->field($model, 'datetime')->widget(DateTimePicker::className(), [
        'size' => 'ms',
        'template' => '{input}',
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'inline' => false,
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'MM dd yyyy hh:ii',
            'todayBtn' => true
        ]
    ]);?>

    <?= $form->field($model, 'location')->textInput(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->radioList(['Show' => 'Show', 'Hide' => 'Hide']); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS

$(".alert-dismissible")
   .fadeIn( function() 
   {
      setTimeout( function()
      {
         $(".alert-dismissible").fadeOut("fast");
      }, 3500);
   });

JS;

$this->registerJs($script);

?>

