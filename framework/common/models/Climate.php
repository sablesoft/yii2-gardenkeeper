<?php

namespace common\models;

use Yii;
use common\models\traits\DropDownTrait;
use common\models\interfaces\ColumnsInterface;

/**
 * This is the model class for table "climate".
 *
 * @property int $id
 * @property string|null $name
 * @property string $created_at Creation time
 * @property string $updated_at Last update time
 *
 * @property Weather[] $weathers
 * @property Land[] $lands
 */
class Climate extends \yii\db\ActiveRecord implements ColumnsInterface
{
    use DropDownTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'climate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
            'created_at:datetime',
            'updated_at:datetime',
        ];
    }

    /**
     * Gets query for [[Weathers]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\WeatherQuery
     */
    public function getWeathers()
    {
        return $this->hasMany(Weather::className(), ['climate_id' => 'id']);
    }

    /**
     * Gets query for [[Lands]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\LandQuery
     */
    public function getLands()
    {
        return $this->hasMany(Land::className(), ['climate_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ClimateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ClimateQuery(get_called_class());
    }
}
