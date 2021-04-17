<?php

namespace common\models;

use Yii;
use common\models\traits\DropDownTrait;
use common\models\interfaces\ColumnsInterface;

/**
 * This is the model class for table "season".
 *
 * @property int $id
 * @property string|null $name
 * @property int $order Season order
 * @property string $created_at Creation time
 * @property string $updated_at Last update time
 *
 * @property-read Season $nextSeason
 * @property Weather[] $weathers
 * @property Climate[] $climates
 * @property Product[] $products
 * @property Product[] $products0
 */
class Season extends \yii\db\ActiveRecord implements ColumnsInterface
{
    use DropDownTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'season';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'order'], 'required'],
            [['order'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name', 'order'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'order' => Yii::t('app', 'Order'),
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
            'name',
            'order',
            'created_at:datetime',
            'updated_at:datetime',
        ];
    }

    /**
     * @return $this
     */
    public function getNextSeason(): self
    {
        $next = self::find()->where(['>', 'order', $this->order])
            ->orderBy(['order' => SORT_ASC])->one();
        return $next ?: self::find()->orderBy(['order' => SORT_ASC])->one();
    }

    /**
     * Gets query for [[Climates]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ClimateQuery
     */
    public function getClimates()
    {
        return $this->hasMany(Climate::className(), ['id' => 'climate_id'])
            ->viaTable('weather', ['season_id' => 'id']);
    }

    /**
     * Gets query for [[Weathers]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\WeatherQuery
     */
    public function getWeathers()
    {
        return $this->hasMany(Weather::className(), ['season_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['ovary_season_id' => 'id']);
    }

    /**
     * Gets query for [[Products0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ProductQuery
     */
    public function getProducts0()
    {
        return $this->hasMany(Product::className(), ['ripening_season_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SeasonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SeasonQuery(get_called_class());
    }
}
