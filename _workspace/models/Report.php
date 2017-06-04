<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%report}}".
 *
 * @property integer $id
 * @property integer $postulant_id
 * @property string $file
 * @property string $description
 *
 * @property Postulant $postulant
 */
class Report extends \yii\db\ActiveRecord
{
    public $person_name;
    public $period_name;
    public $postulant_search;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%report}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['postulant_id', 'file'], 'required'],
            [['postulant_id'], 'integer'],
            [['file', 'description'], 'string', 'max' => 255],
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
            'postulant_id' => 'Postulante',
            'file' => 'Informe',
            'description' => 'Descripción del informe',
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
