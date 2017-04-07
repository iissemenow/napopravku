<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker::className();

$this->title = 'Запись на прием';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
    	'dataProvider' => $dataProvider,
    	'columns' => [
    		'id',
    		[
    			'class' => \yii\grid\DataColumn::class,
    			'attribute' => 'date',
    		]
    	]
	]); ?>
</div>
