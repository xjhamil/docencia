<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Requirement */

$this->title = 'Actualizar Requerimiento: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Requerimiento', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="requirement-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
