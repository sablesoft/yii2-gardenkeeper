<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Garden */

$this->title = Yii::t('app', 'Create Garden');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gardens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="garden-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
