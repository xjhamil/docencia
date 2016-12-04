<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Postulant */

$this->title = $model->person->name;
$this->params['breadcrumbs'][] = ['label' => 'Postulante', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postulant-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Desea eliminar?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           //'id',
            'person.name',
            'period.name',
            [
                'attribute'=>'approved',
                'value'=>($model->approved)? 'Si':'No'
            ],
        ],
    ]) ?>

</div>
