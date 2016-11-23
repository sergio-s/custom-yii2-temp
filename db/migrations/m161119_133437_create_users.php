<?php

namespace db\migrations;

use yii\db\mysql\Schema;

class m161119_133437_create_users extends Migration
{
    public function up()
    {
        // user
        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            //'username' => Schema::TYPE_STRING . "(255) NOT NULL",
            'email' => Schema::TYPE_STRING . "(255) NOT NULL",
            'password_hash' => Schema::TYPE_STRING . "(60) NOT NULL",
            'auth_key' => Schema::TYPE_STRING . "(32) NOT NULL",
            'confirmed_at' => Schema::TYPE_INTEGER . "(11) NULL",
            'unconfirmed_email' => Schema::TYPE_STRING . "(255) NULL",
            'blocked_at' => Schema::TYPE_INTEGER . "(11) NULL",
            'registration_ip' => Schema::TYPE_STRING . "(45) NULL",
            'created_at' => Schema::TYPE_TIMESTAMP . " NOT NULL",
            'updated_at' => Schema::TYPE_TIMESTAMP . " NOT NULL",
            'flags' => Schema::TYPE_INTEGER . "(11) NOT NULL DEFAULT '0'",
        ], $this->tableOptions);

        // profile
        $this->createTable('{{%profile}}', [
            'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            "type" => Schema::TYPE_SMALLINT . " NOT NULL",
            "provider_type" => Schema::TYPE_SMALLINT . " NOT NULL",
            "buyer_type" => Schema::TYPE_SMALLINT . " NOT NULL",
            "number" => Schema::TYPE_STRING. "(45) NOT NULL",
            'name' => Schema::TYPE_STRING . "(255) NULL",
            "phone" => Schema::TYPE_STRING . "(50) NOT NULL",
            "status" => Schema::TYPE_SMALLINT . " NOT NULL",
            'public_email' => Schema::TYPE_STRING . "(255) NULL",
            'PRIMARY KEY (user_id)',
        ], $this->tableOptions);

        // social_account
        $this->createTable('{{%social_account}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . "(11) NULL",
            'provider' => Schema::TYPE_STRING . "(255) NOT NULL",
            'client_id' => Schema::TYPE_STRING . "(255) NOT NULL",
            'data' => Schema::TYPE_TEXT . " NULL",
            'code' => Schema::TYPE_STRING . "(32) NULL",
            'created_at' => Schema::TYPE_TIMESTAMP . " NULL",
            'email' => Schema::TYPE_STRING . "(255) NULL",
            'username' => Schema::TYPE_STRING . "(255) NULL",
        ], $this->tableOptions);

        // token
        $this->createTable('{{%token}}', [
            'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'code' => Schema::TYPE_STRING . "(32) NOT NULL",
            'created_at' => Schema::TYPE_TIMESTAMP . " NOT NULL",
            'type' => Schema::TYPE_SMALLINT . "(6) NOT NULL",
            'PRIMARY KEY (user_id, code, type)',
        ], $this->tableOptions);

        // fk: profile
        $this->addForeignKey('fk_profile_user_id', '{{%profile}}', 'user_id', '{{%user}}', 'id');
        // fk: social_account
        $this->addForeignKey('fk_social_account_user_id', '{{%social_account}}', 'user_id', '{{%user}}', 'id');
        // fk: token
        $this->addForeignKey('fk_token_user_id', '{{%token}}', 'user_id', '{{%user}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('fk_profile_user_id', '{{%profile}}');
        $this->dropForeignKey('fk_social_account_user_id', '{{%social_account}}');
        $this->dropForeignKey('fk_token_user_id', '{{%token}}');

        $this->dropTable('{{%user}}');
        $this->dropTable('{{%profile}}');
        $this->dropTable('{{%social_account}}');
        $this->dropTable('{{%token}}');
    }
}
