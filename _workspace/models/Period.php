<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%period}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $star
 * @property string $end
 *
 * @property Teaching[] $teachings
 */
class Period extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%period}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'star', 'end'], 'required'],
            [['star', 'end'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'id' => 'ID',
            'name' => 'Nombre',
            'star' => 'Inicio',
            'end' => 'Fin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachings()
    {
        return $this->hasMany(Teaching::className(), ['period_id' => 'id']);
    }

    public function getTeachers() {
        $query = Teaching::find();
        $query->alias('t');

        $query->select([
            'p.name person',
            's.name school',
            'c.level',
            'c.grade',
            'a.name subject'
        ]);

        $query->innerJoin('{{%person}} p', 'p.id=t.person_id');
        $query->innerJoin('{{%school}} s', 's.id=t.school_id');
        $query->innerJoin('{{%course}} c', 'c.id=t.course_id');
        $query->innerJoin('{{%subject}} a', 'a.id=t.subject_id');

        $query->where(['t.period_id'=>$this->id]);
        $query->asArray();

        return $query->all();
    }
}
