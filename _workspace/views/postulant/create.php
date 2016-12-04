<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Postulant */

$this->title = 'Crear Postulante';
$this->params['breadcrumbs'][] = ['label' => 'Postulants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postulant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
