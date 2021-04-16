<?php

namespace common\fixtures;

use yii\test\ActiveFixture;
use common\models\Land;

/**
 * Class LandFixture
 * @package common\fixtures
 */
class LandFixture extends ActiveFixture
{
    public $modelClass = Land::class;
    public $depends = [
        UserFixture::class,
        ClimateFixture::class
    ];
}