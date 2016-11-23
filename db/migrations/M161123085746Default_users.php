<?php

namespace db\migrations;

use app\models\User;
use yii\db\Migration;
use Yii;

class M161123085746Default_users extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        //admin
        $admin = new User();
        $admin->email = 'admin@admin.ru';
        $admin->password = 'admin';
        if ($admin->create()) {
            $roleAdmin = $auth->getRole('admin');
            $auth->assign($roleAdmin, $admin->id);
        }

        //moder
        $moder = new User();
        $moder->email = 'moder@moder.ru';
        $moder->password = 'moder';
        if ($moder->create()) {
            $roleModer = $auth->getRole('moder');
            $auth->assign($roleModer, $moder->id);
        }
    }

    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAllAssignments();

        $user = User::findOne(['email' => 'admin@admin.ru']);
        $user->profile->delete();
        $user->delete();
        $user = User::findOne(['email' => 'moder@moder.ru']);
        $user->profile->delete();
        $user->delete();
    }
}
