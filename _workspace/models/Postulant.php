<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_postulant".
 *
 * @property integer $id
 * @property integer $person_id
 * @property integer $period_id
 * @property integer $approved
 *
 * @property Documentation[] $documentations
 * @property Period $period
 * @property Person $person
 */
class Postulant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_postulant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'period_id'], 'required'],
            [['person_id', 'period_id', 'approved'], 'integer'],
            [['period_id'], 'exist', 'skipOnError' => true, 'targetClass' => Period::className(), 'targetAttribute' => ['period_id' => 'id']],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person_id' => 'Persona',
            'period_id' => 'Periodo',
            'approved' => 'Aprobado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentations()
    {
        return $this->hasMany(Documentation::className(), ['postulant_id' => 'id']);
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

    public static function Report() {
        $query = Postulant::find();
        $query->alias('postulant');
        $query->select([
            'period.name',
            'SUM(IF(postulant.approved=1,1,0)) approved',
            'SUM(IF(postulant.approved=0,1,0)) disapproved',
        ]);
        $query->innerJoin('{{%period}} period', 'postulant.period_id=period.id');
        $query->groupBy('postulant.period_id');
        $query->asArray(true);
        return $query->all();
    }

    public static function Label($array) {
        $result=[];
        foreach ($array as $item) {
            $result[] = $item['name'];
        }
        return $result;
    }

    public static function Approved($array) {
        $result=[];
        foreach ($array as $item) {
            $result[] = intval($item['approved']);
        }
        return $result;
    }

    public static function Disapproved($array) {
        $result=[];
        foreach ($array as $item) {
            $result[] = intval($item['disapproved']);
        }
        return $result;
    }
}
