<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\VendorAssignWork;

/**
 * VendorAssignWorkSearch represents the model behind the search form of `frontend\models\VendorAssignWork`.
 */
class VendorAssignWorkSearch extends VendorAssignWork
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'vendor_registration_id', 'agency_period_months', 'estimated_amount', 'liability_period_days', 'security_deposit', 'earnest_money_deposit'], 'integer'],
            [['reference_no', 'agency_tendor_no', 'work_start_date', 'work_completion_date', 'brief_work_details', 'note_other_conditions', 'created_at', 'is_active'], 'safe'],
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
        $query = VendorAssignWork::find();

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
            'vendor_registration_id' => $this->vendor_registration_id,
            'agency_period_months' => $this->agency_period_months,
            'estimated_amount' => $this->estimated_amount,
            'work_start_date' => $this->work_start_date,
            'work_completion_date' => $this->work_completion_date,
            'liability_period_days' => $this->liability_period_days,
            'security_deposit' => $this->security_deposit,
            'earnest_money_deposit' => $this->earnest_money_deposit,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'reference_no', $this->reference_no])
            ->andFilterWhere(['like', 'agency_tendor_no', $this->agency_tendor_no])
            ->andFilterWhere(['like', 'brief_work_details', $this->brief_work_details])
            ->andFilterWhere(['like', 'note_other_conditions', $this->note_other_conditions])
            ->andFilterWhere(['like', 'is_active', $this->is_active]);

        return $dataProvider;
    }
}
