<?php

namespace app\models;

use app\components\UploadedFile;
use Yii;
use yii\db\Expression;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "tbl_postulant".
 *
 * @property integer $id
 * @property integer $person_id
 * @property integer $period_id
 * @property integer $approved
 *
 * @property Documentation[] $documentations
 * @property Period $period
 * @property Person $person
 */
class Postulant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_postulant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'period_id'], 'required'],
            [['person_id', 'period_id', 'approved'], 'integer'],
            [['period_id'], 'exist', 'skipOnError' => true, 'targetClass' => Period::className(), 'targetAttribute' => ['period_id' => 'id']],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person_id' => 'Persona',
            'period_id' => 'Periodo',
            'approved' => 'Aprobado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentations()
    {
        return $this->hasMany(Documentation::className(), ['postulant_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriod()
    {
        return $this->hasOne(Period::className(), ['id' => 'period_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }

    public static function Report() {
        $query = Postulant::find();
        $query->alias('postulant');
        $query->select([
            'period.name',
            'SUM(IF(postulant.approved=1,1,0)) approved',
            'SUM(IF(postulant.approved=0,1,0)) disapproved',
        ]);
        $query->innerJoin('{{%period}} period', 'postulant.period_id=period.id');
        $query->groupBy('postulant.period_id');
        $query->asArray(true);
        return $query->all();
    }

    public static function Label($array) {
        $result=[];
        foreach ($array as $item) {
            $result[] = $item['name'];
        }
        return $result;
    }

    public static function Approved($array) {
        $result=[];
        foreach ($array as $item) {
            $result[] = intval($item['approved']);
        }
        return $result;
    }

    public static function Disapproved($array) {
        $result=[];
        foreach ($array as $item) {
            $result[] = intval($item['disapproved']);
        }
        return $result;
    }

    public function requirements() {
        $array = array();

        if($this->isNewRecord) {
            $requirements = Requirement::find()
                ->select(['id','name','type',new Expression("'' value")])
                ->asArray()->all();
        } else {
            $requirements = Requirement::find()
                ->alias('r')
                ->select(['r.id','r.name','r.type','d.value'])
                ->leftJoin('{{%documentation}} d', 'r.id=d.requirement_id')
                ->where(['d.postulant_id'=>$this->id])
                ->asArray()->all();
        }

        foreach ($requirements as $requirement) {
            $array[] = [
                'id' => $requirement['id'],
                'name' => $requirement['name'],
                'type' => $requirement['type'],
                'value' => $requirement['value']
            ];
        }

        return $array;
    }

    public function clearRequirements() {
        $requirements = Documentation::find()
            ->where(['postulant_id'=>$this->id])->all();
        $directory = Yii::getAlias('@webroot/requirement');
        foreach ($requirements as $requirement) {
            $filePath = $directory . DIRECTORY_SEPARATOR . $requirement->value;
            if(file_exists($filePath) && is_file($filePath)) unlink($filePath);
        }
        Documentation::deleteAll(['postulant_id'=>$this->id]);
    }

    /**
     *
     */
    public function saveRequirements() {
        $this->clearRequirements();
        $directory = Yii::getAlias('@webroot/requirement');
        if (!is_dir($directory)) FileHelper::createDirectory($directory);
        $requirements = UploadedFile::getInstancesByName('Requirement');
        foreach ($requirements as $id => $requirement) {
            $uid = uniqid(time(), true);
            $fileName = $uid . '.' . $requirement->extension;
            $filePath = $directory . DIRECTORY_SEPARATOR . $fileName;
            $model = new Documentation();
            $model->postulant_id = $this->id;
            $model->requirement_id = $id;
            $model->value = $fileName;
            $requirement->saveAs($filePath);
            $model->save();
        }
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        Documentation::deleteAll(['postulant_id'=>$this->id]);
        return true;
    }


}
