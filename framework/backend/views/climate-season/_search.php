<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ClimateSeasonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="climate-season-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'climate_id') ?>

    <?= $form->field($model, 'season_id') ?>

    <?= $form->field($model, 'temperature') ?>

    <?= $form->field($model, 'humidity') ?>

    <?php // echo $form->field($model, 'precipitation') ?>

    <?php // echo $form->field($model, 'sunshine') ?>

    <?php // echo $form->field($model, 'wind') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
