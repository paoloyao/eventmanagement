<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GuestSample */

$this->title = 'Update Guest Sample: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Guest Samples', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="guest-sample-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
