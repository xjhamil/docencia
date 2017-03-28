<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Documentation;

/**
 * DocumentationSearch represents the model behind the search form about `app\models\Documentation`.
 */
class DocumentationSearch extends Documentation
{
    public $period_search;
    public $person_search;
    public $requirement_search;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'requirement_id', 'value', 'postulant_id'], 'integer'],
            [['period_search', 'person_search', 'requirement_search'], 'safe'],
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
        $query = Documentation::find();

        // add conditions that should always apply here
        $query->joinWith(['postulant pt', 'postulant.person ps', 'postulant.period pr', 'requirement rq']);

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
            'requirement_id' => $this->requirement_id,
            'value' => $this->value,
            'postulant_id' => $this->postulant_id,
            'pt.period_id' => $this->period_search
        ]);

        $query->andFilterWhere(['LIKE', 'ps.name', $this->person_search]);
        $query->andFilterWhere(['LIKE', 'rq.name', $this->requirement_search]);

        return $dataProvider;
    }
}
