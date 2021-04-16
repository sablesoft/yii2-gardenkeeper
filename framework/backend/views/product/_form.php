<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'plant_id')->dropDownList(
        ...\common\models\Plant::getDropDownList([
        'prompt' => Yii::t('app', 'Select plant')
    ])); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ovary_season_id')->dropDownList(
        ...\common\models\Season::getDropDownList([
        'prompt' => Yii::t('app', 'Select ovary season')
    ])); ?>

    <?= $form->field($model, 'ripening_season_id')->dropDownList(
        ...\common\models\Season::getDropDownList([
        'prompt' => Yii::t('app', 'Select ripening season')
    ])); ?>

    <?= $form->field($model, 'fertility_begin')->textInput() ?>

    <?= $form->field($model, 'fertility_end')->textInput() ?>

    <?= $form->field($model, 'is_droppable')->checkbox() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
