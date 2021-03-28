<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '/ Manage Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h2>Manage Events</h2>

    <p>
        <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-info']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Modal::begin([
        'title' => 'Delete Guest',
        'id'     => 'modal-delete',
        'footer' => Html::a('Delete', '', ['class' => 'btn btn-danger', 'id' => 'delete-confirm', 'data-method' => 'post']),
    ]);

        echo "<div id='modal-delete-content' style='text-align:center'></div>";
        Modal::end(); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name:ntext',
            'datetime',
            'location:ntext',
            'status:ntext',
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{delete}{update}',
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a('Update', $url, ['class' => ['btn btn-outline-secondary']]);      
                },
                'delete' => function ($url, $model) {
                    return Html::a('Delete', $url, [
                        'class'       => 'btn btn-outline-danger popup-modal',
                        'data-toggle' => 'modal-delete',
                        'data-target' => '#modal-delete',
                        'data-id'     => $model->id,
                        'data-name'   => $model->name,
                        'id'          => 'popupModal'
                    ]);
                },
            ],
            'contentOptions' => ['style' => 'display:flex;', 'id' => 'action-button'],
        ],
        ],
    ]); ?>


</div>

<?php

$script = <<< JS

$(function() {
    $('.popup-modal').click(function(e) {
        e.preventDefault();
        var that = $(this);
        var id = that.data('id');
        var name = that.data('name');
        var modal = $('#modal-delete').modal('show');
        modal.find('#modal-delete-content').text("Are you sure you want to Event: "+name);
        $("#delete-confirm").attr("href", 'delete?id='+id)
        modal.find('.modal-body').on(('load', '.modal-dialog'));
    });
});

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
