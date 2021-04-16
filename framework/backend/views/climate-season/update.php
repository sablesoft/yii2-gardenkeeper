<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ClimateSeason */

$this->title = Yii::t('app', 'Update Climate Season: {name}', [
    'name' => $model->label,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Climate Seasons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="climate-season-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
