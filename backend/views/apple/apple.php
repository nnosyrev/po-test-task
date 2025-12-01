<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="user">
   <?= $model->id ?>
   <?= Html::encode($model->color) ?>
   <?= Html::encode($model->size) ?>
   <?= Html::encode($model->percent) ?>
   <?= Html::encode($model->status) ?>

   <?php $form = ActiveForm::begin([
       'id' => 'fall-form',
       //'options' => ['class' => 'form-horizontal'],
   ]) ?>
       <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

       <?= Html::submitButton('Упасть') ?>
   <?php ActiveForm::end() ?>

    <br>

   <?php $form = ActiveForm::begin([
       'id' => 'eat-form',
       //'options' => ['class' => 'form-horizontal'],
   ]) ?>
       <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
       <?= $form->field($model, 'percent') ?>

       <?= Html::submitButton('Откусить процент') ?>
   <?php ActiveForm::end() ?>
</div>
<br>
