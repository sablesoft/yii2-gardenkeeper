<?php

namespace backend\models;

use common\helpers\AreaHelper;
use common\models\Garden;
use common\models\Land;
use common\models\Product;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Gather;

/**
 * GatherSearch represents the model behind the search form of `common\models\Gather`.
 */
class GatherSearch extends Gather
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'land_id', 'product_id', 'garden_id', 'is_harvested',
                'ripeness', 'health', 'value'], 'integer'],
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
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',

            [
                'attribute' => 'land_id',
                'value' => function ($model) {
                    /** @var GardenSearch $model */
                    return $model->landLabel;
                },
                'filter' => Land::getDropDownList()[0]
            ],
            [
                'attribute' => 'garden_id',
                'value' => function ($model) {
                    /** @var GatherSearch $model */
                    return $model->gardenLabel;
                },
                'filter' => Garden::getDropDownList(['to' => 'label'])[0]
            ],
            [
                'attribute' => 'product_id',
                'value' => function ($model) {
                    /** @var GatherSearch $model */
                    return $model->productLabel;
                },
                'filter' => Product::getDropDownList()[0]
            ],
        ];

        if (!AreaHelper::isFrontend()) {
            $columns[] = 'is_harvested:boolean';
        }

        $columns[] = 'ripeness';
        $columns[] = 'health';
        $columns[] = 'value';

        if (!AreaHelper::isFrontend()) {
            $columns = array_merge($columns, [
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
                ['class' => 'yii\grid\ActionColumn']
            ]);
        }

        return $columns;
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
        $query = Gather::find();

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
            'land_id' => $this->land_id,
            'product_id' => $this->product_id,
            'garden_id' => $this->garden_id,
            'is_harvested' => $this->is_harvested,
            'ripeness' => $this->ripeness,
            'health' => $this->health,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
