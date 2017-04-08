<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use app\models\Profession;

$this->title = 'Запись на прием';
$this->params['breadcrumbs'][] = $this->title;
$request = Yii::$app->request->post();
$requestJson = array();
if (isset($request)) $requestJson = $request;
?>

<div class="site-reception">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(['id' => 'pjax-act', 'clientOptions' => ['method' => 'POST']]) ?>
	    <script>
	    	postData = '<?= json_encode($requestJson) ?>';
	    	receptionDate = '<?= ((isset($request['date']))
	    					? ($request['date'])
	    					: (date('Y-m-d'))) ?>';
	    	setTimeout(function() {
		    	if (receptionDate && $('.empty').text() != '') {
		    		date = new Date(receptionDate);
		    		today = new Date;
		    		if (today.setHours(0, 0, 0, 0) > date) $('.empty').text('Запись в прошлом невозможна');
		    		else if (date.getMonth() + ((today.getMonth() > date.getMonth())?(12):(0)) - today.getMonth() >= 2) $('.empty').text('Запись возможна только на текущий месяц и следующий за ним');
		    		else if (date.getDay() == 0 || date.getDay() == 6)  $('.empty').text('На выходных приема нет');
		    	}
	    	}, 0);
	    </script>
	    <label>Дата:</label>
	    <?= ((isset($request['date']))
	    					? ($request['date'])
	    					: (date('Y-m-d'))) ?>
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
	    				'value' => ((isset($request['date']))
	    					? ($request['date'])
	    					: (date('Y-m-d'))),//date('Y-m-d'),
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
	    				'class' => 'form-control',
	    				'value' => ((isset($request['ReceptionsSearch']['time']))
	    					? ($request['ReceptionsSearch']['time'])
	    					: ('')),
	    			],
	    		],
	    		[
	    			'attribute' => 'doctorName',
	    			'filterInputOptions' => [
	    				'class' => 'form-control',
	    				'value' => ((isset($request['ReceptionsSearch']['doctorName']))
	    					? ($request['ReceptionsSearch']['doctorName'])
	    					: ('')),
	    			],
	    		],
	    		[
	    			'attribute' => 'profession_id',
	    			'format' => 'raw',
	    			'filter' => Html::dropDownList(
	    					'profession_id',
	    					((isset($request['profession_id']))
	    						? ($request['profession_id'])
	    						: (0)),
	    					Profession::allProfessions(),
	    					[
	    						'class' => 'form-control'
	    					]
	    				),
	    			'value' => function ($model, $key, $index, $column) {
	    				return Profession::findOne($model['doctor']['profession_id'])['name'];
	    			},
	    			'header' => 'Специализация',
	    		],
	    		[
	    			'class' => \yii\grid\ActionColumn::class,
	    			'header' => 'Записаться',
	    			'template' => '{write}',
	    			'buttons' => [
	    				'write' => function ($url,$model,$key) {
                    		if ($model->user_id == 0) return Html::a(
                    				'<span class="glyphicon glyphicon-pencil" style="cursor: pointer;"></span>',
                    				false,
                    				[
                    					'class' => 'ajaxWrite',
                    					'write-url' => $url,
                    					'pjax-container' => 'pjax-act',
                    				]
                    			);
                    		else return '<span class="label label-success">Вы записаны</span>';
	    				}
	    			]
	    		]
	    	]
		]); ?>
	<?php Pjax::end() ?>
</div>
