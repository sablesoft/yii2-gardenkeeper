<?php

namespace common\models;

use Yii;
use common\models\traits\HealthTrait;
use common\models\interfaces\ColumnsInterface;

/**
 * This is the model class for table "gather".
 *
 * @property int $id
 * @property int $land_id Land ID
 * @property int $product_id Product ID
 * @property int $garden_id Garden ID
 * @property int $is_harvested Is product harvested
 * @property int $ripeness Plant product ripeness
 * @property int $health Plant product health
 * @property int $value Plant product value
 * @property string $created_at Creation time
 * @property string $updated_at Last update time
 *
 * @property Garden $garden
 * @property-read string|null $gardenLabel
 * @property Land $land
 * @property-read string|null $landLabel
 * @property Product $product
 * @property-read string|null $productLabel
 */
class Gather extends \yii\db\ActiveRecord implements ColumnsInterface
{
    use HealthTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gather';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'land_id'], 'required'],
            [['land_id', 'product_id', 'garden_id', 'is_harvested', 'ripeness', 'health'], 'integer'],
            [['ripeness'], 'default', 'value' => 0],
            [['health'], 'default', 'value' => 100],
            [['created_at', 'updated_at'], 'safe'],
            [['garden_id'], 'exist', 'skipOnError' => true, 'targetClass' => Garden::className(), 'targetAttribute' => ['garden_id' => 'id']],
            [['land_id'], 'exist', 'skipOnError' => true, 'targetClass' => Land::className(), 'targetAttribute' => ['land_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'land_id' => Yii::t('app', 'Land'),
            'landLabel' => Yii::t('app', 'Land'),
            'product_id' => Yii::t('app', 'Product'),
            'productLabel' => Yii::t('app', 'Product'),
            'garden_id' => Yii::t('app', 'Garden Plant'),
            'gardenLabel' => Yii::t('app', 'Garden Plant'),
            'is_harvested' => Yii::t('app', 'Is Harvested'),
            'ripeness' => Yii::t('app', 'Ripeness'),
            'health' => Yii::t('app', 'Health'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return [
//            'id',
            'landLabel',
            'gardenLabel',
            'productLabel',
            'is_harvested:boolean',
            'ripeness',
            'health',
            'created_at:datetime',
            'updated_at:datetime',
        ];
    }

    /**
     * @return bool
     */
    public function drop(): bool
    {
        Yii::info("Try to drop - " . $this->productLabel, 'debug');
        if (!$this->product->is_droppable || $this->is_harvested) {
            return false;
        }

        $this->is_harvested = 1;
        $this->garden_id = null;
        $dropped = $this->save();
        if ($dropped) {
            Yii::info($this->productLabel . ' is dropped!', 'debug');
        }

        return $dropped;
    }

    /**
     * @param int $diff
     * @return $this
     * @throws \Throwable
     */
    public function growth(int $diff = 0): self
    {
        $diff = $this->ripen($diff);
        Yii::info($this->productLabel . ' health diff: ' . $diff, 'debug');
        $this->updateHealth($diff);
        if (!$this->die()) {
            $this->save();
        }

        return $this;
    }

    /**
     * @return bool
     * @throws \Throwable
     */
    protected function die(): bool
    {
        if (!$this->health) {
            Yii::info($this->productLabel . ' lost!', 'debug');
            $now = History::findNow();
            if ($this->is_harvested) {
                $now->harvested_lost++;
            } else {
                $now->products_lost++;
            }
            $this->delete();

            return true;
        }

        return false;
    }

    /**
     * @param $healthDiff
     * @return int
     */
    protected function ripen($healthDiff): int
    {
        if ($this->isRipen() && $healthDiff >= 0) {
            Yii::info("Ripen product - " . $this->productLabel, 'debug');
            if ($this->is_harvested) {
                Yii::info("Ripen harvested", 'debug');
                $this->ripeness += 25;
            } else {
                $seasonsCount = $this->product->ripeningSeason->order -
                    $this->product->ovarySeason->order + 1;
                Yii::info("Ripen seasons - " . $seasonsCount, 'debug');
                $this->ripeness += intval(100 / $seasonsCount);
            }
            Yii::info($this->productLabel . " new ripeness: " . $this->ripeness, 'debug');
        }

        if ($this->ripeness > 100) {
            if (!$this->drop()) {
                $healthDiff -= 30;
            }
        }

        return $healthDiff;
    }

    /**
     * @return bool
     */
    public function isRipen(): bool
    {
        return ($this->product->ovary_season_id &&
            $this->product->ripening_season_id);
    }

    /**
     * Gets query for [[Garden]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\GardenQuery
     */
    public function getGarden()
    {
        return $this->hasOne(Garden::className(), ['id' => 'garden_id']);
    }

    /**
     * @return string|null
     */
    public function getGardenLabel(): ?string
    {
        return $this->garden ? $this->garden->label : null;
    }

    /**
     * Gets query for [[Land]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\LandQuery
     */
    public function getLand()
    {
        return $this->hasOne(Land::className(), ['id' => 'land_id']);
    }

    /**
     * @return string|null
     */
    public function getLandLabel(): ?string
    {
        return $this->land ? $this->land->name : null;
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ProductQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return string|null
     */
    public function getProductLabel(): ?string
    {
        return $this->product ? $this->product->name : null;
    }

    /**
     * @param bool $runValidation
     * @param null $attributes
     * @return bool
     * @throws \Throwable
     */
    public function insert($runValidation = true, $attributes = null)
    {
        if ($this->garden) {
            $this->land_id = $this->garden->land_id;
        }

        return parent::insert($runValidation, $attributes);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\GatherQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\GatherQuery(get_called_class());
    }
}
