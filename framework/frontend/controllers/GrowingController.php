<?php

namespace frontend\controllers;

use backend\models\GatherSearch;
use common\models\Gather;
use yii\filters\AccessControl;

/**
 * Class GrowingController
 * @package frontend\controllers
 */
class GrowingController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GatherSearch();
        $searchModel->is_harvested = 0;
        $dataProvider = $searchModel->search([]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionHarvest($id)
    {
        if ($model = Gather::findOne($id)) {
            $model->is_harvested = 1;
            $model->garden_id = null;
            $model->save();
        }

        return $this->redirect('index');
    }
}
