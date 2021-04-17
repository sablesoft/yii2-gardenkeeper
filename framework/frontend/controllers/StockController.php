<?php

namespace frontend\controllers;

use common\models\Gather;
use common\models\History;
use backend\models\GatherSearch;
use yii\filters\AccessControl;

/**
 * Class StockController
 * @package frontend\controllers
 */
class StockController extends \yii\web\Controller
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
        $searchModel->is_harvested = 1;
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionUse($id)
    {
        if ($model = Gather::findOne($id)) {
            if (!$model->land->user_id != \Yii::$app->user->id) {
                \Yii::$app->session->addFlash('error', "It's not your stock!");
                return $this->redirect('index');
            }
            $now = History::findNow();
            $now->updateCounters(['used' => 1, 'used_value' => $model->value]);
            $model->delete();
        }

        return $this->redirect('index');
    }
}
