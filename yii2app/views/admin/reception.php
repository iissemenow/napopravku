<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use app\models\Profession;

$this->title = 'Запись на прием';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <!-- <pre><?= print_r($dataProvider); ?></pre> -->
    <!-- <pre><?= print_r(json_decode('{"1": "09.00-12.00+13.00-17.00", "2": "09.00-12.00+13.00-17.00", "3": "09.00-12.00+13.00-17.00"}', true)[1]) ?></pre> -->

    <?php Pjax::begin([/*'id' => 'container-id', 'timeout' => false, 'enablePushState' => true,*/ 'clientOptions' => ['method' => 'POST']]) ?>
	    <?= GridView::widget([
	    	'dataProvider' => $dataProvider,
	    	'filterModel' => $searchModel,
	    	'columns' => [
	    		[
	    			'attribute' => 'date',
	    			'format' => 'raw',
	    			'filter' => DatePicker::widget([
	    				'language' => 'ru',
	    				'type' => DatePicker::TYPE_BUTTON,
	    				'name' => 'date',
	    				'value' => ((isset($_REQUEST['date']))?($_REQUEST['date']):(date('Y-m-d'))),//date('Y-m-d'),
						'pluginOptions' => [
							'format' => 'yyyy-mm-dd',
							'todayHighlight' => true,
							'autoclose'=>true
						]
	    			]),
	    		],
	    		[
	    			'attribute' => 'time',
	    			'filterInputOptions' => [
	    				'value' => ((isset($_REQUEST['ReceptionsSearch']['time']))
	    					? ($_REQUEST['ReceptionsSearch']['time'])
	    					: ('')),
	    			],
	    		],
	    		[
	    			'attribute' => 'doctorName',
	    			'filterInputOptions' => [
	    				'value' => ((isset($_REQUEST['ReceptionsSearch']['doctorName']))
	    					? ($_REQUEST['ReceptionsSearch']['doctorName'])
	    					: ('')),
	    			],
	    		],
	    		[
	    			'attribute' => 'profession_id',
	    			'format' => 'raw',
	    			'filter' => Profession::allProfessions(),
	    			'value' => function ($model, $key, $index, $column) {
	    				return Profession::findOne($model['doctor']['profession_id'])['name'];
	    			},
	    			'header' => 'Специализация',
	    		],
	    		//'tbl_profession.name',
	    	]
		]); ?>
	<?php Pjax::end() ?>
</div>
