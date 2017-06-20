<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

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
class Person extends ActiveRecord
{
    const STATUS_SINGLE = 0;
    const STATUS_MARRIED = 1;
    const STATUS_WIDOWER = 2;
    const STATUS_DIVORCED = 3;

    const STATUSES = [
        Person::STATUS_SINGLE => 'Soltero',
        Person::STATUS_MARRIED => 'Casado',
        Person::STATUS_WIDOWER => 'Viudo',
        Person::STATUS_DIVORCED => 'Divorciado',
    ];

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    const GENDERS =[
        Person::GENDER_MALE => 'Masculino',
        Person::GENDER_FEMALE => 'Femenino'
    ];

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
            [['picture'], 'image', 'maxWidth'=>1920, 'maxHeight'=>1080, 'maxSize'=>50000],
            ['identity', 'string', 'length' => [7, 8], 'message' => 'Hakuna Matata'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'identity' => 'Identidad',
            'name' => 'Nombre',
            'status' => 'Estado Civil',
            'gender' => 'Genero',
            'birthdate' => 'Fecha de Nacimiento',
            'phone' => 'Telefono',
            'address' => 'Direccion',
            'picture' => 'Foto',
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
