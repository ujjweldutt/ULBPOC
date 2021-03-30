<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\WmsWorkItems;

/**
 * WmsWorkItemsSearch represents the model behind the search form of `frontend\models\WmsWorkItems`.
 */
class WmsWorkItemsSearch extends WmsWorkItems
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'wms_id', 'item_id', 'quantity', 'rate_type_id'], 'integer'],
            [['description', 'remarks', 'unit', 'status', 'created_on', 'updated_on'], 'safe'],
            [['number1', 'number2', 'number3', 'length', 'breadth', 'height', 'total_rate', 'total_amount'], 'number'],
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
        $query = WmsWorkItems::find();

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
            'wms_id' => $this->wms_id,
            'item_id' => $this->item_id,
            'number1' => $this->number1,
            'number2' => $this->number2,
            'number3' => $this->number3,
            'length' => $this->length,
            'breadth' => $this->breadth,
            'height' => $this->height,
            'quantity' => $this->quantity,
            'rate_type_id' => $this->rate_type_id,
            'total_rate' => $this->total_rate,
            'total_amount' => $this->total_amount,
            'created_on' => $this->created_on,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
