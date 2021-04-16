<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ClimateSeason;
use common\models\Climate;
use common\models\Season;

/**
 * ClimateSeasonSearch represents the model behind the search form of `common\models\ClimateSeason`.
 */
class ClimateSeasonSearch extends ClimateSeason
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'climate_id', 'season_id', 'temperature', 'humidity', 'precipitation', 'sunshine', 'wind'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'climate_id',
                'value' => function ($model) {
                    /** @var ClimateSeasonSearch $model */
                    return $model->climateLabel;
                },
                'filter' => Climate::getDropDownList()[0]
            ],
            [
                'attribute' => 'season_id',
                'value' => function ($model) {
                    /** @var ClimateSeasonSearch $model */
                    return $model->seasonLabel;
                },
                'filter' => Season::getDropDownList()[0]
            ],
            'temperature',
            'humidity',
            'precipitation',
            'sunshine',
            'wind',

            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'filter' => false
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
                'filter' => false
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ClimateSeason::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'climate_id' => $this->climate_id,
            'season_id' => $this->season_id,
            'temperature' => $this->temperature,
            'humidity' => $this->humidity,
            'precipitation' => $this->precipitation,
            'sunshine' => $this->sunshine,
            'wind' => $this->wind,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
