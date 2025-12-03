<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">Apples:</p>

    </div>

    <?php $form = ActiveForm::begin([
        'id' => 'create-form',
        'action' => Url::to(['apple/create']),
    ]) ?>
        <?= Html::submitButton('Create new apples') ?>
    <?php ActiveForm::end() ?>

    <br>
    <br>
    <br>
    
    <?= ListView::widget([
		'dataProvider' => $dataProvider,
        'itemView' => 'apple'
	]); ?>

</div>
