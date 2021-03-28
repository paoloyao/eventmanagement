<?php

?>

<aside class="shadow">
  <?php 
  echo \yii\bootstrap4\Nav::widget([
    'options' => [
        'class' => 'd-flex flex-column nav-pills'    
    ],
    'items' => [
        [
            'label' => 'Manage Guests',
            'url' => ['/site/index']
        ],
        [
            'label' => 'Manage Events',
            'url' => ['/event/index']
        ],
        [
          'label' => 'Reports',
          'url' => ['/report/index']
      ]
    ]
  ]) 
  ?>
</aside>