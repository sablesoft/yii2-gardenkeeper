<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Plant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plant-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-sm-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'temperature_min')->textInput() ?>
        <?= $form->field($model, 'humidity_min')->textInput() ?>
        <?= $form->field($model, 'precipitation_min')->textInput() ?>
        <?= $form->field($model, 'sunshine_min')->textInput() ?>
        <?= $form->field($model, 'wind_min')->textInput() ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'lifespan')->textInput() ?>
        <?= $form->field($model, 'temperature_max')->textInput() ?>
        <?= $form->field($model, 'humidity_max')->textInput() ?>
        <?= $form->field($model, 'precipitation_max')->textInput() ?>
        <?= $form->field($model, 'sunshine_max')->textInput() ?>
        <?= $form->field($model, 'wind_max')->textInput() ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
