<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "weather".
 *
 * @property int $id
 * @property int $climate_id Climate ID
 * @property int $season_id Season ID
 * @property int $temperature Medium temperature (Celsius)
 * @property int $humidity Medium humidity
 * @property int $precipitation Medium precipitation
 * @property int $sunshine Medium sunshine
 * @property int $wind Medium windiness
 * @property string $created_at Creation time
 * @property string $updated_at Last update time
 *
 * @property-read string $label
 * @property Climate $climate
 * @property-read string|null $climateLabel
 * @property Season $season
 * @property-read string|null $seasonLabel
 * @property-read array $columns
 */
class Weather extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weather';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['climate_id', 'season_id', 'temperature', 'humidity', 'precipitation', 'sunshine', 'wind'], 'required'],
            [['climate_id', 'season_id', 'temperature', 'humidity', 'precipitation', 'sunshine', 'wind'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['climate_id', 'season_id'], 'unique', 'targetAttribute' => ['climate_id', 'season_id']],
            [['climate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Climate::className(), 'targetAttribute' => ['climate_id' => 'id']],
            [['season_id'], 'exist', 'skipOnError' => true, 'targetClass' => Season::className(), 'targetAttribute' => ['season_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'label' => Yii::t('app', 'Label'),
            'climate_id' => Yii::t('app', 'Climate'),
            'climateLabel' => Yii::t('app', 'Climate'),
            'season_id' => Yii::t('app', 'Season'),
            'seasonLabel' => Yii::t('app', 'Season'),
            'temperature' => Yii::t('app', 'Temperature'),
            'humidity' => Yii::t('app', 'Humidity'),
            'precipitation' => Yii::t('app', 'Precipitation'),
            'sunshine' => Yii::t('app', 'Sunshine'),
            'wind' => Yii::t('app', 'Wind'),
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
            'climateLabel',
            'seasonLabel',
            'temperature',
            'humidity',
            'precipitation',
            'sunshine',
            'wind',
            'created_at:datetime',
            'updated_at:datetime',
        ];
    }

    /**
     * @return string|null
     */
    public function getLabel(): string
    {
        return $this->climateLabel . ' - ' . $this->seasonLabel;
    }

    /**
     * Gets query for [[Climate]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ClimateQuery
     */
    public function getClimate()
    {
        return $this->hasOne(Climate::className(), ['id' => 'climate_id']);
    }

    /**
     * @return string|null
     */
    public function getClimateLabel() : ?string
    {
        return $this->climate ? $this->climate->name : null;
    }

    /**
     * Gets query for [[Season]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SeasonQuery
     */
    public function getSeason()
    {
        return $this->hasOne(Season::className(), ['id' => 'season_id']);
    }

    /**
     * @return string|null
     */
    public function getSeasonLabel() : ?string
    {
        return $this->season ? $this->season->name : null;
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\WeatherQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\WeatherQuery(get_called_class());
    }
}
