<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Report;

/**
 * ReportSearch represents the model behind the search form about `app\models\Report`.
 */
class ReportSearch extends Report
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'postulant_id'], 'integer'],
            [['file', 'description', 'postulant_search'], 'safe'],
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
        $query = Report::find();

        // add conditions that should always apply here
        $query->alias('t');
        $query->select(['t.id', 'ps.name person_name', 'pr.name period_name', 'description']);
        $query->innerJoin('{{%postulant}} p', 't.postulant_id=p.id');
        $query->innerJoin('{{%person}} ps', 'p.person_id=ps.id');
        $query->innerJoin('{{%period}} pr', 'p.period_id=pr.id');

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
            't.id' => $this->id,
            't.postulant_id' => $this->postulant_id,
        ]);

        $query->andFilterWhere(['like', 't.file', $this->file])
            ->andFilterWhere(['like', 't.description', $this->description])
            ->andFilterWhere(['like', 'ps.name', $this->postulant_search]);

        return $dataProvider;
    }
}
