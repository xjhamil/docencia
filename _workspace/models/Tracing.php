<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tracing}}".
 *
 * @property integer $id
 * @property string $date
 * @property string $observation
 * @property integer $person_id
 * @property integer $period_id
 * @property integer $school_id
 *
 * @property Evaluation[] $evaluations
 * @property Period $period
 * @property Person $person
 * @property School $school
 */
class Tracing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tracing}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'person_id', 'period_id'], 'required'],
            [['date'], 'safe'],
            [['observation'], 'string'],
            [['person_id', 'period_id', 'school_id'], 'integer'],
            [['period_id'], 'exist', 'skipOnError' => true, 'targetClass' => Period::className(), 'targetAttribute' => ['period_id' => 'id']],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'id']],
            [['school_id'], 'exist', 'skipOnError' => true, 'targetClass' => School::className(), 'targetAttribute' => ['school_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Fecha',
            'observation' => 'Observacion',
            'person_id' => 'Persona',
            'period_id' => 'Periodo',
            'school_id' => 'Colegio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluations()
    {
        return $this->hasMany(Evaluation::className(), ['tracing_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriod()
    {
        return $this->hasOne(Period::className(), ['id' => 'period_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(School::className(), ['id' => 'school_id']);
    }

    public function getSummary() {
        if(!$this->isNewRecord)
            return $this->person->name . ', ' . $this->school->name . ', ' . $this->period->name;
        return '';
    }

    public function saveEvaluations($params) {
        $evaluations = $params['Evaluation'];
        Evaluation::deleteAll(['tracing_id'=>$this->id]);
        foreach ($evaluations as $indicator_id => $value) {
            $evaluation = new Evaluation();
            $evaluation->indicator_id = $indicator_id;
            $evaluation->tracing_id = $this->id;
            $evaluation->value = $value;
            $evaluation->save();
        }
    }
}
