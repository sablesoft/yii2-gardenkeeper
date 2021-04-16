<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GatherSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gather-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'land_id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'garden_id') ?>

    <?= $form->field($model, 'is_harvested') ?>

    <?php // echo $form->field($model, 'ripeness') ?>

    <?php // echo $form->field($model, 'health') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
