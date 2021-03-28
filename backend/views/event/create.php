<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */

$this->title = 'Create Event';
$this->params['breadcrumbs'][] = ['label' => 'Manage Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


