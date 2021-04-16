<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ClimateSeason */

$this->title = Yii::t('app', 'Create Climate Season');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Climate Seasons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="climate-season-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
