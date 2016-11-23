<?php

$menuItems = [
    [
        'label' => Yii::t('user', 'Users'),
        'url' => '/user/admin/index',
        'icon' => 'fa fa-users'
    ]
];
$favouriteMenuItems[] = ['label'=>'MAIN NAVIGATION', 'options'=>['class'=>'header']];
$developerMenuItems = [];

echo dmstr\widgets\Menu::widget([
    'options' => ['class' => 'sidebar-menu'],
    'items' => \yii\helpers\ArrayHelper::merge($favouriteMenuItems, $menuItems),
]);