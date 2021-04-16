<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Climate */

$this->title = Yii::t('app', 'Create Climate');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Climates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="climate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
