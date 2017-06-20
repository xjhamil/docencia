<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Report */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$directory = Yii::$app->homeUrl.'upload';

?>

<img src="<?= $directory.'/'.$model->file ?>">
