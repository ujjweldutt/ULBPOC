<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Wms;

/**
 * WmsSearch represents the model behind the search form of `frontend\models\Wms`.
 */
class WmsSearch extends Wms
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'ulb_id', 'ward_id', 'scheme_id', 'component_id', 'financial_year_id'], 'integer'],
            [['work_code_number', 'work_name', 'work_type', 'work_sub_type', 'work_scope', 'announcement_type', 'announcement_no', 'announcement_date', 'site_plan_file', 'cross_section_file', 'l_section_file', 'google_map_file', 'city_map_file', 'is_active', 'is_revised', 'remarks', 'created_on', 'updated_on'], 'safe'],
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
        $query = Wms::find();

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
            'user_id' => $this->user_id,
            'ulb_id' => $this->ulb_id,
            'ward_id' => $this->ward_id,
            'scheme_id' => $this->scheme_id,
            'component_id' => $this->component_id,
            'financial_year_id' => $this->financial_year_id,
            'announcement_date' => $this->announcement_date,
            'created_on' => $this->created_on,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'work_code_number', $this->work_code_number])
            ->andFilterWhere(['like', 'work_name', $this->work_name])
            ->andFilterWhere(['like', 'work_type', $this->work_type])
            ->andFilterWhere(['like', 'work_sub_type', $this->work_sub_type])
            ->andFilterWhere(['like', 'work_scope', $this->work_scope])
            ->andFilterWhere(['like', 'announcement_type', $this->announcement_type])
            ->andFilterWhere(['like', 'announcement_no', $this->announcement_no])
            ->andFilterWhere(['like', 'site_plan_file', $this->site_plan_file])
            ->andFilterWhere(['like', 'cross_section_file', $this->cross_section_file])
            ->andFilterWhere(['like', 'l_section_file', $this->l_section_file])
            ->andFilterWhere(['like', 'google_map_file', $this->google_map_file])
            ->andFilterWhere(['like', 'city_map_file', $this->city_map_file])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_revised', $this->is_revised])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
