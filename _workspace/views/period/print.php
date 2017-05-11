<?php

use app\models\Course;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Period */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$teachers = $model->getTeachers();
?>

<div class="container-fluid">

    <h2><?= $model->name ?></h2>

    <div class="table-responsive">
        <table class="table table-bordered table-condensed">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Colegio</th>
                <th>Curso</th>
                <th>Asignatura</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($teachers as $teacher) : ?>
                <tr>
                    <td><?= $teacher['person'] ?></td>
                    <td><?= $teacher['school'] ?></td>
                    <td><?= Course::GRADES[$teacher['grade']] . '-' . Course::LEVELS[$teacher['level']] ?></td>
                    <td><?= $teacher['subject'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

