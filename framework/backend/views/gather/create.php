<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Gather */

$this->title = Yii::t('app', 'Create Gather');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gathers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gather-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
