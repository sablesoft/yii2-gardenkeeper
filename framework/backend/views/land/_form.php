<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Land */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="land-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->dropDownList(
        ...\common\models\User::getDropDownList([
            'to' => 'username',
            'prompt' => Yii::t('app', 'Select owner')
    ])); ?>

    <?= $form->field($model, 'climate_id')->dropDownList(
        ...\common\models\Climate::getDropDownList([
            'prompt' => Yii::t('app', 'Select climate zone')
    ])); ?>

<!--    < ?= $form->field($model, 'width')->textInput() ?>-->
<!---->
<!--    < ?= $form->field($model, 'length')->textInput() ?>-->
<!---->
<!--    < ?= $form->field($model, 'rating')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
