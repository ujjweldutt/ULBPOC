<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\BudgetProposal;

/**
 * BudgetProposalSearch represents the model behind the search form of `frontend\models\BudgetProposal`.
 */
class BudgetProposalSearch extends BudgetProposal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'budget_id', 'ulb_id', 'approved_by'], 'integer'],
            [['amount_demanded'], 'number'],
            [['allocation_type', 'status', 'uploaded_file', 'created_on', 'updated_on'], 'safe'],
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
        $query = BudgetProposal::find();

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
            'budget_id' => $this->budget_id,
            'ulb_id' => $this->ulb_id,
            'amount_demanded' => $this->amount_demanded,
            'approved_by' => $this->approved_by,
            'created_on' => $this->created_on,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'allocation_type', $this->allocation_type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'uploaded_file', $this->uploaded_file]);

        return $dataProvider;
    }
}
