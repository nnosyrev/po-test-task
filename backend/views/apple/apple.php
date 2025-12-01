<?php
   use yii\helpers\Html;
?>

<div class="user">
   <?= $model->id ?>
   <?= Html::encode($model->color) ?>
   <?= Html::encode($model->size) ?>
   <?= Html::encode($model->percent) ?>
   <?= Html::encode($model->status) ?>
</div>
