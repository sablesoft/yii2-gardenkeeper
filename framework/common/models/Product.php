<?php

namespace common\models;

use common\models\interfaces\ColumnsInterface;
use common\models\traits\DropDownTrait;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $plant_id Plant ID
 * @property string|null $name Plant product name
 * @property int $ovary_season_id Product ovary season ID
 * @property int $ripening_season_id Product ripening season ID
 * @property int|null $fertility_begin Fertility begin age
 * @property int|null $fertility_end Fertility end age
 * @property int|null $is_droppable Is plant product droppable
 * @property int $quantity Product medium quantity in year
 * @property int $value Product value
 * @property string $created_at Creation time
 * @property string $updated_at Last update time
 *
 * @property Gather[] $gathers
 * @property Season $ovarySeason
 * @property Plant $plant
 * @property-read string|null $plantLabel
 * @property-read string|null $ovarySeasonLabel
 * @property-read string|null $ripeningSeasonLabel
 * @property Season $ripeningSeason
 */
class Product extends \yii\db\ActiveRecord implements ColumnsInterface
{
    use DropDownTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plant_id', 'quantity', 'value'], 'required'],
            [['plant_id', 'ovary_season_id', 'ripening_season_id', 'fertility_begin', 'fertility_end', 'is_droppable', 'quantity', 'value'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['ovary_season_id'], 'exist', 'skipOnError' => true, 'targetClass' => Season::className(), 'targetAttribute' => ['ovary_season_id' => 'id']],
            [['plant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plant::className(), 'targetAttribute' => ['plant_id' => 'id']],
            [['ripening_season_id'], 'exist', 'skipOnError' => true, 'targetClass' => Season::className(), 'targetAttribute' => ['ripening_season_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'plant_id' => Yii::t('app', 'Plant'),
            'plantLabel' => Yii::t('app', 'Plant'),
            'name' => Yii::t('app', 'Name'),
            'ovary_season_id' => Yii::t('app', 'Ovary Season'),
            'ovarySeasonLabel' => Yii::t('app', 'Ovary Season'),
            'ripening_season_id' => Yii::t('app', 'Ripening Season'),
            'ripeningSeasonLabel' => Yii::t('app', 'Ripening Season'),
            'fertility_begin' => Yii::t('app', 'Fertility Begin'),
            'fertility_end' => Yii::t('app', 'Fertility End'),
            'is_droppable' => Yii::t('app', 'Is Droppable'),
            'quantity' => Yii::t('app', 'Quantity'),
            'value' => Yii::t('app', 'Value'),
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
            'plantLabel',
            'name',
            'ovarySeasonLabel',
            'ripeningSeasonLabel',
            'fertility_begin',
            'fertility_end',
            'is_droppable:boolean',
            'quantity',
            'value',
            'created_at:datetime',
            'updated_at:datetime',
        ];
    }

    /**
     * @return string|null
     */
    protected function getPlantLabel(): ?string
    {
        return $this->plant ? $this->plant->name : null;
    }

    /**
     * @return string|null
     */
    protected function getOvarySeasonLabel(): ?string
    {
        return $this->ovarySeason ? $this->ovarySeason->name : null;
    }

    /**
     * @return string|null
     */
    protected function getRipeningSeasonLabel(): ?string
    {
        return $this->ripeningSeason ? $this->ripeningSeason->name : null;
    }

    /**
     * Gets query for [[Gathers]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\GatherQuery
     */
    public function getGathers()
    {
        return $this->hasMany(Gather::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[OvarySeason]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SeasonQuery
     */
    public function getOvarySeason()
    {
        return $this->hasOne(Season::className(), ['id' => 'ovary_season_id']);
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
     * Gets query for [[RipeningSeason]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SeasonQuery
     */
    public function getRipeningSeason()
    {
        return $this->hasOne(Season::className(), ['id' => 'ripening_season_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProductQuery(get_called_class());
    }
}
