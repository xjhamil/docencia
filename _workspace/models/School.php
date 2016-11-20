<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%school}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $address
 *
 * @property Teaching[] $teachings
 */
class School extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%school}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'phone', 'address'], 'string', 'max' => 255],
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
            'phone' => 'Telefono',
            'address' => 'Direccion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachings()
    {
        return $this->hasMany(Teaching::className(), ['school_id' => 'id']);
    }
}
