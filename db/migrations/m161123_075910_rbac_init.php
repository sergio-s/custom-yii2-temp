<?php

namespace db\migrations;

use Yii;

class m161123_075910_rbac_init extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;
        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $auth->add($user);
        $moder = $auth->createRole('moder');
        $moder->description = 'Модератор';
        $auth->add($moder);
        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $auth->add($admin);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}
