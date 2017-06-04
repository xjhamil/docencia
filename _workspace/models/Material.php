<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%material}}".
 *
 * @property integer $id
 * @property integer $postulant_id
 * @property string $date
 * @property string $description
 *
 * @property Postulant $postulant
 */
class Material extends \yii\db\ActiveRecord
{

    public $postulant_search;
    public $person_name;
    public $period_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%material}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['postulant_id', 'date', 'description'], 'required'],
            [['postulant_id'], 'integer'],
            [['date'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['postulant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Postulant::className(), 'targetAttribute' => ['postulant_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'postulant_id' => 'Postulant ID',
            'date' => 'Date',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostulant()
    {
        return $this->hasOne(Postulant::className(), ['id' => 'postulant_id']);
    }
}
