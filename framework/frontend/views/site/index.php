<?php

/* @var $this yii\web\View */
/* @var $now \common\models\History */

use yii\helpers\Html;

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome!</h1>

        <p class="lead">Garden Keeper v0.1</p>
        <p class="h1">Now is <?= $now->season->name; ?>, <?= $now->year; ?>-th year</p>
        <?php if (!Yii::$app->user->isGuest): ?>
        <p><?= Html::a('Go to next Season', ['/site/wait'], ['class' => 'btn btn-lg btn-success']); ?></p>
        <?php else: ?>
        <p><?= Html::a('Login', ['/login'], ['class' => 'btn btn-lg btn-success']); ?></p>
        <?php endif; ?>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-sm-3">
                <h2>Gardens</h2>

                <p>Lands: <?= $now->lands; ?></p>
                <p>Plants: <?= $now->plants; ?></p>
                <p>Plants Lost: <?= $now->plants_lost; ?></p>

                <?php if (!Yii::$app->user->isGuest): ?>
                <p><?= Html::a('Go to Plants', ['/plants'], ['class' => 'btn btn-default']); ?></p>
                <?php endif; ?>
            </div>
            <div class="col-sm-3">
                <h2>Growing</h2>

                <p>Products Count: <?= $now->products; ?></p>
                <p>Products Value: <?= $now->products_value; ?></p>
                <p>Products Lost: <?= $now->products_lost; ?></p>

                <?php if (!Yii::$app->user->isGuest): ?>
                <p><?= Html::a('Go to Growing Products', ['/growing'], ['class' => 'btn btn-default']); ?></p>
                <?php endif; ?>
            </div>
            <div class="col-sm-3">
                <h2>Stock</h2>

                <p>Products Count: <?= $now->harvested; ?></p>
                <p>Products Value: <?= $now->harvested_value; ?></p>
                <p>Products Lost: <?= $now->harvested_lost; ?></p>

                <?php if (!Yii::$app->user->isGuest): ?>
                <p><?= Html::a('Go to Stock', ['/stock'], ['class' => 'btn btn-default']); ?></p>
                <?php endif; ?>
            </div>
            <div class="col-sm-3">
                <h2>Used</h2>

                <p>Products Count: <?= $now->used; ?></p>
                <p>Products Value: <?= $now->used_value; ?></p>
            </div>
        </div>

    </div>
</div>
