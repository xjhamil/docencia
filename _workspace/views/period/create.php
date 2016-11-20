<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Period */

$this->title = 'Crear Periodo';
$this->params['breadcrumbs'][] = ['label' => 'Periods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="period-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
