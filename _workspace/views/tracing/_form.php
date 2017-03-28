<?php

use app\models\Evaluation;
use app\models\Indicator;
use kartik\date\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tracing */
/* @var $form yii\widgets\ActiveForm */

$evaluations = $model->evaluations;
if(!count($evaluations)) {
    $indicators = Indicator::find()->all();
    foreach ($indicators as $indicator) {
        $evaluation = new Evaluation();
        $evaluation->tracing_id = $model->id;
        $evaluation->indicator_id = $indicator->id;
        $evaluation->value = 0;
        $evaluations[]=$evaluation;
    }
}
$count = count($evaluations);
?>

<div class="tracing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'period_id')->hiddenInput(['id'=>'period_id'])->label(false); ?>
    <?= $form->field($model, 'school_id')->hiddenInput(['id'=>'school_id'])->label(false); ?>
    <?= $form->field($model, 'person_id')->hiddenInput(['id'=>'person_id'])->label(false); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'date')->widget(DatePicker::className(), [
                'options' => ['placeholder' => 'buscar la fecha ...'],
                'pluginOptions' => [
                    'language' => 'es',
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'autoclose' => true,
                ]
            ]) ?>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Docente</label>
                <div>
                    <?= Select2::widget([
                        'name' => 'teacher',
                        'value' => $model->id,
                        'initValueText' => $model->getSummary(), // set the initial display text
                        'options' => ['id' => 'teacher', 'placeholder' => 'Buscar Docente ...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'minimumInputLength' => 3,
                            'language' => [
                                'errorLoading' => new JsExpression("function () { return 'Esperando...'; }"),
                            ],
                            'ajax' => [
                                'url' => Url::toRoute('teaching/list'),
                                'dataType' => 'json',
                                'data' => new JsExpression('function(params) { return {q:params.term}; }')
                            ],
                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                            'templateResult' => new JsExpression('function(model) { return model.text; }'),
                            'templateSelection' => new JsExpression('function (model) { return model.text; }'),
                        ],
                        'pluginEvents' => [
                            'select2:select' => "function(e) { 
                        var data = e.params.data;
                        $('#person_id').val(data.person_id);
                        $('#school_id').val(data.school_id);
                        $('#period_id').val(data.period_id);
                     }"
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-condensed">
            <thead>
            <tr>
                <th width="50%">Indicador</th>
                <th width="50px">Si</th>
                <th width="50px">No</th>
                <th>Observacion</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($evaluations as $index => $evaluation) : ?>
                <tr>
                    <td><?= $evaluation->indicator->name ?></td>
                    <td>
                        <input type="radio" title="SI" value="1"
                               name="Evaluation[<?= $evaluation->indicator_id ?>]"
                               <?php if($evaluation->value==1) echo 'checked'; ?>
                        >
                    </td>
                    <td>
                        <input type="radio" title="NO" value="0"
                               name="Evaluation[<?= $evaluation->indicator_id ?>]"
                            <?php if($evaluation->value==0) echo 'checked'; ?>
                        >
                    </td>
                    <?php if($index==0) : ?>
                        <td rowspan="<?= $count; ?>">
                            <textarea title="Observacion" name="Tracing[observation]"
                            ><?= $model->observation; ?></textarea>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
