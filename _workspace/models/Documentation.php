<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%documentation}}".
 *
 * @property integer $id
 * @property integer $requirement_id
 * @property integer $value
 * @property integer $postulant_id
 *
 * @property Postulant $postulant
 * @property Requirement $requirement
 */
class Documentation extends \yii\db\ActiveRecord
{
    const VALUE_YES = 1;
    const VALUE_NO = 0;

    const VALUES = [
        Documentation::VALUE_YES => 'Si',
        Documentation::VALUE_NO => 'No'
    ];

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
            [['requirement_id', 'value', 'postulant_id'], 'required'],
            [['requirement_id', 'value', 'postulant_id'], 'integer'],
            [['postulant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Postulant::className(), 'targetAttribute' => ['postulant_id' => 'id']],
            [['requirement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Requirement::className(), 'targetAttribute' => ['requirement_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'requirement_id' => 'Requirimientos',
            'value' => 'Aceptado',
            'postulant_id' => 'Postulante',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostulant()
    {
        return $this->hasOne(Postulant::className(), ['id' => 'postulant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequirement()
    {
        return $this->hasOne(Requirement::className(), ['id' => 'requirement_id']);
    }
}
