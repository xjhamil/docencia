<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%evaluation}}".
 *
 * @property integer $id
 * @property integer $tracing_id
 * @property integer $indicator_id
 * @property integer $value
 *
 * @property Indicator $indicator
 * @property Tracing $tracing
 */
class Evaluation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%evaluation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tracing_id', 'indicator_id', 'value'], 'required'],
            [['tracing_id', 'indicator_id', 'value'], 'integer'],
            [['indicator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Indicator::className(), 'targetAttribute' => ['indicator_id' => 'id']],
            [['tracing_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tracing::className(), 'targetAttribute' => ['tracing_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tracing_id' => 'Tracing ID',
            'indicator_id' => 'Indicator ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndicator()
    {
        return $this->hasOne(Indicator::className(), ['id' => 'indicator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTracing()
    {
        return $this->hasOne(Tracing::className(), ['id' => 'tracing_id']);
    }
}
