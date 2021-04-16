<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PlantSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plant-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'lifespan') ?>

    <?= $form->field($model, 'temperature_min') ?>

    <?= $form->field($model, 'temperature_max') ?>

    <?php // echo $form->field($model, 'humidity_min') ?>

    <?php // echo $form->field($model, 'humidity_max') ?>

    <?php // echo $form->field($model, 'precipitation_min') ?>

    <?php // echo $form->field($model, 'precipitation_max') ?>

    <?php // echo $form->field($model, 'sunshine_min') ?>

    <?php // echo $form->field($model, 'sunshine_max') ?>

    <?php // echo $form->field($model, 'wind_min') ?>

    <?php // echo $form->field($model, 'wind_max') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
