<?php

namespace common\fixtures;

use yii\test\ActiveFixture;
use common\models\Gather;

/**
 * Class GatherFixture
 * @package common\fixtures
 */
class GatherFixture extends ActiveFixture
{
    public $modelClass = Gather::class;
    public $depends = [
        LandFixture::class,
        GardenFixture::class,
        ProductFixture::class
    ];
}