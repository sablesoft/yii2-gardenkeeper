<?php

namespace common\helpers;

/**
 * Class AreaHelper
 * @package common\helpers
 */
class AreaHelper
{
    /**
     * @return bool
     */
    public static function isFrontend(): bool
    {
        return basename(\Yii::getAlias('@app')) == 'frontend';
    }
}