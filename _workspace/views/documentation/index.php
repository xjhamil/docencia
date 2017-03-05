<?php

use app\models\Documentation;
use app\models\Period;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documentacion';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Documento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'period_search',
                'label' => 'Periodo',
                'value' => function($model) {
                    return $model->postulant->period->name;
                },
                'filter' => ArrayHelper::map(Period::find()->all(), 'id', 'name')
            ],
            [
                'attribute' => 'person_search',
                'label' => 'Postulante',
                'value' => function($model) {
                    return $model->postulant->person->name;
                }
            ],
            [
                'attribute' => 'requirement_search',
                'label' => 'Requisito',
                'value' => function($model) {
                    return $model->requirement->name;
                }
            ],
            [
                'attribute' => 'value',
                'value' => function($model) {
                    return Documentation::VALUES[$model->value];
                },
                'filter' => Documentation::VALUES
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
