<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;

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
	    				'value' => date('Y-m-d'),
						'pluginOptions' => [
							'format' => 'yyyy-mm-dd',
							'todayHighlight' => true,
							'autoclose'=>true
						]
	    			]),
	    		],
	    		'time',
	    		[
	    			'attribute' => 'doctorName',
	    			'format' => 'raw',
	    			//'format'=>'text',
	    			//'class' => DataColumn::className(),
	    			/*'filter' => function($data) {
	    				return '777';
	    			}*/
	    			//'filter' => '123',
	    		],
	    	]
		]); ?>
	<?php Pjax::end() ?>
</div>
