<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GuestSample */

$this->title = 'Create Guest Sample';
$this->params['breadcrumbs'][] = ['label' => 'Guest Samples', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guest-sample-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
