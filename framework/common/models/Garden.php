<?php

namespace common\models;

use Yii;
use common\models\traits\HealthTrait;
use common\models\traits\DropDownTrait;
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
    use DropDownTrait, HealthTrait;

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
     * @return $this
     * @throws \Throwable
     */
    public function live(): self
    {
        $climateId = $this->land->climate_id;
        $now = History::findNow();
        $seasonId = $now->season_id;

        $weather = Weather::findOne([
            'climate_id' => $climateId,
            'season_id' => $seasonId
        ]);

        $healthDiff = $this->plant->checkWeather($weather);

        $this->growth($healthDiff);
        if (!$this->die()) {
            $this->save();
        }

        return $this;
    }

    /**
     * @param int $healthDiff
     * @return $this
     */
    protected function growth(int $healthDiff): self
    {
        Yii::info("Plant " . $this->label . " is growing...", 'debug');
        if (History::isNewYear()) {
            $this->age++;
            Yii::info("New age: " . $this->age, 'debug');
        }
        $phase = $this->age * 100 / $this->plant->lifespan;
        Yii::info("Plant live phase: " . $phase, 'debug');
        switch ($phase) {
            case 0:
                Yii::info("Phase - initial", 'debug');
                $healthDiff += 10;
                break;
            case ($phase < 30):
                Yii::info("Phase < 30%", 'debug');
                $healthDiff += 10;
                break;
            case ($phase < 50):
                Yii::info("Phase < 50%", 'debug');
                $healthDiff += 5;
                break;
                // после 50 процентов возраста - дряхление:
            case ($phase < 60):
                Yii::info("Phase < 60%", 'debug');
                break;
            case ($phase < 70):
                Yii::info("Phase < 70%", 'debug');
                $healthDiff -= 5;
                break;
            case ($phase < 90):
                Yii::info("Phase < 90%", 'debug');
                $healthDiff -= 10;
                break;
            default:
                Yii::info("Phase > 90%", 'debug');
                $healthDiff -= 20;
        }
        Yii::info("Plant health diff: " . $healthDiff, 'debug');
        $this->updateHealth($healthDiff);
        foreach ($this->gathers as $growing) {
            $growing->growth($healthDiff);
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
            $now = History::findNow();
            foreach ($this->gathers as $growing) {
                if (!$growing->drop()) {
                    $now->products_lost++;
                    $growing->delete();
                }
            }
            $now->plants_lost++;
            $this->delete();

            return true;
        }

        return false;
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
