<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Teaching */

$this->title = 'Asignacion Docencia';
$this->params['breadcrumbs'][] = ['label' => 'Docencia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teaching-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
