<?php

namespace common\models;

use common\models\traits\DropDownTrait;
use Yii;
use common\models\interfaces\ColumnsInterface;

/**
 * This is the model class for table "garden".
 *
 * @property int $id
 * @property int $land_id Land ID
 * @property int $plant_id Plant ID
 * @property int $age Garden plant age
 * @property int $fertility Garden plant fertility
 * @property int $health Garden plant health
 * @property string $created_at Creation time
 * @property string $updated_at Last update time
 *
 * @property-read string $label
 * @property-read string|null $landLabel
 * @property-read string|null $plantLabel
 * @property Land $land
 * @property Plant $plant
 * @property Gather[] $gathers
 */
class Garden extends \yii\db\ActiveRecord implements ColumnsInterface
{
    use DropDownTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'garden';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['land_id', 'plant_id', 'fertility'], 'required'],
            [['land_id', 'plant_id', 'age', 'fertility', 'health'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['land_id'], 'exist', 'skipOnError' => true, 'targetClass' => Land::className(), 'targetAttribute' => ['land_id' => 'id']],
            [['plant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plant::className(), 'targetAttribute' => ['plant_id' => 'id']],
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
            'plant_id' => Yii::t('app', 'Plant'),
            'plantLabel' => Yii::t('app', 'Plant'),
            'age' => Yii::t('app', 'Age'),
            'fertility' => Yii::t('app', 'Fertility'),
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
            'plantLabel',
            'age',
            'fertility',
            'health',
            'created_at:datetime',
            'updated_at:datetime',
        ];
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->landLabel . ' - ' . $this->plantLabel . ' (' . $this->id . ')';
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
     * Gets query for [[Plant]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\PlantQuery
     */
    public function getPlant()
    {
        return $this->hasOne(Plant::className(), ['id' => 'plant_id']);
    }

    /**
     * @return string|null
     */
    public function getPlantLabel(): ?string
    {
        return $this->plant ? $this->plant->name : null;
    }

    /**
     * Gets query for [[Gathers]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\GatherQuery
     */
    public function getGathers()
    {
        return $this->hasMany(Gather::className(), ['garden_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\GardenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\GardenQuery(get_called_class());
    }
}
