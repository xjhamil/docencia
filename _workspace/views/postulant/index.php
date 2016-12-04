<?php

use app\models\Period;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostulantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Postulante';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postulant-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Postulante', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute'=>'approved',
                'value'=>function($model) {
                    return ($model->approved)? 'Si':'No';
                },
                'filter'=>[1=>'Si',0=>'No']
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
