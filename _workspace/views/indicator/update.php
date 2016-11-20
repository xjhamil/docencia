<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Indicator */

$this->title = 'Actualizar Indicador: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Indicadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'actualizar';
?>
<div class="indicator-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
