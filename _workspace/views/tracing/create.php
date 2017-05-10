<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tracing */

$this->title = 'Crear Evaluación';
$this->params['breadcrumbs'][] = ['label' => 'Tracings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
