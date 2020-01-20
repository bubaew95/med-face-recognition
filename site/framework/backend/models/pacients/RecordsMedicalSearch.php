<?php

namespace backend\models\pacients;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\pacients\RecordsMedical;

/**
 * RecordsMedicalSearch represents the model behind the search form of `common\models\pacients\RecordsMedical`.
 */
class RecordsMedicalSearch extends RecordsMedical
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_pacient', 'consent'], 'integer'],
            [['date_inspection', 'inspection', 'doctor', 'patient_complaints', 'history_disease', 'objective_data', 'diagnosis_underly', 'complication', 'concomitant_disease', 'external_cause', 'health_group', 'dispensary_observation', 'appointment', 'drug', 'certificate_incapacity', 'preferential_recipes'], 'safe'],
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
        $query = RecordsMedical::find();

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
            'date_inspection' => $this->date_inspection,
            'consent' => $this->consent,
        ]);

        $query->andFilterWhere(['like', 'inspection', $this->inspection])
            ->andFilterWhere(['like', 'doctor', $this->doctor])
            ->andFilterWhere(['like', 'patient_complaints', $this->patient_complaints])
            ->andFilterWhere(['like', 'history_disease', $this->history_disease])
            ->andFilterWhere(['like', 'objective_data', $this->objective_data])
            ->andFilterWhere(['like', 'diagnosis_underly', $this->diagnosis_underly])
            ->andFilterWhere(['like', 'complication', $this->complication])
            ->andFilterWhere(['like', 'concomitant_disease', $this->concomitant_disease])
            ->andFilterWhere(['like', 'external_cause', $this->external_cause])
            ->andFilterWhere(['like', 'health_group', $this->health_group])
            ->andFilterWhere(['like', 'dispensary_observation', $this->dispensary_observation])
            ->andFilterWhere(['like', 'appointment', $this->appointment])
            ->andFilterWhere(['like', 'drug', $this->drug])
            ->andFilterWhere(['like', 'certificate_incapacity', $this->certificate_incapacity])
            ->andFilterWhere(['like', 'preferential_recipes', $this->preferential_recipes]);

        return $dataProvider;
    }
}
