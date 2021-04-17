<?php

namespace common\fixtures;

use yii\test\ActiveFixture;
use common\models\Weather;

/**
 * Class WeatherFixture
 * @package common\fixtures
 */
class WeatherFixture extends ActiveFixture
{
    public $modelClass = Weather::class;
    public $depends = [
        SeasonFixture::class,
        ClimateFixture::class
    ];
}