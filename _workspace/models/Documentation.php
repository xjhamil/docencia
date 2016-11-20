<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%documentation}}".
 *
 * @property integer $id
 * @property integer $teaching_id
 * @property integer $requirement_id
 * @property integer $value
 *
 * @property Requirement $requirement
 * @property Teaching $teaching
 */
class Documentation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%documentation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teaching_id', 'requirement_id', 'value'], 'required'],
            [['teaching_id', 'requirement_id', 'value'], 'integer'],
            [['requirement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Requirement::className(), 'targetAttribute' => ['requirement_id' => 'id']],
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
            'requirement_id' => 'Requirement ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequirement()
    {
        return $this->hasOne(Requirement::className(), ['id' => 'requirement_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeaching()
    {
        return $this->hasOne(Teaching::className(), ['id' => 'teaching_id']);
    }
}
