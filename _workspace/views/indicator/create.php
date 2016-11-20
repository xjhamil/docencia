<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Indicator */

$this->title = 'Crear Indicador';
$this->params['breadcrumbs'][] = ['label' => 'Indicadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indicator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
