<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Teaching */

$this->title = 'Asignado a '.$model->person->name;
$this->params['breadcrumbs'][] = ['label' => 'Teachings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teaching-view">

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
            'school.name',
            'course.name',
            'subject.name',
        ],
    ]) ?>

</div>
