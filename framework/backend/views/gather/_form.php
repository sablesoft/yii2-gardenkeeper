<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Gather */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gather-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'garden_id')->dropDownList(
        ...\common\models\Garden::getDropDownList([
            'to' => 'label',
            'prompt' => Yii::t('app', 'Select garden plant')
    ])); ?>
    <?= $form->field($model, 'product_id')->dropDownList(
        ...\common\models\Product::getDropDownList([
        'prompt' => Yii::t('app', 'Select product')
    ])); ?>

    <?= $form->field($model, 'is_harvested')->checkbox() ?>
    <?= $form->field($model, 'ripeness')->textInput() ?>
    <?= $form->field($model, 'health')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
