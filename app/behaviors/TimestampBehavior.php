<?php

namespace app\behaviors;

use yii\db\Expression;

class TimestampBehavior extends \yii\behaviors\TimestampBehavior
{
    /**
     * @inheritdoc
     *
     * In case, when the [[value]] is `null`, the result of the PHP function [time()](http://php.net/manual/en/function.time.php)
     * will be used as value.
     */
    protected function getValue($event)
    {
        if ($this->value === null) {
            return new Expression('CURRENT_TIMESTAMP');
        }
        return parent::getValue($event);
    }
}
