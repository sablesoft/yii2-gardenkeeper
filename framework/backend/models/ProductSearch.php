<?php

namespace backend\models;

use common\models\Plant;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'plant_id', 'ovary_season_id', 'ripening_season_id', 'fertility_begin', 'fertility_end', 'is_droppable', 'quantity', 'value'], 'integer'],
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
                'attribute' => 'plant_id',
                'value' => function ($model) {
                    /** @var ProductSearch $model */
                    return $model->plantLabel;
                },
                'filter' => Plant::getDropDownList()[0]
            ],
//            [
//                'attribute' => 'ovary_season_id',
//                'value' => function ($model) {
//                    /** @var ProductSearch $model */
//                    return $model->ovarySeasonLabel;
//                },
//                'filter' => Season::getDropDownList()[0]
//            ],
//            [
//                'attribute' => 'ripening_season_id',
//                'value' => function ($model) {
//                    /** @var ProductSearch $model */
//                    return $model->ripeningSeasonLabel;
//                },
//                'filter' => Season::getDropDownList()[0]
//            ],
            //'fertility_begin',
            //'fertility_end',
            'is_droppable:boolean',
            //'quantity',
            'value',
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
        $query = Product::find();

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
            'plant_id' => $this->plant_id,
            'ovary_season_id' => $this->ovary_season_id,
            'ripening_season_id' => $this->ripening_season_id,
            'fertility_begin' => $this->fertility_begin,
            'fertility_end' => $this->fertility_end,
            'is_droppable' => $this->is_droppable,
            'quantity' => $this->quantity,
            'value' => $this->value,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
