<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%subject}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 *
 * @property Teaching[] $teachings
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subject}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Codigo',
            'name' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachings()
    {
        return $this->hasMany(Teaching::className(), ['subject_id' => 'id']);
    }
}
