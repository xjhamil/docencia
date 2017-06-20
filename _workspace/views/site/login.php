<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Ingreso';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

            <p>Porfavor ingresa tus datos Usuario y Contraseña:</p>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div>
                <div class="pull-left" style="margin-left: 20px">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
                <div class="pull-right">
                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
