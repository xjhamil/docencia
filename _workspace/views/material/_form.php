<?php

use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Material */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'postulant_id')->widget(Select2::className(), [
        'initValueText' => (!$model->isNewRecord)? $model->postulant->person->name:'', // set the initial display text
        'options' => ['placeholder' => 'Buscar una Persona ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Esperando...'; }"),
            ],
            'ajax' => [
                'url' => Url::toRoute('postulant/list'),
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(model) { return model.text; }'),
            'templateSelection' => new JsExpression('function (model) { return model.text; }'),
        ],
    ]); ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
        'options' => ['placeholder' => 'buscar la fecha ...'],
        'pluginOptions' => [
            'language' => 'es',
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true,
        ]
    ]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
