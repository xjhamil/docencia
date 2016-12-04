<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%course}}".
 *
 * @property integer $id
 * @property integer $level
 * @property integer $grade
 *
 * @property Teaching[] $teachings
 */
class Course extends ActiveRecord
{

    const LEVEL_PRIMARY = 1;
    const LEVEL_SECONDARY = 2;

    const LEVELS = [
        Course::LEVEL_PRIMARY => 'Primaria',
        Course::LEVEL_SECONDARY => 'Secundaria',
    ];

    const GRADE_FIRST = 1;
    const GRADE_SECOND = 2;
    const GRADE_THIRD = 3;
    const GRADE_FOURTH = 4;
    const GRADE_FIFTH = 5;
    const GRADE_SIXTH = 6;

    const GRADES =[
        Course::GRADE_FIRST => 'Primero',
        Course::GRADE_SECOND => 'Segundo',
        Course::GRADE_THIRD => 'Tercero',
        Course::GRADE_THIRD => 'Cuarto',
        Course::GRADE_FOURTH => 'Quinto',
        Course::GRADE_SIXTH => 'Sexto',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%course}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level', 'grade'], 'required'],
            [['level', 'grade'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => 'Nivel',
            'grade' => 'Grado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachings()
    {
        return $this->hasMany(Teaching::className(), ['course_id' => 'id']);
    }

    public function getName()
    {
        return static::GRADES[$this->grade].' '.static::LEVELS[$this->level];
    }
}

