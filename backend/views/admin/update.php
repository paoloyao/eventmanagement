<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Guest */

$this->title = 'Update Guest';
$this->params['breadcrumbs'][] = "/ ".$this->title;
?>
<div class="guest-update">

    <?= $this->render('_form', [
        'guest' => $guest,
        'events' => $events, 
        'guestEvents' => $guestEvents
    ]) ?>

</div>
