<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property int $id
 * @property int $year Year of history
 * @property int $season_id Year season ID
 * @property int $lands Total lands count
 * @property int $plants Total growing plants count
 * @property int $plants_lost Total plants lost count
 * @property int $products Total growing products count
 * @property int $products_value Total products value
 * @property int $products_lost Total products lost
 * @property int $harvested Total harvested products count
 * @property int $harvested_value Total harvested products value
 * @property int $harvested_lost Total harvested products lost
 * @property int $used Total used products count
 * @property int $used_value Total used products value
 * @property string $created_at Creation time
 * @property string $updated_at Last update time
 *
 * @property-read History $next
 * @property Season $season
 */
class History extends \yii\db\ActiveRecord
{

    protected static ?self $now = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year', 'season_id'], 'required'],
            [['year', 'season_id', 'lands', 'plants', 'plants_lost',
                'products', 'products_value', 'products_lost', 'harvested',
                'harvested_value', 'harvested_lost', 'used', 'used_value'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['year', 'season_id'], 'unique', 'targetAttribute' => ['year', 'season_id']],
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
            'year' => Yii::t('app', 'Year'),
            'season_id' => Yii::t('app', 'Season ID'),
            'lands' => Yii::t('app', 'Lands'),
            'plants' => Yii::t('app', 'Plants'),
            'plants_lost' => Yii::t('app', 'Plants Lost'),
            'products' => Yii::t('app', 'Products'),
            'products_value' => Yii::t('app', 'Products Value'),
            'products_lost' => Yii::t('app', 'Products Lost'),
            'harvested' => Yii::t('app', 'Harvested'),
            'harvested_value' => Yii::t('app', 'Harvested Value'),
            'harvested_lost' => Yii::t('app', 'Harvested Lost'),
            'used' => Yii::t('app', 'Used'),
            'used_value' => Yii::t('app', 'Used Value'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return $this
     */
    public function getNext(): self
    {
        $year = $this->year;
        $nextSeason = $this->season->getNextSeason();
        if ($nextSeason->order < $this->season->order) {
            $year++;
        }

        return new self(['year' => $year, 'season_id' => $nextSeason->id]);
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
     * @return $this
     */
    public function prepareStatistic(): self
    {
        $this->lands = Land::find()->count();
        $this->plants = Garden::find()->count();
        $this->products = Gather::find()->where(['!=', 'is_harvested', 1])->count();
        $this->products_value = Gather::find()->where(['!=', 'is_harvested', 1])->sum('value');
        $this->harvested = Gather::find()->where(['=', 'is_harvested', 1])->count();
        $this->harvested_value = Gather::find()->where(['=', 'is_harvested', 1])->sum('value');

        return $this;
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\HistoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\HistoryQuery(get_called_class());
    }

    /**
     * @return static
     */
    public static function findNow(): self
    {
        if (self::$now) {
            return self::$now;
        }
        /** @var History $now */
        $now = History::find()->orderBy(['id' => SORT_DESC])->one();
        if (!$now) {
            $season = Season::find()->orderBy(['order' => 'SORT_ASC'])->one();
            $now = new History(['year' => 1, 'season_id' => $season->id]);
            $now->prepareStatistic();
            $now->save();
        }
        self::$now = $now;

        return $now;
    }
}
