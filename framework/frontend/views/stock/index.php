<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\GatherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Stock Products');
$this->params['breadcrumbs'][] = $this->title;
$columns = $searchModel->columns;
$columns[] = [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{use}',
    'buttons' => [
        'use' => function($url, $model, $key) {
            $class = 'gift';
            return Html::a(
                "<span class='glyphicon glyphicon-$class'></span>",
                ['/stock/use/', 'id' => $model->id],
                ['title' => Yii::t('app', "Use"), 'data-pjax' => '0']
            );
        }
    ]
];
?>
<div class="stock-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?>

    <?php Pjax::end(); ?>

</div>

