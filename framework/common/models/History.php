<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property int $id
 * @property int $year Year of history
 * @property int $season_id Year season ID
 * @property string $created_at Creation time
 * @property string $updated_at Last update time
 *
 * @property-read History $next
 * @property Season $season
 */
class History extends \yii\db\ActiveRecord
{
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
            [['year', 'season_id'], 'integer'],
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
        $now = History::find()->orderBy(['id' => SORT_DESC])->one();
        if (!$now) {
            $season = Season::find()->orderBy(['order' => 'SORT_ASC'])->one();
            $now = new History(['year' => 1, 'season_id' => $season->id]);
            $now->save();
        }

        return $now;
    }
}
