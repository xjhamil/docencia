<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tracing}}".
 *
 * @property integer $id
 * @property integer $teaching_id
 * @property string $date
 * @property integer $observation
 *
 * @property Evaluation[] $evaluations
 * @property Teaching $teaching
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
            [['teaching_id', 'date', 'observation'], 'required'],
            [['teaching_id', 'observation'], 'integer'],
            [['date'], 'safe'],
            [['teaching_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teaching::className(), 'targetAttribute' => ['teaching_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'teaching_id' => 'Teaching ID',
            'date' => 'Date',
            'observation' => 'Observation',
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
    public function getTeaching()
    {
        return $this->hasOne(Teaching::className(), ['id' => 'teaching_id']);
    }
}
