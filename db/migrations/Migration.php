<?php

namespace db\migrations;

/**
 * Created by Anton Gubarev.
 * E-mail: a.p.gubarev@gmail.com
 * Date: 22.11.16
 */
class Migration extends \yii\db\Migration
{
    /**
     * @var string
     */
    protected $tableOptions;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }
}