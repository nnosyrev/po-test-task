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
       'action' => Url::to(['apple/fall']),
   ]) ?>
       <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

       <?= Html::submitButton('Упасть') ?>
   <?php ActiveForm::end() ?>

    <br>

   <?php $form = ActiveForm::begin([
       'id' => 'eat-form',
       'action' => Url::to(['apple/eat', 'id' => $model->id]),
       //'options' => ['class' => 'form-horizontal'],
   ]) ?>
       <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

       <?= Html::dropDownList('percent', null, ['0.25' => '0.25', '0.5' => '0.5', '0.75' => '0.75', '1' => '1']) ?>

       <?= Html::submitButton('Съесть процент') ?>
   <?php ActiveForm::end() ?>
</div>
<br>
