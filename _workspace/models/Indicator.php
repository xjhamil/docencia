<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%indicator}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Evaluation[] $evaluations
 */
class Indicator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%indicator}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluations()
    {
        return $this->hasMany(Evaluation::className(), ['indicator_id' => 'id']);
    }
}
