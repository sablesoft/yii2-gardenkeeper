<?php

namespace common\fixtures;

use yii\test\ActiveFixture;
use common\models\ClimateSeason;

/**
 * Class ClimateSeasonFixture
 * @package common\fixtures
 */
class ClimateSeasonFixture extends ActiveFixture
{
    public $modelClass = ClimateSeason::class;
    public $depends = [
        SeasonFixture::class,
        ClimateFixture::class
    ];
}