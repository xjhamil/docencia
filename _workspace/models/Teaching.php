<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%teaching}}".
 *
 * @property integer $id
 * @property integer $person_id
 * @property integer $period_id
 * @property integer $school_id
 * @property integer $course_id
 * @property integer $subject_id
 *
 * @property Course $course
 * @property Period $period
 * @property Person $person
 * @property School $school
 * @property Subject $subject
 */
class Teaching extends \yii\db\ActiveRecord
{
    public $postulant_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%teaching}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'period_id', 'school_id', 'course_id', 'subject_id', 'postulant_id'], 'required'],
            [['person_id', 'period_id', 'school_id', 'course_id', 'subject_id', 'postulant_id'], 'integer'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['period_id'], 'exist', 'skipOnError' => true, 'targetClass' => Period::className(), 'targetAttribute' => ['period_id' => 'id']],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'id']],
            [['school_id'], 'exist', 'skipOnError' => true, 'targetClass' => School::className(), 'targetAttribute' => ['school_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
           // 'id' => 'ID',
            'person_id' => 'Persona',
            'period_id' => 'Periodo',
            'school_id' => 'Escuela',
            'course_id' => 'Curso',
            'subject_id' => 'Asignatura',
            'postulant_id' => 'Postulante'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    public function getSummary() {
        if(!$this->isNewRecord)
            return $this->person->name . ', ' . $this->school->name . ', ' . $this->period->name;
        return '';
    }

    public static function Report() {
        $query = Teaching::find();
        $query->alias('t');
        $query->select([
            's.name',
            'COUNT(t.id)*1 y'
        ]);
        $query->innerJoin('{{%school}} s', 't.school_id=s.id');
        $query->groupBy('t.school_id');
        $query->orderBy('s.name');
        $query->asArray(true);
        return $query->all();
    }

    public static function Data($array) {
        $result=[];
        foreach ($array as $item) {
            $result[] = array(
                'name' => $item['name'],
                'y' => intval($item['y'])
            );
        }
        return $result;
    }
}
