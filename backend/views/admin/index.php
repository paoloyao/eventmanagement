<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use yii\bootstrap4\Modal;
// use kartik\widgets\Typeahead;
use kartik\typeahead\TypeaheadBasic;
use yii\widgets\ActiveForm;
use backend\models\GuestSearch;

$this->title = 'Admin - Manage Guests' ;
?>
<div class="guest-index">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Create Guest', ['/site/create-guest'], ['class' => 'btn btn-info mb-2']) ?>
    </p>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        Modal::begin([
            'title' => 'View Guest',
            'id' => 'modal-view',
            'size' => 'modal-lg',
            'closeButton' => [
                'id'=>'close-button',
                'class'=>'close',
                'data-dismiss' =>'modal',
                ],
            //keeps from closing modal with esc key or by clicking out of the modal.
            // user must click cancel or X to close
            'clientOptions' => [
                'backdrop' => 'static', 'keyboard' => true
                ]
        ]);
        echo "<div id='modalContent'><div style='text-align:center'></div></div>";
        Modal::end();
    ?>

    <?php Modal::begin([
        'title' => 'Delete Guest',
        'id'     => 'modal-delete',
        'footer' => Html::a('Delete', '', ['class' => 'btn btn-danger', 'id' => 'delete-confirm', 'data-method' => 'post']),
    ]);

        echo "<div id='modal-delete-content' style='text-align:center'></div>";
        Modal::end(); 
    ?>

<?php echo \nterms\pagesize\PageSize::widget(); ?>

<?php
    $form = ActiveForm::begin();
    
    // echo TypeaheadBasic::widget([
    //     'name' => 'state_17',
    //     'data' => $dataProvider,
    //     'dataset' => ['limit' => 10],
    //     'options' => ['placeholder' => 'Filter as you type ...'],
    //     'pluginOptions' => ['highlight' => true, 'minLength' => 0] 				
    // ]);

    $guest = new GuestSearch();
    echo $form->field($guest, 'first_name')->widget(TypeaheadBasic::classname(), [
        'data' => $names,
        'options' => ['placeholder' => 'Filter as you type ...'],
        'pluginOptions' => ['highlight'=>true],
    ]);
?>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

<?php
    ActiveForm::end();
?>

<?=        
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterSelector' => 'select[name="per-page"]',
        'columns' => [
            ['attribute'=> 'id', 'contentOptions' => ['style' => 'width:10%; white-space: normal;']],
            ['attribute'=> 'first_name', 'contentOptions' => ['style' => 'width:20%; white-space: normal;']],
            ['attribute'=> 'last_name', 'contentOptions' => ['style' => 'width:20%; white-space: normal;']],
            ['attribute'=> 'email', 'contentOptions' => ['style' => 'width:20%; white-space: normal;']],
            ['attribute'=> 'address', 'contentOptions' => ['style' => 'width:20%; white-space: normal;']],
            // 'phone',
            // 'events:ntext',
            // 'gender:ntext',
            //'status',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{create}{delete}{update}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('View', $url, ['class' => ['btn btn-outline-primary modalButton']], 
                                        [
                                            'data-toggle'=>'modal-view',
                                            'data-target'=>'#modal-view',
                                        ]);     
                    },
                    'update' => function ($url, $model) {
                        return Html::a('Update', $url, ['class' => ['btn btn-outline-secondary']]);      
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('Delete', $url, [
                            'class'       => 'btn btn-outline-danger popup-modal',
                            'data-toggle' => 'modal-delete',
                            'data-target' => '#modal-delete',
                            'data-id'     => $model->id,
                            'data-name'   => $model->first_name.' '.$model->last_name,
                            'id'          => 'popupModal'
                        ]);
                    },
                ],
                'contentOptions' => ['style' => 'display:flex;', 'id' => 'action-button'],
            ],
        ],
    ]); 
    
?>



</div>

<?php

$script = <<< JS

$(function(){
    $('.modalButton').click(function (){
        $.get($(this).attr('href'), function(data) {
            $('#modal-view').modal('show').find('#modalContent').html(data)
       });
       return false;
    });
}); 

$(function() {
    $('.popup-modal').click(function(e) {
        e.preventDefault();
        var that = $(this);
        var id = that.data('id');
        var name = that.data('name');
        var modal = $('#modal-delete').modal('show');
        modal.find('#modal-delete-content').text("Are you sure you want to Delete guest: "+name);
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


