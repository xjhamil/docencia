<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Postulant;

/**
 * PostulantSearch represents the model behind the search form about `app\models\Postulant`.
 */
class PostulantSearch extends Postulant
{
    public $person_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'person_id', 'period_id', 'approved'], 'integer'],
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
        $query = Postulant::find();

        // add conditions that should always apply here
        $query->joinWith(['person person', 'period period']);

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
            'approved' => $this->approved,
        ]);

        $query->andFilterWhere(['like', 'person.name', $this->person_name]);

        return $dataProvider;
    }
}
