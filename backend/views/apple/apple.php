<?php

use common\models\Apple;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$size = $model->size * 100;

$current = 25;

$percents = [];
while ($current <= $size) {
    $percents[$current] = $current . '%';
    $current += 25;
}

?>

<div class="user">
    Apple #<?= $model->id ?>
    <?= Html::encode($model->color->value) ?>
    <?= Html::encode($model->size) ?>
    <?= Html::encode($model->status) ?>

    <?php if ($model->status === Apple::STATUS_HANGING): ?>

        <?php $form = ActiveForm::begin([
            'id' => 'fall-form',
            'action' => Url::to(['apple/drop', 'id' => $model->id]),
        ]) ?>

            <?= Html::submitButton('Drop') ?>
        <?php ActiveForm::end() ?>

        <br>

    <?php endif; ?>

    <?php if ($model->status === Apple::STATUS_DROPPED): ?>

        <?php $form = ActiveForm::begin([
            'id' => 'eat-form',
            'action' => Url::to(['apple/eat', 'id' => $model->id]),
            //'options' => ['class' => 'form-horizontal'],
        ]) ?>
            <?= Html::dropDownList('percent', null, $percents) ?>

            <?= Html::submitButton('Eat percent') ?>
        <?php ActiveForm::end() ?>

    <?php endif; ?>
</div>
<br>
<br>
