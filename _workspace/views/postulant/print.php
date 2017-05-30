<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Postulant */

$documentations = $model->documentations;
$directory = Yii::$app->homeUrl.'upload';
?>
<div class="postulant-view">

    <h1><?= $model->person->name .'-'. $model->period->name ?></h1>

    <?php foreach ($documentations as $documentation) : ?>

        <img src="<?= $directory.'/'.$documentation->value ?>">

    <?php endforeach; ?>

</div>
