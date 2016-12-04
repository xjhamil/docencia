<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Teaching;

/**
 * TeachingSearch represents the model behind the search form about `app\models\Teaching`.
 */
class TeachingSearch extends Teaching
{
    public $person_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'person_id', 'period_id', 'school_id', 'course_id', 'subject_id'], 'integer'],
            [['person_name'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Teaching::find();

        // add conditions that should always apply here
        $query->joinWith(['person person', 'period period','school school','course course']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'person_id' => $this->person_id,
            'period_id' => $this->period_id,
            'school_id' => $this->school_id,
            'course_id' => $this->course_id,
            'subject_id' => $this->subject_id,
        ]);
        $query->andFilterWhere(['like', 'person.name', $this->person_name]);
        return $dataProvider;
    }
}
