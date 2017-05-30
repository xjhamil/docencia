<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tracing */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$directory = Yii::$app->homeUrl.'upload';
$evaluations = $model->evaluations;
$count = count($evaluations);
?>

<div class="container-fluid">
    <h2 class="text-center">Formulario de Evaluacion Docente</h2>
    <p>
        En la ciudad de Cobija en fecha <?= $model->date ?> se llevó a cabo la
        SUPERVISIÓN Y SEGUIMIENTO DOCENTE en la Unidad Educativa <?= $model->school->name ?>
        a fin de realizar la supervisión y verificar la permanencia, responsabilidad
        y cumplimiento de funciones de los docentes en la Unidad Educativa asignada.
    </p>

    <h2><?= $model->person->name ?></h2>

    <img src="<?= $directory . '/' . $model->person->picture ?>" width="200px">

    <div class="table-responsive">
        <table class="table table-bordered table-condensed">
            <thead>
            <tr>
                <th width="50%">Indicador</th>
                <th width="50px">Si</th>
                <th width="50px">No</th>
                <th>Observacion</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($evaluations as $index => $evaluation) : ?>
                <tr>
                    <td><?= $evaluation->indicator->name ?></td>
                    <td class="text-center"><?php if($evaluation->value==1) echo 'X'; ?></td>
                    <td class="text-center"><?php if($evaluation->value==0) echo 'X'; ?></td>
                    <?php if($index==0) : ?>
                        <td rowspan="<?= $count; ?>" style="vertical-align: top;">
                            <?= $model->observation; ?>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

