<?php

namespace common\fixtures;

use common\models\Product;
use yii\test\ActiveFixture;

/**
 * Class ProductFixture
 * @package common\fixtures
 */
class ProductFixture extends ActiveFixture
{
    public $modelClass = Product::class;
    public $depends = [
        PlantFixture::class,
        SeasonFixture::class
    ];
}