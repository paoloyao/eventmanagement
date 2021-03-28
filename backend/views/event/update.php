<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */

$this->title = 'Update Event: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="event-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
