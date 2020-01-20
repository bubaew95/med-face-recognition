<?php

namespace backend\models\pacients;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\pacients\MedicalSupervision;

/**
 * SupervisionSearch represents the model behind the search form of `common\models\pacients\MedicalSupervision`.
 */
class SupervisionSearch extends MedicalSupervision
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_pacient'], 'integer'],
            [['date', 'complaint', 'observation_dynamics', 'appointment', 'drug', 'certificate_incapacity', 'preferential_recipes', 'doctor'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = MedicalSupervision::find();

        // add conditions that should always apply here

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
            'id_pacient' => $this->id_pacient,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'complaint', $this->complaint])
            ->andFilterWhere(['like', 'observation_dynamics', $this->observation_dynamics])
            ->andFilterWhere(['like', 'appointment', $this->appointment])
            ->andFilterWhere(['like', 'drug', $this->drug])
            ->andFilterWhere(['like', 'certificate_incapacity', $this->certificate_incapacity])
            ->andFilterWhere(['like', 'preferential_recipes', $this->preferential_recipes])
            ->andFilterWhere(['like', 'doctor', $this->doctor]);

        return $dataProvider;
    }
}
