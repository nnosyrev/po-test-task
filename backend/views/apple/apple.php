<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<div class="user">
   <?= $model->id ?>
   <?= Html::encode($model->color->value) ?>
   <?= Html::encode($model->size) ?>
   <?= Html::encode($model->status) ?>

   <?php $form = ActiveForm::begin([
       'id' => 'fall-form',
       'action' => Url::to(['apple/drop', 'id' => $model->id]),
   ]) ?>

       <?= Html::submitButton('Сбросить') ?>
   <?php ActiveForm::end() ?>

    <br>

   <?php $form = ActiveForm::begin([
       'id' => 'eat-form',
       'action' => Url::to(['apple/eat', 'id' => $model->id]),
       //'options' => ['class' => 'form-horizontal'],
   ]) ?>
       <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

       <?= Html::dropDownList('percent', null, ['25' => '25', '50' => '50', '75' => '75', '100' => '100']) ?>

       <?= Html::submitButton('Съесть процент') ?>
   <?php ActiveForm::end() ?>
</div>
<br>
