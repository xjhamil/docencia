<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Postulant */

$this->title = 'Actualizar Postulante: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Postulante', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="postulant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
