<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div id="guest-form">

    <?php if (Yii::$app->session->hasFlash('success') && $this->title != 'Create Guest'): ?>
        <?php 
            $meta = [
                'http-equiv' => 'Refresh',
                'content' => '4; url=' . Yii::$app->homeUrl,
            ];
            Yii::$app->view->registerMetaTag($meta);
        ?>
    <?php endif; ?>


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($guest, 'first_name')->textInput(['rows' => 6]) ?>

    <?= $form->field($guest, 'last_name')->textInput(['rows' => 6]) ?>

    <?= $form->field($guest, 'email')->textInput(['rows' => 6]) ?>

    <?= $form->field($guest, 'address')->textInput(['rows' => 6]) ?>

    <?= $form->field($guest, 'phone')->textInput(['rows' => 6]) ?>

    <?= $form->field($guest, 'gender')->radioList(['Male' => 'Male', 'Female' => 'Female']); ?>

</div>

<div class="d-flex">
    <?php foreach($events as $key => $event): ?>
        <?php if($event->status == "Show"):?>
                <div class="form-group mr-2">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <input type="checkbox" name="<?= $events[$key]->id ?>" value="<?= $events[$key]->id ?>" id="test" <?php if (isset($guestEvents) && in_array($events[$key]->id, $guestEvents)) echo "checked='checked'"; ?> >
                            <h5 class="card-title"><?= $event->name ?></h5>
                            <p class="card-text"><?= $event->location ?></p>
                            <p class="card-text"><?= $event->datetime ?></p>
                        </div>
                    </div>
                </div>

        <?php endif; ?>
    <?php endforeach; ?>
    </div>

    <div class="form-group text-right">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
        <?php if($this->title != 'Update Guest'): ?>
        <?= Html::resetButton('Clear Fields', ['class' => 'btn btn-outline-secondary', 'style' => 'margin: 5px;']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

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

