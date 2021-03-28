<?php

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => ['class' => 'shadow-sm navbar-dark bg-dark navbar-expand-lg']
]);
$menuItems = [
    ['label' => 'Front End', 'url' => ['/site/create-guest']],
    ['label' => 'Manage Guests', 'url' => ['/site/index']],
    ['label' => 'Manage Events', 'url' => ['/event/index']],
    ['label' => 'Reports', 'url' => ['/event/report']],
];
// if (Yii::$app->user->isGuest) {
//     $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
//     $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
// } else {
//     $menuItems[] = '<li>'
//         . Html::beginForm(['/site/logout'], 'post')
//         . Html::submitButton(
//             'Logout (' . Yii::$app->user->identity->username . ')',
//             ['class' => 'btn btn-link logout']
//         )
//         . Html::endForm()
//         . '</li>';
//         '<input type="checkbox" checked data-toggle="toggle">';
// }
echo Nav::widget([
    'options' => ['class' => 'navbar-nav ml-auto'],
    'items' => $menuItems,
]);
NavBar::end();
?>
