<?php

use app\models\Course;
use app\models\Period;
use app\models\School;
use app\models\Subject;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeachingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asignación';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teaching-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Realizar Asignación', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'label'=>'Persona',
                'attribute'=>'person_name',
                'value'=>function($model) {
                    return $model->person->name;
                },
            ],
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
                'attribute'=>'course_id',
                'value'=>function($model) {
                    return $model->course->name;
                },
                'filter'=>ArrayHelper::map(
                    Course::find()->all(), 'id', 'name'
                )
            ],
            [
                'attribute'=>'subject_id',
                'value'=>function($model) {
                    return $model->subject->name;
                },
                'filter'=>ArrayHelper::map(
                    Subject::find()->all(), 'id', 'name'
                )
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
