<?php

namespace common\models;

use common\models\traits\DropDownTrait;
use Yii;
use common\models\interfaces\ColumnsInterface;

/**
 * This is the model class for table "plant".
 *
 * @property int $id
 * @property string $name
 * @property int $lifespan Medium life span (years)
 * @property int $temperature_min Minimal temperature (Celsius)
 * @property int $temperature_max Maximal temperature (Celsius)
 * @property int $humidity_min Minimal humidity
 * @property int $humidity_max Maximal humidity
 * @property int $precipitation_min Minimal precipitation
 * @property int $precipitation_max Maximal precipitation
 * @property int $sunshine_min Minimal sunshine
 * @property int $sunshine_max Maximal sunshine
 * @property int $wind_min Minimal windiness
 * @property int $wind_max Maximal windiness
 * @property string $created_at Creation time
 * @property string $updated_at Last update time
 *
 * @property Garden[] $gardens
 * @property Product[] $products
 */
class Plant extends \yii\db\ActiveRecord implements ColumnsInterface
{
    use DropDownTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'lifespan', 'temperature_min', 'temperature_max', 'humidity_min', 'humidity_max', 'precipitation_min', 'precipitation_max', 'sunshine_min', 'sunshine_max', 'wind_min', 'wind_max'], 'required'],
            [['lifespan', 'temperature_min', 'temperature_max', 'humidity_min', 'humidity_max', 'precipitation_min', 'precipitation_max', 'sunshine_min', 'sunshine_max', 'wind_min', 'wind_max'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
            'lifespan' => Yii::t('app', 'Lifespan'),
            'temperature_min' => Yii::t('app', 'Temperature Min'),
            'temperature_max' => Yii::t('app', 'Temperature Max'),
            'humidity_min' => Yii::t('app', 'Humidity Min'),
            'humidity_max' => Yii::t('app', 'Humidity Max'),
            'precipitation_min' => Yii::t('app', 'Precipitation Min'),
            'precipitation_max' => Yii::t('app', 'Precipitation Max'),
            'sunshine_min' => Yii::t('app', 'Sunshine Min'),
            'sunshine_max' => Yii::t('app', 'Sunshine Max'),
            'wind_min' => Yii::t('app', 'Wind Min'),
            'wind_max' => Yii::t('app', 'Wind Max'),
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
            'lifespan',
            'temperature_min',
            'temperature_max',
            'humidity_min',
            'humidity_max',
            'precipitation_min',
            'precipitation_max',
            'sunshine_min',
            'sunshine_max',
            'wind_min',
            'wind_max',
            'created_at:datetime',
            'updated_at:datetime',
        ];
    }

    /**
     * Gets query for [[Gardens]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\GardenQuery
     */
    public function getGardens()
    {
        return $this->hasMany(Garden::className(), ['plant_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['plant_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PlantQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PlantQuery(get_called_class());
    }
}
