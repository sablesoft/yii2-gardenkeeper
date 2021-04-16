<?php

namespace common\fixtures;

use yii\test\ActiveFixture;
use common\models\Garden;

/**
 * Class GardenFixture
 * @package common\fixtures
 */
class GardenFixture extends ActiveFixture
{
    public $modelClass = Garden::class;
    public $depends = [
        LandFixture::class,
        PlantFixture::class
    ];
}