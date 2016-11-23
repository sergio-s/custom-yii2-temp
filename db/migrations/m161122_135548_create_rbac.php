<?php

namespace db\migrations;

use yii\db\mysql\Schema;

class m161122_135548_create_rbac extends Migration
{
    public function up()
    {
        // auth_assignment
        $this->createTable('{{%auth_assignment}}', [
            'item_name' => Schema::TYPE_STRING . "(64) NOT NULL",
            'user_id' => Schema::TYPE_STRING . "(64) NOT NULL",
            'created_at' => Schema::TYPE_TIMESTAMP . " NULL",
            'PRIMARY KEY (item_name, user_id)',
        ], $this->tableOptions);

        // auth_item
        $this->createTable('{{%auth_item}}', [
            'name' => Schema::TYPE_STRING . "(64) NOT NULL",
            'type' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'description' => Schema::TYPE_TEXT . " NULL",
            'rule_name' => Schema::TYPE_STRING . "(64) NULL",
            'data' => Schema::TYPE_TEXT . " NULL",
            'created_at' => Schema::TYPE_TIMESTAMP . " NULL",
            'updated_at' => Schema::TYPE_TIMESTAMP . " NULL",
            'PRIMARY KEY (name)',
        ], $this->tableOptions);

        // auth_item_child
        $this->createTable('{{%auth_item_child}}', [
            'parent' => Schema::TYPE_STRING . "(64) NOT NULL",
            'child' => Schema::TYPE_STRING . "(64) NOT NULL",
            'PRIMARY KEY (parent, child)',
        ], $this->tableOptions);

        // auth_rule
        $this->createTable('{{%auth_rule}}', [
            'name' => Schema::TYPE_STRING . "(64) NOT NULL",
            'data' => Schema::TYPE_TEXT . " NULL",
            'created_at' => Schema::TYPE_TIMESTAMP . " NULL",
            'updated_at' => Schema::TYPE_TIMESTAMP . " NULL",
            'PRIMARY KEY (name)',
        ], $this->tableOptions);

        // fk: auth_assignment
        $this->addForeignKey('fk_auth_assignment_item_name', '{{%auth_assignment}}', 'item_name', '{{%auth_item}}', 'name');

        // fk: auth_item
        $this->addForeignKey('fk_auth_item_rule_name', '{{%auth_item}}', 'rule_name', '{{%auth_rule}}', 'name');

        // fk: auth_item_child
        $this->addForeignKey('fk_auth_item_child_parent', '{{%auth_item_child}}', 'parent', '{{%auth_item}}', 'name');
        $this->addForeignKey('fk_auth_item_child_child', '{{%auth_item_child}}', 'child', '{{%auth_item}}', 'name');
    }

    public function down()
    {
        $this->dropForeignKey('fk_auth_assignment_item_name', '{{%auth_assignment}}');
        $this->dropForeignKey('fk_auth_item_rule_name', '{{%auth_item}}');
        $this->dropForeignKey('fk_auth_item_child_parent', '{{%auth_item_child}}');
        $this->dropForeignKey('fk_auth_item_child_child', '{{%auth_item_child}}');

        $this->dropTable('{{%auth_assignment}}');
        $this->dropTable('{{%auth_item}}');
        $this->dropTable('{{%auth_item_child}}');
        $this->dropTable('{{%auth_rule}}');
    }
}
