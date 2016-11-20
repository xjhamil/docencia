<?php

use app\models\Person;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Adicionar Persona', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'options' => ['class' => 'grid-view table-responsive'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'identity',
            'name',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return Person::STATUSES[$model->status];
                },
                'filter' => Person::STATUSES,
            ],
            [
                'attribute' => 'gender',
                'value' => function($model) {
                    return Person::GENDERS[$model->gender];
                },
                'filter' => Person::GENDERS
            ],
            [
                'attribute' => 'phone',
                'filter' => false
            ],
            // 'address',
            // 'picture',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
