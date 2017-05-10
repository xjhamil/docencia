<?php

use app\models\Period;
use app\models\Person;
use app\models\School;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TracingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Evaluación Docente';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracing-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Evaluación', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'date',
            //'observation',
            [
                'attribute'=>'period_id',
                'value'=>function($model) {
                    return $model->period->name;
                },
                'filter'=>ArrayHelper::map(
                    Period::find()->all(), 'id', 'name'
                )
            ],

            [
                'attribute'=>'school_id',
                'value'=>function($model) {
                    return $model->school->name;
                },
                'filter'=>ArrayHelper::map(
                    School::find()->all(), 'id', 'name'
                )
            ],

            [
                'attribute'=>'person_id',
                'value'=>function($model) {
                    return $model->person->name;
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {print}',
                'buttons' => [
                    'print' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-print"></span>', $url);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
