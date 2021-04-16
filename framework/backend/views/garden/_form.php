<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Garden */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="garden-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'land_id')->dropDownList(
        ...\common\models\Land::getDropDownList([
        'prompt' => Yii::t('app', 'Select land')
    ])); ?>

    <?= $form->field($model, 'plant_id')->dropDownList(
        ...\common\models\Plant::getDropDownList([
        'prompt' => Yii::t('app', 'Select plant')
    ])); ?>

    <?= $form->field($model, 'fertility')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
