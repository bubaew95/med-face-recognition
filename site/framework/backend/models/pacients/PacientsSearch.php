<?php

namespace backend\models\pacients;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\pacients\PacientsCart;

/**
 * PacientsSearch represents the model behind the search form of `common\models\pacients\PacientsCart`.
 */
class PacientsSearch extends PacientsCart
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ogrn'], 'integer'],
            [['name', 'sex', 'birthday', 'phone', 'phone_home', 'email', 'position', 'snils', 'ins_organization', 'polis', 'permanent_address', 'registration_address', 'passport', 'disability', 'place_work', 'blood_group', 'hr_factor', 'allergic'], 'safe'],
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
        $query = PacientsCart::find()->orderBy(['id' => SORT_DESC]);

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
            'birthday' => $this->birthday,
            'ogrn' => $this->ogrn,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'phone_home', $this->phone_home])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'snils', $this->snils])
            ->andFilterWhere(['like', 'ins_organization', $this->ins_organization])
            ->andFilterWhere(['like', 'polis', $this->polis])
            ->andFilterWhere(['like', 'permanent_address', $this->permanent_address])
            ->andFilterWhere(['like', 'registration_address', $this->registration_address])
            ->andFilterWhere(['like', 'passport', $this->passport])
            ->andFilterWhere(['like', 'disability', $this->disability])
            ->andFilterWhere(['like', 'place_work', $this->place_work])
            ->andFilterWhere(['like', 'blood_group', $this->blood_group])
            ->andFilterWhere(['like', 'hr_factor', $this->hr_factor])
            ->andFilterWhere(['like', 'allergic', $this->allergic]);

        return $dataProvider;
    }
}
