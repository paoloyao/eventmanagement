<?php

use yii\helpers\Html;
use yii\grid\GridView;
// use kartik\grid\GridView;
use yii\bootstrap4\Modal;
use backend\models\EventGuest;


$this->title = 'Report' ;

?>

<?php foreach($gridData as $key => $value): ?>
    <div class="m-2">
        <h3><?= $value['name'] ?></h3>
        <p class="size">date and time: <?= $value['datetime'] ?></p>
        <?php echo \nterms\pagesize\PageSize::widget(); ?>
        <?= GridView::widget([
            'dataProvider' => $value['dataProvider'],
            'filterModel' => $value['searchModel'],
            'columns' => [
                ['attribute'=> 'first_name', 'value' => 'guest.first_name', 'contentOptions' => ['style' => 'width:20%; white-space: normal;']],
                ['attribute'=> 'last_name', 'value' => 'guest.last_name', 'contentOptions' => ['style' => 'width:20%; white-space: normal;']],
                ['attribute'=> 'phone', 'value' => 'guest.phone', 'contentOptions' => ['style' => 'width:20%; white-space: normal;']],
                ['attribute'=> 'email', 'value' => 'guest.email', 'contentOptions' => ['style' => 'width:20%; white-space: normal;']],
            ],
        ]); ?>
    </div>
<?php endforeach; ?>




<?php

$script = <<< JS

JS;

$this->registerJs($script);

?>


