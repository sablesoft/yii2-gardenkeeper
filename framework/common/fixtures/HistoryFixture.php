<?php

namespace common\fixtures;

use common\models\History;
use yii\test\ActiveFixture;

/**
 * Class HistoryFixture
 * @package common\fixtures
 */
class HistoryFixture extends ActiveFixture
{
    public $modelClass = History::class;
    public $depends = [
        SeasonFixture::class,
    ];
}