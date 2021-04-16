<?php

namespace backend\models;

use common\models\Climate;
use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Land;

/**
 * LandSearch represents the model behind the search form of `common\models\Land`.
 */
class LandSearch extends Land
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'climate_id', 'width', 'length', 'rating'], 'integer'],
            [['name', 'created_at', 'updated_at'], 'safe'],
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
            'name',
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    /** @var LandSearch $model */
                    return $model->userLabel;
                },
                'filter' => User::getDropDownList(['to' => 'username'])[0]
            ],
            [
                'attribute' => 'climate_id',
                'value' => function ($model) {
                    /** @var LandSearch $model */
                    return $model->climateLabel;
                },
                'filter' => Climate::getDropDownList()[0]
            ],
//            'width',
//            'length',
            'rating',
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
        $query = Land::find();

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
            'user_id' => $this->user_id,
            'climate_id' => $this->climate_id,
            'width' => $this->width,
            'length' => $this->length,
            'rating' => $this->rating,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
