<?php

use app\models\Period;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Postulant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="postulant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'person_id')->widget(Select2::className(), [
        'initValueText' => (!$model->isNewRecord)? $model->person->name:'', // set the initial display text
        'options' => ['placeholder' => 'Buscar una Persona ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Esperando...'; }"),
            ],
            'ajax' => [
                'url' => Url::toRoute('person/list'),
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(model) { return model.text; }'),
            'templateSelection' => new JsExpression('function (model) { return model.text; }'),
        ],
    ]); ?>

    <?= $form->field($model, 'period_id')->dropDownList(
        ArrayHelper::map(Period::find()->all(), 'id', 'name')
    ) ?>

    <?= $form->field($model, 'approved')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
