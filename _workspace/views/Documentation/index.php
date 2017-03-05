<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documentations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Documentation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'requirement_id',
            'value',
            'postulant_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
