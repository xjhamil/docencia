<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Documentation */

$this->title = 'Crear Documento';
$this->params['breadcrumbs'][] = ['label' => 'Documentations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
