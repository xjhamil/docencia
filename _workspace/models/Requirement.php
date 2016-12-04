<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%requirement}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 *
 * @property Documentation[] $documentations
 */
class Requirement extends \yii\db\ActiveRecord
{

    const TYPE_NORMAL = 0;
    const TYPE_MANDATORY = 1;


    const TYPES = [
        Requirement::TYPE_NORMAL => 'Normal',
        Requirement::TYPE_MANDATORY=> 'Obligatorio',

    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%requirement}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type'], 'integer'],
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
            'name' => 'Nombre',
            'type' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentations()
    {
        return $this->hasMany(Documentation::className(), ['requirement_id' => 'id']);
    }
}
