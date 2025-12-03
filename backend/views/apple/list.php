<?php

/** @var yii\web\View $this */

use yii\widgets\ListView;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">Apples:</p>

    </div>
    <br>
    
    <?= ListView::widget([
		'dataProvider' => $dataProvider,
        'itemView' => 'apple'
	]); ?>

</div>
