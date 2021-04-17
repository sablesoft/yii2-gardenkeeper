<?php

namespace frontend\controllers;

use backend\models\GatherSearch;
use common\models\Gather;
use common\models\History;
use common\models\User;
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
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

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
            if (!$model->land->user_id != \Yii::$app->user->id) {
                \Yii::$app->session->addFlash('error', "It's not your land!");
                return $this->redirect('index');
            }
            $model->is_harvested = 1;
            $model->garden_id = null;
            $model->save();
            $now = History::findNow();
            $now->updateCounters(['harvested' => 1, 'harvested_value' => $model->value]);
        }

        return $this->redirect('index');
    }
}
