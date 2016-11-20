<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%person}}".
 *
 * @property integer $id
 * @property string $identity
 * @property string $name
 * @property integer $status
 * @property integer $gender
 * @property string $birthdate
 * @property string $phone
 * @property string $address
 * @property string $picture
 *
 * @property Teaching[] $teachings
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%person}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['identity', 'name', 'status', 'gender', 'birthdate'], 'required'],
            [['status', 'gender'], 'integer'],
            [['birthdate'], 'safe'],
            [['identity', 'name', 'phone', 'address', 'picture'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'identity' => 'Identity',
            'name' => 'Name',
            'status' => 'Status',
            'gender' => 'Gender',
            'birthdate' => 'Birthdate',
            'phone' => 'Phone',
            'address' => 'Address',
            'picture' => 'Picture',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachings()
    {
        return $this->hasMany(Teaching::className(), ['person_id' => 'id']);
    }
}
