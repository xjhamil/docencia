<?php

use app\models\Documentation;
use app\models\Requirement;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Documentation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documentation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'postulant_id')->widget(Select2::className(), [
        'initValueText' => (!$model->isNewRecord)? $model->postulant->person->name:'', // set the initial display text
        'options' => ['placeholder' => 'Buscar un Postulante ...'],
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


    <?= $form->field($model, 'requirement_id')->dropDownList(
        ArrayHelper::map(Requirement::find()->all(), 'id', 'name')
    ) ?>

    <?= $form->field($model, 'value')->radioList(Documentation::VALUES) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
