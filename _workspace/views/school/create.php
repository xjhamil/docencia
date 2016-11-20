<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\School */

$this->title = 'Crear Escuela';
$this->params['breadcrumbs'][] = ['label' => 'Escuelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
