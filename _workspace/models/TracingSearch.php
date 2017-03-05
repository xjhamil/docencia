<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tracing;

/**
 * TracingSearch represents the model behind the search form about `app\models\Tracing`.
 */
class TracingSearch extends Tracing
{
    public $person_search;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'observation', 'person_id', 'period_id', 'school_id'], 'integer'],
            [['date', 'person_search'], 'safe'],
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
        $query = Tracing::find();

        // add conditions that should always apply here
        $query->joinWith(['period pr', 'school sc', 'person ps']);

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
            'date' => $this->date,
            'observation' => $this->observation,
            'person_id' => $this->person_id,
            'period_id' => $this->period_id,
            'school_id' => $this->school_id,
        ]);

        $query->andFilterWhere(['LIKE', 'ps.name', $this->person_search]);

        return $dataProvider;
    }
}
