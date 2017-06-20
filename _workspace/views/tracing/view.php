<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tracing */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Evaluación', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracing-view">

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
            'id',
            'date',
            'person.name',
            'period.name',
            'school.name',
            'observation',
        ],
    ]) ?>

</div>
