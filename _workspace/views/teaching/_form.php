<?php

use app\models\Course;
use app\models\Period;
use app\models\School;
use app\models\Subject;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Teaching */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teaching-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'postulant_id')->widget(Select2::className(), [
        'initValueText' => (!$model->isNewRecord)? $model->person->name:'', // set the initial display text
        'options' => ['placeholder' => 'Buscar Postulante ...'],
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

    <?= $form->field($model, 'school_id')->dropDownList(
        ArrayHelper::map(School::find()->all(), 'id', 'name')
    ) ?>

    <?= $form->field($model, 'course_id')->dropDownList(
        ArrayHelper::map(Course::find()->all(), 'id', 'name')
    ) ?>

    <?= $form->field($model, 'subject_id')->dropDownList(
        ArrayHelper::map(Subject::find()->all(), 'id', 'name')
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
