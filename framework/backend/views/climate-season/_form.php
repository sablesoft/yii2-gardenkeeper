<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ClimateSeason */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="climate-season-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'climate_id')->dropDownList(
                ...\common\models\Climate::getDropDownList([
                'prompt' => Yii::t('app', 'Select climate zone')
            ])); ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($model, 'season_id')->dropDownList(
                ...\common\models\Season::getDropDownList([
                'prompt' => Yii::t('app', 'Select season')
            ])); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'temperature')->textInput() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'humidity')->textInput() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'precipitation')->textInput() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'sunshine')->textInput() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'wind')->textInput() ?>
        </div>
    </div>

    <br>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
